<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/../Application_controller.php' );

abstract class Admin_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct (); // check logged in
		$this -> require_admin_privilege ();
	}

	public function require_admin_privilege ()
	{
		if ( ! $this -> session -> userdata ( 'me' )['administrateur'] ) {
			flash_warning ( "Erreur, cette page est réservée aux administrateurs." );
			redirect ( site_url ( 'enseignants' ) );
		}
	}

}
?>