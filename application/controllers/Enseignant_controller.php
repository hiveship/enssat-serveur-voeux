<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'enseignant/Enseignant_model' );
	}

	public function get ()
	{
		$data ['user'] = $this -> Enseignant_model -> get_user ()[0];
		$data ['title'] = 'Mon Compte';
		
		$this -> load -> template ( 'user/moncompte', $data );
	
	}

	public function index ()
	{
		$this -> load -> template( 'fake' );
	}

}
?>
