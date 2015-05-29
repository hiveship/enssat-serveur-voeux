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
		flash_info( "id récupéré à partir de l'url vaut : " . $login );
		$this -> load -> template( 'enseignants/edit', $this -> session -> userdata( 'me' ) );
	}

	public function index ()
	{
		$data = array ( 
			
				'enseignants' => $this -> Enseignant_model -> get_all() 
		);
		$this -> load -> template( 'enseignants/index', $data );
	}

	public function rendre_administrateur ( $login )
	{
		// TODO controls
		$this -> Enseignant_model -> rendre_administrateur( $login );
		flash_success( "L'utilisateur a bien été nommé administrateur !" );
		redirect( "Enseignant_controller/index", "refresh" );
	}

}
?>
