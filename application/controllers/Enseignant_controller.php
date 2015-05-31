<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function edit ()
	{
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
		// Règles du formulaire
		$this -> form_validation -> set_rules( 'password', 'Mot de passe (actuel)', 'required' );
		$this -> form_validation -> set_rules( 'newpassword1', 'Nouveau mot de passe', 'required' );
		$this -> form_validation -> set_rules( 'newpassword2', 'Nouveau mot de passe (confirmation)', 'required' );
		
		if ( $this -> form_validation -> run() == FALSE ) {
			flash_error( "Veuillez recommencer, vous n'avez pas rempli le formulaire correctement." );
		} else {
			// Récupère les variables du formulaire
			$newpwd1 = $this -> input -> post( 'newpassword1' );
			$newpwd2 = $this -> input -> post( 'newpassword2' );
			$password = $this -> input -> post( 'password' );
			
			if ( ! $this -> Enseignant_model -> verify_password( $password, $this -> session -> userdata( 'me' )['password'] ) ) {
				flash_error( "Le mot de passe renseigné n'est pas correct !" );
			} else if ( $newpwd1 != $newpwd2 ) {
				flash_error( "Les deux nouveaux mots de passes ne sont pas identiques !" );
			} else {
				$newSecurePassword = $this -> Enseignant_model -> update_password( $this -> session -> userdata( 'me' )['login'], $newpwd1 );
				$me = $this -> session -> userdata( 'me' );
				$me ['password'] = $newSecurePassword;
				$this -> session -> set_userdata( 'me', $me );
				flash_success( "Votre mot de passe a bien été modifié !" );
			}
		}
		redirect( site_url( 'enseignants/edit' ) );
	}

	public function change_email ()
	{
		$this -> form_validation -> set_rules( 'newemail', 'Email', 'required|valid_email' );
		
		if ( $this -> form_validation -> run() == FALSE ) {
			flash_error( "Votre email n'est pas valide, veuillez recommencer." );
		} else {
			$newemail = $this -> input -> post( 'newemail' );
			$this -> Enseignant_model -> update_email( $this -> session -> userdata( 'me' )['login'], $newemail );
			$me = $this -> session -> userdata( 'me' );
			$me ['email'] = $newemail;
			$this -> session -> set_userdata( 'me', $me );
			flash_success( "Le changement de votre adresse email a bien été effectué." );
		}
		redirect( site_url( 'enseignants/edit' ) );
	}

}
?>
