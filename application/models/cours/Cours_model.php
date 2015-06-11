<?php

class Cours_model extends CI_model
{
	const TABLE_NAME = 'contenu';

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function create ( $mod, $part, $type, $hed, $enseignant = Null )
	{
		if ( $enseignant == Null ) {
			$data = array ( 
					
					'module' => $mod, 
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
					
					'id' => $ID 
			) );
		} else {
			$this -> db -> delete ( self::TABLE_NAME, array ( 
					
					'id' => $ID, 
					'partie' => $partie 
			) );
		}
	}

	public function get ( $id, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
					'id' => $id 
			) );
		} else {
			$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
					'id' => $id, 
					'partie' => $partie 
			) );
		}
		return $querry -> result_array ();
	}

}
?>