<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function edit ( $login )
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

	public function change_password ()
	{
	
	}

	public function change_email ()
	{
		$this -> form_validation -> set_rules( 'newemail', 'NewEmail', 'required|valid_email' );
		
		if ( $this -> form_validation -> run() == FALSE ) {
			flash_error( "pas bon email" );
			$this -> load -> template( 'enseignants/edit', $this -> session -> userdata( 'me' ) );
		} else {
			
			$newemail = $this -> input -> post( 'newemail' );
			$login = $this -> session -> userdata( 'me' )['login'];
			
			$this -> Enseignant_model -> update_email( $login, $newemail );
			
			$me = $this -> session -> userdata( 'me' );
			$me ['email'] = $newemail;
			$this -> session -> set_userdata( 'me', $me );
			flash_success( "yeah" );
			
			$this -> load -> template( 'enseignants/edit', $this -> session -> userdata( 'me' ) );
		}
	
	}

}
?>
