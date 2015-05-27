<?php

class Enseignant_model extends CI_Model
{
	const LEVEL_ENSEIGNANT = 0;
	const LEVEL_ADMINISTRATEUR = 1;
	
	const STATUT_ADMINISTRATIF = 'administratif';
	const STATUT_CONTRACTUEL = 'contractuel';
	const STATUT_TITULAIRE = 'titulaire';
	const STATUT_VACATAIRE = 'vacataire';
	
	const ETAT_ACTIF = 1;
	const ETAT_INACTIF = 0;

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function get ( $login, $password )
	{
		$query = $this -> db -> get_where ( 'enseignant', array ( 
				
				'login' => $login, 
				'pwd' => $password 
		), 1 );
		$result = $query -> row ();
		if ( empty ( $result ) ) {
			return FALSE;
		} else {
			return $this -> create_user_array( $result );
		}
	}

	public function get_user ()
	{
		$me = $this -> session -> userdata ( 'me' );
		$login = $me ['login'];
		$query = $this -> db -> query ( "SELECT * FROM `enseignant` WHERE login= '" . $login . "'" );
		return $query -> result_array ();
	}

	private function create_user_array ( $resultRow )
	{
		if ( empty ( $resultRow ) ) {
			return FALSE;
		} else {
			$user = array ( 
					
					'login' => $resultRow -> login, 
					'password' => $resultRow -> pwd, 
					'nom' => $resultRow -> nom, 
					'prenom' => $resultRow -> prenom, 
					'statut' => $resultRow -> statut, 
					'statutaire' => $resultRow -> statutaire, 
					'etat' => $resultRow -> actif, 
					'level' => $resultRow -> administrateur 
			);
			return $user;
		}
	}

}
?>