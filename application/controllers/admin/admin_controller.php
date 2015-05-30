<?php
$dir = dirname( __FILE__ );
include ( $dir . '/../Application_controller.php' );

abstract class Admin_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct(); // check login
		$this -> have_admin_rights();
	}

	public function have_admin_rights ()
	{
		if ( ! $this -> session -> userdata( 'me' )['administrateur'] ) {
			flash_warning( "Erreur, cette page est réservée aux administrateurs." );
			redirect( site_url( 'enseignants' ) );
		}
	}

}
?>