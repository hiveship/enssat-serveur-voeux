<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function get ( $login )
	{
		echo $login;
		flash_info( "id récupéré à partir de l'url vaut : " . $id );
		$this -> load -> template( 'enseignants/edit', $this -> session -> userdata( 'me' ) );
	
	}

	public function index ()
	{
		$this -> load -> template( 'fake' );
	}

}
?>
