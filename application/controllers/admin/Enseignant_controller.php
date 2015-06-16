<?php
$dir = dirname( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Enseignant_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function index ()
	{
		$data = array ( 
			
				'enseignants' => $this -> Enseignant_model -> get_all(), 
				'allowedStatuts' => $this -> Enseignant_model -> get_allowed_statuts() 
		);
		$this -> load -> template( 'admin/enseignants/index', $data );
	}

	/**
	 * Méthode utiliée pour une requête AJAX.
	 * Ne pas faire de return, mais juste un "echo <..>" de la valeur à retourner au client
	 */
	public function get ()
	{
		$login = $this -> input -> post( 'login' );
		if ( isset( $login ) ) {
			echo json_encode( $this -> Enseignant_model -> get( $login ) );
		} else {
			echo json_encode( $this -> Enseignant_model -> get( $this -> session -> userdata( 'me' )['login'] ) );
		
		}
	}

	public function create ()
	{
		$nom = strtolower( $this -> input -> post( 'nom' ) );
		$prenom = strtolower( $this -> input -> post( 'prenom' ) );
		$email = strtolower( $this -> input -> post( 'email' ) );
		$statut = strtolower( $this -> input -> post( 'statut' ) );
		$statutaire = intval( $this -> input -> post( 'statutaire' ) );
		$actif = $this -> input -> post( 'actif' );
		$administrateur = $this -> input -> post( 'administrateur' );
		$password = $this -> generate_random_string();
		
		// Double vérification pour assurer l'intégrité de l'application. Le contrôle utiliseur est également traité côté client.
		if ( ! ( $this -> Enseignant_model -> check_statut( $statut ) && $this -> Enseignant_model -> check_statutaire( $statutaire ) ) ) {
			flash_success( "statut -> " . $this -> Enseignant_model -> check_statut( $statut ) );
			flash_warning( "statutaire -> " . $this -> Enseignant_model -> check_statutaire( $statutaire ) );
			
			flash_error( "Informations incorrectes ! Création impossible." );
			redirect( 'admin/enseignants', 'refresh' );
		} else {
			$login = $this -> Enseignant_model -> compute_login( $prenom, $nom );
			if ( ! $this -> Enseignant_model -> exists( $login ) ) {
				$this -> Enseignant_model -> create( $login, $password, $nom, $prenom, $email, $statut, $statutaire, $actif, $administrateur );
				flash_success( "L'enseignant a bien été créé !" );
			} else {
				flash_error( "Cet enseignant éxiste déjà !" );
			}
			redirect( 'admin/enseignants', 'refresh' );
		}
	}

	public function delete ( $login )
	{
		$this -> check_login_parameter( $login );
		if ( $login == $this -> session -> userdata( 'me' )['login'] ) {
			flash_warning( "Vous ne pouvez pas supprimer votre propre compte !" );
		} else {
			$this -> Enseignant_model -> delete( $login );
			flash_success( "Cet utilisateur a bien été supprimé !" );
		}
		redirect( 'admin/enseignants', 'refresh' );
	}

	public function rendre_administrateur ( $login )
	{
		$this -> check_login_parameter( $login );
		if ( $this -> Enseignant_model -> is_admin( $login ) ) {
			flash_warning( "Cet utilisatur est déjà de type administrateur !" );
		} else {
			$this -> Enseignant_model -> rendre_enseignant( $login );
			flash_success( "Cet enseignant a bien été rendu administrateur !" );
		}
		redirect( 'admin/enseignants', 'refresh' );
	}

	public function rendre_enseignant ( $login )
	{
		$this -> check_login_parameter( $login );
		if ( ! $this -> Enseignant_model -> is_admin( $login ) ) {
			flash_warning( "Cet utilisatur est déjà de type enseignant !" );
		} else {
			if ( $login == $this -> session -> userdata( 'me' )['login'] ) {
				flash_warning( "Vous ne pouvez pas vous retirez vous même vos droits d'administrateur !" );
			} else {
				$this -> Enseignant_model -> rendre_enseignant( $login );
				flash_success( "Cet administrateur a bien été rendu enseignant !" );
			}
		}
		redirect( 'admin/enseignants', 'refresh' );
	}

	public function rendre_actif ( $login )
	{
		$this -> check_login_parameter( $login );
		if ( $this -> Enseignant_model -> is_actif( $login ) ) {
			flash_warning( "Cet utilisatur est déjà actif !" );
		} else {
			$this -> Enseignant_model -> rendre_actif( $login );
			flash_success( "Cet enseignant a bien été rendu actif !" );
		
		}
		redirect( 'admin/enseignants', 'refresh' );
	}

	public function rendre_inactif ( $login )
	{
		$this -> check_login_parameter( $login );
		if ( ! $this -> Enseignant_model -> is_actif( $login ) ) {
			flash_warning( "Cet utilisatur est déjà inactif !" );
		} else {
			if ( $login == $this -> session -> userdata( 'me' )['login'] ) {
				flash_warning( "Vous ne pouvez pas désactiver votre propre compte !" );
			} else {
				$this -> Enseignant_model -> rendre_inactif( $login );
				flash_success( "Cet enseignant a bien été rendu inactif !" );
			}
		}
		redirect( 'admin/enseignants', 'refresh' );
	}

	private function check_login_parameter ( $login )
	{
		if ( ! isset( $login ) || ! $this -> Enseignant_model -> exists( $login ) ) {
			flash_error( "Vous devez spécifier un login d'utilisateur valide !" );
			redirect( 'admin/enseignants', 'refresh' );
		}
	}

	private function generate_random_string ()
	{
		// TODO: trouver mieux ?
		return substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?~#@' ), 0, 10 );
	}

}
?>
