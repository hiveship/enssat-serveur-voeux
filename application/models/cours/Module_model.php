<?php

class Module_model extends CI_model
{
	
	const TABLE_NAME = 'module';

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
	}

	public function create ( $nom, $public, $semestre, $libelle )
	{
		$data = array ( 
			
				'nom' => $nom, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		
		$res = $this -> get_nom( $nom );
		
		if ( sizeof( $res ) == 0 ) {
			$this -> db -> insert( self::TABLE_NAME, $data );
			return $this -> get_nom( $nom );
		} else {
			return null;
		}
	}

	public function get_all ()
	{
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function get ( $ID )
	{
		$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
			
				'id' => $ID 
		) );
		return $querry -> result_array()[0];
	}

	public function get_nom ( $nom )
	{
		$this -> db -> select( 'id' );
		$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
			
				'nom' => $nom 
		) );
		return $querry -> result_array()[0];
	}

	public function get_modules_id_de ( $responsable )
	{
		$this -> db -> where( 'responsable', $responsable );
		$this -> db -> order_by( "id", "asc" );
		$this -> db -> select( 'id' );
		$this -> db -> distinct();
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function delete ( $ID )
	{
		$this -> db -> delete( 'contenu', array ( 
			
				'module' => $ID 
		) );
		
		$this -> db -> delete( self::TABLE_NAME, array ( 
			
				'id' => $ID 
		) );
	}

	public function update ( $ID, $nom, $public, $semestre, $libelle )
	{
		if ( ! $this -> exists( $ID ) ) {
			return false; // FIXME cette vérification doit être faite dans le controlleur, pas dans le modèle
		}
		
		$data = array ( 
			
				'nom' => $nom, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		
		$this -> db -> where( 'id', $ID );
		$this -> db -> update( self::TABLE_NAME, $data );
		return true;
	}

	public function exists ( $ID )
	{
		$this -> db -> select( 'id' );
		$this -> db -> where( 'id', $ID );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

	public function est_libre ( $ID )
	{
		$this -> db -> where( 'responsable', null );
		$this -> db -> where( 'id', $ID );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

	public function inscrire_responsable ( $ID, $enseignant )
	{
		$this -> db -> where( 'id', $ID );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'responsable' => $enseignant 
		) );
	}

	public function desinscrire_responsable ( $ID, $enseignant )
	{
		$this -> db -> where( 'id', $ID );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'responsable' => NULL 
		) );
	}

	public function desinscrire_responsable_tout ( $enseignant )
	{
		$this -> db -> where( 'responsable', $enseignant );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'responsable' => NULL 
		) );
	}

}

?>