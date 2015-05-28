<?php

class Enseignant_model extends CI_Model
{
	// =========
	// CONSTANTS
	// =========
	
	const LEVEL_ENSEIGNANT = 0;
	const LEVEL_ADMINISTRATEUR = 1; // Qui peut le plus peut le moins, un administrateur est un enseignant particulier.
	
	const STATUT_ADMINISTRATIF = 'administratif';
	const STATUT_CONTRACTUEL = 'contractuel';
	const STATUT_TITULAIRE = 'titulaire';
	const STATUT_VACATAIRE = 'vacataire';
	
	const ETAT_ACTIF = 1;
	const ETAT_INACTIF = 0;
	
	// =================
	// MODEL CONSTRUCTOR
	// =================
	
	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
		// Utilisation d'Active Record pour les requêtes à la base de données: abstraction du SGBD.
	}
	
	// CREATE
	// ------
	
	public function create ()
	{
	
	}
	
	// GET / GET ALL
	// -------------
	
	public function get_all ()
	{
	
	}

	public function get ( $login, $password )
	{
		$query = $this -> db -> get_where( 'enseignant', array ( 
			
				'login' => $login, 
				'pwd' => $password 
		), 1 );
		return $this -> create_user_entity( $query -> row() );
	}
	
	// UPDATE
	// ------
	
	public function update_nom ()
	{
	
	}

	public function update_prenom ()
	{
	
	}

	public function update_password ()
	{
	
	}

	public function update_email ()
	{
	
	}

	public function rendre_administrateur ()
	{
	
	}

	public function rendre_enseignant ()
	{
	
	}

	public function rendre_actif ()
	{
	
	}

	public function rendre_inactif ()
	{
	
	}
	
	// DELETE
	// ------
	
	public function delete ()
	{
	
	}
	
	// =========
	// UTILITIES
	// =========
	
	private function create_user_entity ( $queryResult )
	{
		if ( empty( $queryResult ) ) {
			return FALSE;
		} else {
			$actif = $queryResult -> actif == self::ETAT_ACTIF;
			$administrateur = $queryResult -> administrateur == self::LEVEL_ADMINISTRATEUR;
			
			$user = array ( 
				
					'login' => $queryResult -> login, 
					'password' => $queryResult -> pwd, 
					'nom' => $queryResult -> nom, 
					'prenom' => $queryResult -> prenom, 
					'statut' => $queryResult -> statut, 
					'statutaire' => $queryResult -> statutaire, 
					'actif' => $actif, 
					'administrateur' => $administrateur 
			);
			return $user;
		}
	}

	/**
	 * Retourne vrai si un utiliseur est actif, faux sinon.
	 * 
	 * @param array $user:
	 *        	un tableau représentant un utilisateur. Le tableau doit être correctement construit.
	 */
	public function is_actif ( $user )
	{
		return $user ['actif'];
	}

	/**
	 * Retourne vrai si un utiliseur est administrateur, faux sinon.
	 * 
	 * @param array $user:
	 *        	un tableau représentant un utilisateur. Le tableau doit être correctement construit.
	 */
	public function is_admin ( $user )
	{
		return $user ['administrateur'];
	}

	/**
	 * Retourne le login d'un enseignant.
	 * Le login correspond à la première lettre du prenom, suivit du nom de famille en entier. Le tout est uniquement en minuscule.
	 * 
	 * @param string $prenom        	
	 * @param string $nom        	
	 * @return string login
	 */
	public function compute_login ( $prenom, $nom )
	{
		return strtolower( substr( $prenom, $start ) . $nom );
	}

}
?>