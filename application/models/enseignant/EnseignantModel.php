<?php

class EnseignantModel extends CI_Model
{

	public function __construct ()
	{
		$this -> load -> database();
	}

	public function get ( $login, $password )
	{
		$query = $this -> db -> get_where( 'enseignant', array ( 
			
				'login' => $login, 
				'pwd' => $password 
		), 1 );
		print_r( $query -> result() );
	}
	
	// Construire l'objet user avec les bonnes enums etc...
	// Return FALSE si on a récupéré 0 lignes

}
?>