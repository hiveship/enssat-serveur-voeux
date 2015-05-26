<?php

class ApplicationController extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
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

}
?>