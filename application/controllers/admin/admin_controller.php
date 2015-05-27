<?php

class AdminController extends ApplicationController
{

	public function __construct ()
	{
		parent::__construct();
		parent::have_admin_rights();
	}

}
?>