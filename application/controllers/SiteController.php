<?php
// N'hérite pas de ApplicationController, car c'est la SEULE partie de l'application qui ne nécéssite pas d'authentification préalable.
class SiteController extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> helper( 'form' );
		$this -> load -> library( 'form_validation' );
		$this -> load -> model( 'enseignant/EnseignantModel' );
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
			$me = $this -> EnseignantModel -> get( $this -> input -> post( 'login' ), $this -> input -> post( 'password' ) );
			if ( $me != FALSE ) {
				$this -> session -> set_userdata( 'me', $me );
				flash_success( 'Authentification réussie !' );
				$this -> load -> template( 'fake' );
			} else {
				flash_error( "Echec d'authentification" );
				$this -> load -> template( 'site/login' );
			}
		}
	}

	public function logout ()
	{
		$this -> session -> unset_userdata( 'me' );
		$this -> session -> sess_destroy();
		flash_success( 'Vous êtes désormais déconnecté !' );
		$this -> load -> template( 'site/login' );
	}

}