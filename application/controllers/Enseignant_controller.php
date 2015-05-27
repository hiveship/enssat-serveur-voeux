<?php

class Enseignant_controller extends ApplicationController
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		$this -> load -> template( 'fake' );
	}

}
?>