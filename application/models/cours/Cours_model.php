<?php

class Cours_model extends CI_model
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
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
		$this -> db -> insert( 'contenu', $data );
	}

}
?>