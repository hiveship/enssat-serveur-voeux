<?php

class ApplicationController extends CI_Controller
{
	const FLASH_LEVEL_SUCCESS = 'success';
	const FLASH_LEVEL_INFO = 'info';
	const FLASH_LEVEL_WARNING = 'warning';
	const FLASH_LEVEL_ERROR = 'error';

	public function __construct ()
	{
		parent::__construct();
		// See https://ellislab.com/codeigniter/user-guide/libraries/sessions.html
		$this -> load -> library( 'session' );
	}

	public function require_login ()
	{
		// TODO: code pour vérifier si il faut être connecté pour accéder à la page.
	}

	public function have_admin_rights ()
	{
		require_login();
		// TODO: code pour vérifier si il faut être administrateur pour accéder à la page.
	}
	
	// ===============
	// FLASH MESSAGES
	// ===============
	
	private static function flash ( $level, $message )
	{
		$this -> session -> set_flashdata( $level, $message );
	}

	public static function flash_success ( $message )
	{
		flash( self::FLASH_LEVEL_SUCCESS, $message );
	}

	public static function flash_error ( $message )
	{
		flash( self::FLASH_LEVEL_ERROR, $message );
	}

	public static function flash_info ( $message )
	{
		flash( self::FLASH_LEVEL_INFO, $message );
	}

	public static function flash_warning ( $message )
	{
		flash( self::FLASH_LEVEL_WARNING, $message );
	}

}
?>