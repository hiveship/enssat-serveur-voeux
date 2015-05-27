<?php

function my_error_handler ( $no, $str, $file, $line )
{
	flash_error ( $str );
}

class Module_model extends CI_model
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function create ( $ID, $public, $semestre, $libelle )
	{
		$data = array ( 
				'ident' => $ID, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		set_error_handler ( 'my_error_handler' );
		$this -> db -> insert ( 'module', $data );
	}

	public function get_all ()
	{
		$querry = $this -> db -> get ( 'module' );
		return $querry -> result_array ();
	}

	public function get ( $ID )
	{
		$querry = $this -> db -> get_where ( 'module', array ( 
				'ident' => $ID 
		) );
		return $querry -> result_array ();
	}

}

?>