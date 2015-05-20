<?php

class EnseignantModel extends CI_Model
{

	public function __construct ()
	{
		$this -> load -> database();
	}

	public function get ( $login )
	{
		// Retourne l'utilisateur correspondant au login
	}

}
?>