<?php

class Application_controller extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> require_login ();
	}

	public function index ()
	{
		$this -> load -> template ( 'site/login' );
	}

	public function require_login ()
	{
		if ( ! $this -> session -> userdata ( 'me' ) ) {
			flash_warning ( "Cette page nécéssite d'être connecté !" );
			redirect ( 'login', 'auto' );
		}
	}

}
?>