<?php

class Decharge_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function get ( $login )
	{
		$query = $this -> db -> get_where ( 'decharge', array ( 
				'enseignant' => $login 
		) );
		
		$this -> db -> select ( 'decharge' );
		$this -> db -> where ( 'enseignant', $login );
		$query = $this -> db -> get ( 'decharge' );
		return $query -> result_array ();
	}

	public function add ( $login )
	{
	
	}

}

?>