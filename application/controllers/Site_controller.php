<?php
// N'hérite pas de Application_controller, car c'est la SEULE partie de l'application qui ne nécéssite pas d'authentification préalable.
class Site_controller extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> helper( 'form' );
		$this -> load -> library( 'form_validation' );
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function index ()
	{
		$this -> load -> template( 'site/login' );
	}

	public function login ()
	{
		$me = $this -> Enseignant_model -> authenticate( $this -> input -> post( 'login' ), $this -> input -> post( 'password' ) );
		if ( $me != FALSE ) {
			if ( ! $me ['actif'] ) {
				flash_warning( "Votre compte est désactivé, veuillez contacter un administrateur." );
				redirect( 'login', 'refresh' );
			} else {
				$this -> session -> set_userdata( 'me', $me ); // Stocké en session (côté serveur) et non en cookie (côté client), donc pas de soucis.
				flash_success( 'Authentification réussie !' );
				redirect( 'enseignants', 'auto' );
			}
		} else {
			flash_error( "Login et/ou mot de passe incorrect !" );
			redirect( 'login', 'refresh' );
		}
	}

	public function logout ()
	{
		if ( $this -> session -> userdata( 'me' ) ) {
			$this -> session -> unset_userdata( 'me' );
			flash_success( 'Vous êtes désormais déconnecté !' );
		}
		// Ne pas faire un appel à session_destroy, sinon les messages flashs seront également perdus.
		redirect( 'login', 'refresh' );
	}

}