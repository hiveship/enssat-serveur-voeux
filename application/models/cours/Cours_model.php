<?php

class Cours_model extends CI_model
{
	const TABLE_NAME = 'contenu';

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function create ( $id, $part, $type, $hed, $enseignant = Null )
	{
		if ( $enseignant == Null ) {
			$data = array ( 
					
					'module' => $id, 
					'partie' => $part, 
					'type' => $type, 
					'hed' => $hed 
			);
		}
		$this -> db -> insert ( 'contenu', $data );
	}

	public function delete ( $id, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$this -> db -> delete ( self::TABLE_NAME, array ( 
					
					'module' => $id 
			) );
		} else {
			$this -> db -> delete ( self::TABLE_NAME, array ( 
					
					'module' => $id, 
					'partie' => $partie 
			) );
		}
	}

	public function get ( $id, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
					'module' => $id 
			) );
		} else {
			$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
					'module' => $id, 
					'partie' => $partie 
			) );
		}
		return $querry -> result_array ();
	}

	public function update ( $id, $partie, $type, $hed, $enseignant = Null )
	{
		if ( $enseignant == Null ) {
			$data = array ( 
					'partie' => $partie, 
					'type' => $type, 
					'hed' => $hed 
			);
		}
		
		$this -> db -> where ( 'id', $id );
		$this -> db -> where ( 'partie', $partie );
		$this -> db -> update ( self::TABLE_NAME, $data );
	}

	public function inscrire_enseignant ( $id, $partie, $enseignant )
	{
		$this -> db -> where ( 'id', $id );
		$this -> db -> where ( 'partie', $partie );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				'enseignants' => $enseignant 
		) );
	}

	public function desinscrire_enseignant ( $id, $partie )
	{
		$this -> db -> where ( 'id', $id );
		$this -> db -> where ( 'partie', $partie );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				'enseignants' => NULL 
		) );
	}

	public function desinscrire_enseignant_tout ( $enseignant )
	{
		$this -> db -> where ( 'enseignants', $enseignant );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				'enseignants' => NULL 
		) );
	}

}
?>