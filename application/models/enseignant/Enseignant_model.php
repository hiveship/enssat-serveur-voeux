<?php

class Enseignant_model extends CI_Model
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
		$result = $query -> row();
		if ( empty( $result ) ) {
			return FALSE;
		} else {
			return $this -> create_user( $result );
		}
	}

	private function create_user ( $resultRow )
	{
		if ( empty( $resultRow ) ) {
			return FALSE;
		} else {
			// Créer une classe Utilisateur ??
			$user = array ( 
				
					'login' => $resultRow -> login, 
					'password' => $resultRow -> pwd, 
					'nom' => $resultRow -> nom, 
					'prenom' => $resultRow -> prenom, 
					'statut' => $resultRow -> statut, 
					'statutaire' => $resultRow -> statutaire, 
					'actif' => $resultRow -> actif, 
					'level' => $resultRow -> administrateur 
			);
			return $user;
		}
	}

}
?>