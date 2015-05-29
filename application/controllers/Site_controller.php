<?php
// N'hérite pas de ApplicationController, car c'est la SEULE partie de l'application qui ne nécéssite pas d'authentification préalable.
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
		$this -> form_validation -> set_rules( 'login', 'Login', 'trim|required' );
		$this -> form_validation -> set_rules( 'password', 'password', 'trim|required' );
		
		if ( $this -> form_validation -> run() === FALSE ) {
			$this -> load -> template( 'site/login' );
		} else {
			$me = $this -> Enseignant_model -> authenticate( $this -> input -> post( 'login' ), $this -> input -> post( 'password' ) );
			if ( $me != FALSE ) {
				// Stocké en session (côté serveur) et non en cookie (côté client), donc pas de soucis.
				$this -> session -> set_userdata( 'me', $me );
				flash_success( 'Authentification réussie !' );
				$this -> load -> template( 'fake' );
				redirect( 'Module_controller/index', 'auto' );
				
				// TODO lors de l'envoie sur une vrai page, ça sera un redirect à placer ici
			} else {
				flash_error( "Echec d'authentification" );
				redirect( 'Site_controller/index', 'refresh' );
				// see: http://stackoverflow.com/questions/4281800/codeigniter-when-to-use-redirect-and-when-to-use-this-load-view
			}
		}
	}

	public function logout ()
	{
		$this -> session -> unset_userdata( 'me' );
		flash_success( 'Vous êtes désormais déconnecté !' );
		// Ne pas faire un appel à session_destroy, sinon les messages flashs seront également perdus.
		redirect( 'Site_controller/index', 'refresh' );
	}

}