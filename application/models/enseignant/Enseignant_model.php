<?php

class Enseignant_model extends CI_Model
{
	// =========
	// CONSTANTS
	// =========
	
	const TABLE_NAME = 'enseignant';
	
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
		$query = $this -> db -> get( self::TABLE_NAME );
		$enseignants = array ();
		foreach ( $query -> result() as $row ) {
			array_push( $enseignants, $this -> create_user_entity( $row ) );
		}
		return $enseignants;
	}

	public function authenticate ( $login, $password )
	{
		$query = $this -> db -> get_where( self::TABLE_NAME, array ( 
			
				'login' => $login, 
				'pwd' => $password 
		) );
		return $this -> create_user_entity( $query -> row() );
	}

	public function get ( $login )
	{
		$query = $this -> db -> get_where( self::TABLE_NAME, array ( 
			
				'login' => $login 
		) );
		return $this -> create_user_entity( $query -> row() );
	}
	
	// UPDATE
	// ------
	
	private function update_field ( $login, $field, $value )
	{
		$this -> db -> where( 'login', $login );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				$field => $value 
		) );
	}

	public function update_nom ( $login, $nom )
	{
		$this -> update_field( $login, 'nom', $nom );
	}

	public function update_prenom ( $login, $prenom )
	{
		$this -> update_field( $login, 'prenom', $prenom );
	}

	public function update_password ( $login, $password )
	{
		// TODO: secure storage
		$this -> update_field( $login, 'pwd', $password );
	}

	public function update_email ( $login, $email )
	{
		$this -> update_field( $login, 'email', $email );
	}

	public function rendre_administrateur ( $login )
	{
		$this -> update_field( $login, 'administrateur', self::LEVEL_ADMINISTRATEUR );
	}

	public function rendre_enseignant ()
	{
		$this -> update_field( $login, 'administrateur', self::LEVEL_ENSEIGNANT );
	}

	public function rendre_actif ( $login )
	{
		$this -> update_field( $login, 'actif', self::ETAT_ACTIF );
	}

	public function rendre_inactif ( $login )
	{
		$this -> update_field( $login, 'actif', self::ETAT_INACTIF );
	}
	
	// DELETE
	// ------
	
	public function delete ( $login )
	{
		$this -> db -> delete( self::TABLE_NAME, array ( 
			
				'login' => $login 
		) );
	}
	
	// =========
	// UTILITIES
	// =========
	
	private function create_user_entity ( $queryResult )
	{
		if ( empty( $queryResult ) ) {
			return FALSE;
		} else {
			$user = array ( 
				
					'login' => $queryResult -> login, 
					'nom' => $queryResult -> nom, 
					'prenom' => $queryResult -> prenom, 
					'email' => $queryResult -> email, 
					'statut' => $queryResult -> statut, 
					'statutaire' => $queryResult -> statutaire, 
					'actif' => $queryResult -> actif == self::ETAT_ACTIF, 
					'administrateur' => $queryResult -> administrateur == self::LEVEL_ADMINISTRATEUR 
			);
			return $user;
		}
	}

	public function is_actif ( $login )
	{
		$this -> db -> select( 'actif' );
		$this -> db -> where( 'login', $login );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> row() -> actif == self::ETAT_ACTIF;
	}

	public function is_admin ( $login )
	{
		$this -> db -> select( 'administrateur' );
		$this -> db -> where( 'login', $login );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> row() -> administrateur == self::LEVEL_ADMINISTRATEUR;
	}

	public function exists ( $login )
	{
		$this -> db -> select( 'login' ); // meaningless
		$this -> db -> where( 'login', $login );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
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
		return strtolower( substr( $prenom, 0 ) . $nom );
	}

	public function check_statut ( $statut )
	{
		// TODO: Refactoré ce code pour qu'il aille chercher tout seul toutes les constantes de la classe commencant par 'STATUT_'.
		if ( ( $statut == self::STATUT_ADMINISTRATIF ) ||  ( $statut == self::STATUT_CONTRACTUEL ) || ( $statut == self::STATUT_TITULAIRE ) ||  ( $statut == self::STATUT_VACATAIRE ) ) {
			return TRUE;
		}
		return FALSE;
	}

	public function check_statutaire ( $statutaire )
	{
		if ( is_int( $statutaire ) && $statutaire >= 0 ) {
			return TRUE;
		}
		return FALSE;
	}

	public function check_email_format ( $email )
	{
		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			return TRUE;
		}
		return FALSE;
	}

	public function get_allowed_statut ()
	{
		return array ( 
			
				self::STATUT_ADMINISTRATIF, 
				self::STATUT_CONTRACTUEL, 
				self::STATUT_TITULAIRE, 
				self::STATUT_VACATAIRE 
		);
	}

}
?>