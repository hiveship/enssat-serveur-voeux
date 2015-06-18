<?php

class Cours_model extends CI_model
{
	const TABLE_NAME = 'contenu';

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
	}

	public function create ( $id, $part, $type, $hed, $enseignant = NULL )
	{
		// if ( $enseignant == NULL ) {
		$data = array ( 
			
				'module' => $id, 
				'partie' => $part, 
				'type' => $type, 
				'hed' => $hed 
		);
		// }
		$this -> db -> insert( 'contenu', $data );
	}

	public function delete ( $module, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$this -> db -> delete( self::TABLE_NAME, array ( 
				
					'module' => $module 
			) );
		} else {
			$this -> db -> delete( self::TABLE_NAME, array ( 
				
					'module' => $module, 
					'partie' => $partie 
			) );
		}
	}

	public function get ( $module, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
				
					'module' => $module 
			) );
		} else {
			$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
				
					'module' => $module, 
					'partie' => $partie 
			) );
		}
		return $querry -> result_array();
	}

	public function update ( $module, $partie_old, $partie_new, $type, $hed )
	{
		$data = array ( 
			
				'partie' => $partie_new, 
				'type' => $type, 
				'hed' => $hed 
		);
		
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie_old );
		$this -> db -> update( self::TABLE_NAME, $data );
	}

	public function inscrire_enseignant ( $module, $partie, $enseignant )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => $enseignant 
		) );
	}

	public function desinscrire_enseignant ( $module, $partie, $enseignant )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => NULL 
		) );
	}

	public function desinscrire_enseignant_tout ( $enseignant )
	{
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => NULL 
		) );
	}

	public function get_modules_id_de ( $enseignant )
	{
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> order_by( "module", "asc" );
		$this -> db -> select( 'module' );
		$this -> db -> distinct();
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function get_cours_de ( $enseignant, $module = NULL )
	{
		if ( $module != NULL ) {
			$this -> db -> where( 'module', $module );
		}
		$this -> db -> where( 'enseignant', $enseignant );
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function exists ( $module, $partie )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

	public function est_libre ( $module, $partie )
	{
		$this -> db -> where( 'enseignant', null );
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

}
?>
