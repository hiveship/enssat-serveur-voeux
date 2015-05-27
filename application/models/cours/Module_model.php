<?php

class Module_model extends CI_model
{

	public function __construct ()
	{
		parent::__construct ();
	}

	public function create ( $ID, $public, $semestre, $libelle )
	{
		$data = array ( 
				'ident' => $ID, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle, 
				'responssable' => 'NULL' 
		);
		$this -> db -> insert ( 'module', $data );
	}

	public function get ( $ID )
	{
	
	}

}

?>