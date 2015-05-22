<?php
// N'hérite pas de ApplicationController, car c'est la SEULE partie de l'application qui ne nécéssite pas d'authentification préalable.
class SiteController extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> library( 'session' );
		$this -> load -> helper( 'url' );
		$this -> load -> helper( 'form' );
		$this -> load -> library( 'form_validation' );
		$this -> load -> model( 'enseignant/EnseignantModel' );
	}

	public function index ()
	{
		$this -> load -> view( 'site/login' );
	}

	public function login ()
	{
		$this -> form_validation -> set_rules( 'login', 'login', 'required' );
		$this -> form_validation -> set_rules( 'password', 'password', 'required' );
		
		$login = $this -> input -> post( 'login' );
		$pasword = $this -> input -> post( 'password' );
		$me = $this -> EnseignantModel -> get( $login, $password );
		if ( $me != FALSE ) {
			ApplicationController::flash_error( "Vous êtes désormais connecté !" );
			// redirect('page voulue');
		} else {
			ApplicationController::flash_error( "Erreur d'authentification !" );
			redirect( 'site/login' );
		}
	}

	public function logout ()
	{
		$this -> session -> unset_userdata( 'me' );
		$this -> session -> sess_destroy();
		$this -> load -> view( 'site/login' );
	}

}