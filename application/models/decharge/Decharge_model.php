<?php

class Decharge_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function get_all ()
	{
		$this -> db -> select ( 'id, enseignant, decharge, motif' );
		$query = $this -> db -> get ( 'decharge' );
		
		return $query -> result_array ();
	}

	public function get ( $login )
	{
		$query = $this -> db -> get_where ( 'decharge', array ( 
				'enseignant' => $login 
		) );
		
		return $query -> result_array ();
	}

	public function add ( $login, $decharge, $motif )
	{
		
		$data = array ( 
				'enseignant' => $login, 
				'decharge' => $decharge, 
				'motif' => $motif 
		);
		
		$this -> db -> insert ( 'decharge', $data );
	}

	public function delete ( $id )
	{
		$this -> db -> where ( 'id', $id );
		$this -> db -> delete ( 'decharge' );
	}

}

?>