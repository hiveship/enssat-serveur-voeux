<?php
// N'hérite pas de ApplicationController, car c'est la SEULE partie de l'application qui ne nécéssite pas d'authentification préalable.
class SiteController extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> library( 'session' );
		$this -> load -> model( 'enseignant/EnseignantModel' );
	}

	public function login ()
	{
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