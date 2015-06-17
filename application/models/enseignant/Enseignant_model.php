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
		parent::__construct ();
		$this -> load -> database ();
		// Utilisation d'Active Record pour les requêtes à la base de données: abstraction du SGBD.
	}
	
	// CREATE
	// ------
	
	public function create ( $login, $password, $nom, $prenom, $email, $statut, $statutaire, $actif, $administrateur )
	{
		// FIXME: debug uniquement
		flash_warning ( "DEBUG UNIQUEMENT: mot de passe de l'utilisateur créé -> " . $password );
		$this -> db -> insert ( self::TABLE_NAME, array ( 
				
				'login' => $login, 
				'pwd' => password_hash ( $password, PASSWORD_DEFAULT ), 
				'nom' => $nom, 
				'prenom' => $prenom, 
				'email' => $email, 
				'statut' => $statut, 
				'statutaire' => $statutaire, 
				'actif' => $actif, 
				'administrateur' => $administrateur 
		) );
	
	}
	
	// GET / GET ALL
	// -------------
	
	public function get_all ()
	{
		$query = $this -> db -> get ( self::TABLE_NAME );
		$enseignants = array ();
		foreach ( $query -> result () as $row ) {
			array_push ( $enseignants, $this -> create_user_entity ( $row ) );
		}
		return $enseignants;
	}

	public function get_all_login_nom_prenom ()
	{
		$this -> db -> select ( 'nom, prenom, login' );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> result_array ();
	
	}

	public function authenticate ( $login, $password )
	{
		$query = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'login' => $login 
		) );
		$securePassword = $query -> result ()[0] -> pwd;
		if ( $this -> verify_password ( $password, $securePassword ) ) { // Only 1 row cause login is unique.
			$me = $this -> create_user_entity ( $query -> row () );
			$me ['password'] = $securePassword; // Save the secure password in the entity.
			return $me;
		} else {
			return FALSE;
		}
	}

	public function get ( $login )
	{
		$query = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'login' => $login 
		) );
		return $this -> create_user_entity ( $query -> row () );
	}

	public function get_statutaire_including_decharges ( $login )
	{
		$this -> db -> select ( "statutaire, decharge" );
		$this -> db -> from ( SELF::TABLE_NAME );
		$this -> db -> join ( "decharge", "login = enseignant" );
		$this -> db -> where ( "login", login );
		$query = $this -> db -> get ();
		
		return $query -> row ()[0] -> statutaire - $query -> row ()[0] -> statutaire;
	}
	
	// UPDATE
	// ------
	
	public function update_nom ( $login, $nom )
	{
		$this -> update_field ( $login, 'nom', $nom );
	}

	public function update_prenom ( $login, $prenom )
	{
		$this -> update_field ( $login, 'prenom', $prenom );
	}

	public function update_password ( $login, $password )
	{
		$securePassword = password_hash ( $password, PASSWORD_DEFAULT );
		$this -> update_field ( $login, 'pwd', $securePassword );
		return $securePassword;
	}

	public function update_email ( $login, $email )
	{
		$this -> update_field ( $login, 'email', $email );
	}

	public function update_statutaire ( $login, $statutaire )
	{
		$this -> update_field ( $login, 'statutaire', $statutaire );
	}

	public function rendre_administrateur ( $login )
	{
		$this -> update_field ( $login, 'administrateur', self::LEVEL_ADMINISTRATEUR );
	}

	public function rendre_enseignant ()
	{
		$this -> update_field ( $login, 'administrateur', self::LEVEL_ENSEIGNANT );
	}

	public function rendre_actif ( $login )
	{
		$this -> update_field ( $login, 'actif', self::ETAT_ACTIF );
	}

	public function rendre_inactif ( $login )
	{
		$this -> update_field ( $login, 'actif', self::ETAT_INACTIF );
	}
	
	// DELETE
	// ------
	
	public function delete ( $login )
	{
		$this -> load -> model ( 'Contenu_model' );
		$this -> Contenu_model -> delete_all_affected_cours ( $login );
		$this -> db -> delete ( self::TABLE_NAME, array ( 
				
				'login' => $login 
		) );
	}
	
	// ============
	// FIELDS CHECK
	// ============
	
	public function exists ( $login )
	{
		$this -> db -> select ( 'login' ); // meaningless
		$this -> db -> where ( 'login', $login );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> num_rows () == 1;
	}

	public function is_actif ( $login )
	{
		$this -> db -> select ( 'actif' );
		$this -> db -> where ( 'login', $login );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> row () -> actif == self::ETAT_ACTIF;
	}

	public function is_admin ( $login )
	{
		$this -> db -> select ( 'administrateur' );
		$this -> db -> where ( 'login', $login );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> row () -> administrateur == self::LEVEL_ADMINISTRATEUR;
	}

	public function verify_password ( $readablePassowrd, $securePassword )
	{
		return password_verify ( $readablePassowrd, $securePassword );
	}
	
	// VALIDATION
	// ----------
	
	public function check_statut ( $statut )
	{
		return in_array ( $statut, $this -> get_allowed_statuts () );
	}

	public function check_statutaire ( $statutaire )
	{
		if ( is_int ( $statutaire ) && $statutaire >= 0 ) {
			return TRUE;
		}
		return FALSE;
	}
	
	// ================
	// FIELDS UTILITIES
	// ================
	
	public function get_allowed_statuts ()
	{
		// TODO: Refactoré ce code pour qu'il aille chercher tout seul toutes les constantes de la classe commencant par 'STATUT_'.
		return array ( 
				
				self::STATUT_ADMINISTRATIF, 
				self::STATUT_CONTRACTUEL, 
				self::STATUT_TITULAIRE, 
				self::STATUT_VACATAIRE 
		);
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
		return strtolower ( $prenom [0] . $nom );
	}
	
	// ================
	// GLOBAL UTILITIES
	// ================
	
	private function create_user_entity ( $queryResult )
	{
		if ( empty ( $queryResult ) ) {
			return FALSE;
		} else {
			$user = array ( 
					
					// Par défaut, on ne renvoie pas le mot de passe.
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

	private function update_field ( $login, $field, $value )
	{
		$this -> db -> where ( 'login', $login );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				$field => $value 
		) );
	}

}
?>