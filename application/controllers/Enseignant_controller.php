<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'enseignant/Enseignant_model' );
	}

	public function edit ( $login )
	{
		flash_info ( "id récupéré à partir de l'url vaut : " . $login );
		$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
	}

	public function index ()
	{
		$data = array ( 
				
				'enseignants' => $this -> Enseignant_model -> get_all () 
		);
		$this -> load -> template ( 'enseignants/index', $data );
	}

	public function change_password ()
	{
		// Récupère les variables du formulaire
		$newpwd1 = $this -> input -> post ( 'newpassword1' );
		$newpwd2 = $this -> input -> post ( 'newpassword2' );
		$password = $this -> input -> post ( 'password' );
		
		// Règles du formulaire
		$this -> form_validation -> set_rules ( 'newpassword1', 'NewPassword1', 'required' );
		$this -> form_validation -> set_rules ( 'newpassword1', 'NewPassword1', 'required' );
		
		$me = $this -> Enseignant_model -> authenticate ( $this -> session -> userdata ( 'me' )['login'], $password );
		
		if ( $me ) {
			if ( $this -> form_validation -> run () == FALSE ) {
				flash_error ( "Veuillez recommencer, vous n'avez pas rempli le formulaire correctement." );
				$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			} else if ( $newpwd1 != $newpwd2 ) {
				flash_error ( "Veuillez recommencer, la confirmation de votre nouveau mot de passe n'est pas correct" );
				$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			
			} else if ( $newpwd1 == $newpwd2 ) {
				
				$this -> Enseignant_model -> update_password ( $this -> session -> userdata ( 'me' )['login'], $newpwd1 );
				
				flash_success ( "Le mot de passe a bien été changé ! :D" );
				$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			}
		} else {
			flash_error ( "Veuillez recommencer, vous n'avez pas donné le bon mot de passe." );
			$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
		}
	
	}

	public function change_email ()
	{
		$this -> form_validation -> set_rules ( 'newemail', 'NewEmail', 'required|valid_email' );
		
		if ( $this -> form_validation -> run () == FALSE ) {
			flash_error ( "Votre email n'est pas valide, veuillez recommencer." );
			$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			if ( $this -> form_validation -> run () == FALSE ) {
				flash_error ( "pas bon email" );
				$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			} else {
				
				$newemail = $this -> input -> post ( 'newemail' );
				$login = $this -> session -> userdata ( 'me' )['login'];
				
				$this -> Enseignant_model -> update_email ( $login, $newemail );
				
				$me = $this -> session -> userdata ( 'me' );
				$me ['email'] = $newemail;
				$this -> session -> set_userdata ( 'me', $me );
				flash_success ( "yeah" );
				
				$this -> Enseignant_model -> update_email ( $login, $newemail );
				
				$me = $this -> session -> userdata ( 'me' );
				$me ['email'] = $newemail;
				$this -> session -> set_userdata ( 'me', $me );
				flash_success ( "Le changement de votre adresse email a bien été effectué." );
				
				$this -> load -> template ( 'enseignants/edit', $this -> session -> userdata ( 'me' ) );
			}
		
		}
	
	}

}
?>
