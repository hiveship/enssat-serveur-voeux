<?php

class Application_controller extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		$this -> load -> template( 'site/login' );
	}
	
	// ============
	// CHECK RIGHTS
	// ============
	
	public function require_login ()
	{
		if ( $this -> session -> userdata( 'me' ) == NULL ) {
			flash_warning( "Cette page nécéssite d'être connecté !" );
			// $this -> load -> template( 'site/login' );
			redirect( 'Site_controller/index', 'auto' );
		}
	}

	public function have_admin_rights ()
	{
		$this -> load() -> model( 'Enseignant_model' );
		require_login();
		$me = $this -> session -> userdata( 'me' );
		if ( $me ['level'] !== Enseignant_model::ADMINISTRATEUR ) {
			flash_error( "Erreur, cette page est réservée aux administrateurs." );
			// TODO redirect to root path
		}
	}

}
?>