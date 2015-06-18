<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Enseignant_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'enseignant/Enseignant_model' );
		$this -> load -> model ( 'cours/Cours_model' );
		$this -> load -> model ( 'cours/Module_model' );
	}

	public function index ()
	{
		$data = array ( 
				
				'enseignants' => $this -> Enseignant_model -> get_all (), 
				'allowedStatuts' => $this -> Enseignant_model -> get_allowed_statuts () 
		);
		$this -> load -> template ( 'admin/enseignants/index', $data );
	}

	/**
	 * Méthode utiliée pour une requête AJAX.
	 * Ne pas faire de return, mais juste un "echo <..>" de la valeur à retourner au client
	 */
	public function get ()
	{
		$login = $this -> input -> post ( 'login' );
		if ( ! isset ( $login ) ) {
			$login = $this -> session -> userdata ( 'me' )['login'];
		}
		echo json_encode ( $this -> Enseignant_model -> get ( $login ) );
	}

	public function create ()
	{
		// TODO ajouter les règles de formulaires et traiter le cas d'erreur (déjà un premier contrôle client en JS éffectué).
		
		// On ne stocke en base de donnée que des données en minuscule
		$nom = strtolower ( $this -> input -> post ( 'nom' ) );
		$prenom = strtolower ( $this -> input -> post ( 'prenom' ) );
		$email = strtolower ( $this -> input -> post ( 'email' ) );
		$statut = strtolower ( $this -> input -> post ( 'statut' ) );
		$statutaire = intval ( $this -> input -> post ( 'statutaire' ) );
		$actif = $this -> input -> post ( 'actif' );
		$administrateur = $this -> input -> post ( 'administrateur' );
		$password = $this -> generate_random_string (); // Le mot de passe est généré automatiquement
		
		if ( ! ( $this -> Enseignant_model -> check_statut ( $statut ) && $this -> Enseignant_model -> check_statutaire ( $statutaire ) ) ) {
			flash_error ( "Informations incorrectes ! Création impossible." );
			redirect ( 'admin/enseignants', 'refresh' );
		} else {
			$login = $this -> Enseignant_model -> compute_login ( $prenom, $nom );
			if ( ! $this -> Enseignant_model -> exists ( $login ) ) {
				$this -> Enseignant_model -> create ( $login, $password, $nom, $prenom, $email, $statut, $statutaire, $actif, $administrateur );
				flash_success ( "L'enseignant a bien été créé !" );
			} else {
				flash_error ( "Cet enseignant éxiste déjà !" );
			}
			redirect ( 'admin/enseignants', 'refresh' );
		}
	}
	
	// FIXME refacto
	public function edit ( $login )
	{
		$this -> check_login_parameter ( $login );
		
		$this -> form_validation -> set_rules ( 'nom', 'Nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'prenom', 'Prénom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'email', 'Adresse email', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$nom = strtolower ( $this -> input -> post ( 'nom' ) );
			$prenom = strtolower ( $this -> input -> post ( 'prenom' ) );
			$email = strtolower ( $this -> input -> post ( 'email' ) );
			$statut = strtolower ( $this -> input -> post ( 'statut' ) );
			$statutaire = intval ( $this -> input -> post ( 'statutaire' ) );
			$actif = $this -> input -> post ( 'actif' );
			$administrateur = $this -> input -> post ( 'administrateur' );
			
			// FIXME créer une méthode globale dans le modèle car là on fait trop de requêtes individuelles à la BDD, pas top pour les performances.
			$this -> Enseignant_model -> update_nom ( $login, strtolower ( $this -> input -> post ( 'nom' ) ) );
			$this -> Enseignant_model -> update_prenom ( $login, strtolower ( $this -> input -> post ( 'prenom' ) ) );
			$this -> Enseignant_model -> update_email ( $login, strtolower ( $this -> input -> post ( 'email' ) ) );
			$this -> Enseignant_model -> update_statut ( $login, strtolower ( $this -> input -> post ( 'statut' ) ) );
			$this -> Enseignant_model -> update_statutaire ( $login, strtolower ( $this -> input -> post ( 'statutaire' ) ) );
			
			if ( $this -> input -> post ( 'actif' ) == 1 ) {
				$this -> Enseignant_model -> rendre_actif ( $login );
			} else {
				$this -> Enseignant_model -> rendre_inactif ( $login );
			}
			if ( $this -> input -> post ( 'administrateur' ) == 1 ) {
				$this -> Enseignant_model -> rendre_administrateur ( $login );
			} else {
				$this -> Enseignant_model -> rendre_enseignant ( $login );
			}
		}
		redirect ( site_url ( 'admin/enseignants' ) );
	}

	public function delete ( $login )
	{
		$this -> check_login_parameter ( $login );
		if ( $login == $this -> session -> userdata ( 'me' )['login'] ) {
			flash_warning ( "Vous ne pouvez pas supprimer votre propre compte !" );
		} else {
			$this -> Enseignant_model -> delete ( $login );
			flash_success ( "Cet utilisateur a bien été supprimé !" );
		}
		redirect ( 'admin/enseignants', 'refresh' );
	}
	
	// Cette fonction est correct mais acctuellement non utilisée dans les vues.
	public function rendre_administrateur ( $login )
	{
		$this -> check_login_parameter ( $login );
		if ( $this -> Enseignant_model -> is_admin ( $login ) ) {
			flash_warning ( "Cet utilisatur est déjà de type administrateur !" );
		} else {
			$this -> Enseignant_model -> rendre_enseignant ( $login );
			flash_success ( "Cet enseignant a bien été rendu administrateur !" );
		}
		redirect ( 'admin/enseignants', 'refresh' );
	}
	
	// Cette fonction est correct mais acctuellement non utilisée dans les vues.
	public function rendre_enseignant ( $login )
	{
		$this -> check_login_parameter ( $login );
		if ( ! $this -> Enseignant_model -> is_admin ( $login ) ) {
			flash_warning ( "Cet utilisatur est déjà de type enseignant !" );
		} else {
			if ( $login == $this -> session -> userdata ( 'me' )['login'] ) {
				flash_warning ( "Vous ne pouvez pas vous retirez vous même vos droits d'administrateur !" );
			} else {
				$this -> Enseignant_model -> rendre_enseignant ( $login );
				flash_success ( "Cet administrateur a bien été rendu enseignant !" );
			}
		}
		redirect ( 'admin/enseignants', 'refresh' );
	}
	
	// Cette fonction est correct mais acctuellement non utilisée dans les vues.
	public function rendre_actif ( $login )
	{
		$this -> check_login_parameter ( $login );
		if ( $this -> Enseignant_model -> is_actif ( $login ) ) {
			flash_warning ( "Cet utilisatur est déjà actif !" );
		} else {
			$this -> Enseignant_model -> rendre_actif ( $login );
			flash_success ( "Cet enseignant a bien été rendu actif !" );
		
		}
		redirect ( 'admin/enseignants', 'refresh' );
	}
	
	// Cette fonction est correct mais acctuellement non utilisée dans les vues.
	public function rendre_inactif ( $login )
	{
		$this -> check_login_parameter ( $login );
		if ( ! $this -> Enseignant_model -> is_actif ( $login ) ) {
			flash_warning ( "Cet utilisatur est déjà inactif !" );
		} else {
			if ( $login == $this -> session -> userdata ( 'me' )['login'] ) {
				flash_warning ( "Vous ne pouvez pas désactiver votre propre compte !" );
			} else {
				$this -> Enseignant_model -> rendre_inactif ( $login );
				flash_success ( "Cet enseignant a bien été rendu inactif !" );
			}
		}
		redirect ( 'admin/enseignants', 'refresh' );
	}

	public function retirer ( $login, $module, $cours = null )
	{
		if ( $cours == null ) {
			$this -> Module_model -> desinscrire_responsable ( $module, $login );
			// TODO message success
		} else {
			$cours = rawurldecode ( $cours );
			$this -> Cours_model -> desinscrire_enseignant ( $module, $cours, $login );
			// TODO message success
		}
		redirect ( 'Module_controller', 'auto' ); // TODO renomer avec le nom de la bonne route
	}
	
	// =========
	// UTILITIES
	// =========
	
	private function check_login_parameter ( $login )
	{
		if ( ! isset ( $login ) || ! $this -> Enseignant_model -> exists ( $login ) ) {
			flash_error ( "Vous devez spécifier un login d'utilisateur valide !" );
			redirect ( 'admin/enseignants', 'refresh' );
		}
	}

	private function generate_random_string ()
	{
		// TODO: trouver mieux ?
		return substr ( str_shuffle ( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?~#@' ), 0, 10 );
	}

}
?>
