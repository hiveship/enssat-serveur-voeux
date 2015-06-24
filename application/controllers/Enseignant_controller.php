<?php

include "Application_controller.php";

class Enseignant_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Enseignant_model' );
		$this -> load -> model ( 'Cours_model' );
		$this -> load -> model ( 'Module_model' );
		$this -> load -> model ( 'Decharge_model' );
	}

	/**
	 * Charge la page permettant à l'utilisateur connecté d'afficher ses informations personelles et des statistiques sur ses cours.
	 */
	public function edit ()
	{
		$data = array ( 
				
				'me' => $this -> session -> userdata ( 'me' ), 
				'total_decharges' => $this -> Decharge_model -> get_sum ( $this -> session -> userdata ( 'me' )['login'] ), 
				'enseigne' => $this -> Enseignant_model -> get_sum_heures ( $this -> session -> userdata ( 'me' )['login'] ), 
				'sum_cm' => $this -> Enseignant_model -> get_sum_cm ( $this -> session -> userdata ( 'me' )['login'] ), 
				'sum_td' => $this -> Enseignant_model -> get_sum_td ( $this -> session -> userdata ( 'me' )['login'] ), 
				'sum_tp_projet' => $this -> Enseignant_model -> get_sum_tp ( $this -> session -> userdata ( 'me' )['login'] ), 
				'sum_ds' => $this -> Enseignant_model -> get_sum_ds ( $this -> session -> userdata ( 'me' )['login'] ) 
		);
		$this -> load -> template ( 'enseignants/edit', $data );
	}

	/**
	 * Charge la liste de tous les enseignants.
	 */
	public function index ()
	{
		$this -> load -> template ( 'enseignants/index', array ( 
				
				'enseignants' => $this -> Enseignant_model -> get_all () 
		) );
	}

	/**
	 * Fonction utilisée pour une requête AJAX.
	 * Retourne les informations de l'utilisateur courament connecté.
	 */
	public function get ()
	{
		echo json_encode ( $this -> Enseignant_model -> get ( $this -> session -> userdata ( 'me' )['login'] ) );
	}

	/**
	 * Change le password de la personne connectée.
	 * Vérification faites du mot de passe courant.
	 */
	public function change_password ()
	{
		// Règles du formulaire
		$this -> form_validation -> set_rules ( 'password', 'Mot de passe (actuel)', 'required' );
		$this -> form_validation -> set_rules ( 'newpassword1', 'Nouveau mot de passe', 'required' );
		$this -> form_validation -> set_rules ( 'newpassword2', 'Nouveau mot de passe (confirmation)', 'required' );
		
		if ( $this -> form_validation -> run () == FALSE ) {
			flash_error ( "Veuillez recommencer, vous n'avez pas rempli le formulaire correctement." );
		} else {
			// Récupère les variables du formulaire
			$newpwd1 = $this -> input -> post ( 'newpassword1' );
			$newpwd2 = $this -> input -> post ( 'newpassword2' );
			$password = $this -> input -> post ( 'password' );
			
			if ( ! $this -> Enseignant_model -> verify_password ( $password, $this -> session -> userdata ( 'me' )['password'] ) ) {
				flash_error ( "Le mot de passe renseigné et le mot de passe actuel ne correspondent pas !" );
			} else if ( $newpwd1 != $newpwd2 ) {
				flash_error ( "Les deux nouveaux mots de passes ne sont pas identiques !" );
			} else {
				// Tout est ok, on procède à la modification.
				$newSecurePassword = $this -> Enseignant_model -> update_password ( $this -> session -> userdata ( 'me' )['login'], $newpwd1 );
				
				// On doit également modifier le contenu des informations de l'utilisateur courant (stockées en session)
				$me = $this -> session -> userdata ( 'me' );
				$me ['password'] = $newSecurePassword;
				$this -> session -> set_userdata ( 'me', $me );
				flash_success ( "Votre mot de passe a bien été modifié !" );
			}
		}
		redirect ( site_url ( 'enseignants/edit' ) );
	}

	/**
	 * Enregistre les modifications de l'utilisateur courant.
	 */
	public function update ()
	{
		$this -> form_validation -> set_rules ( 'email', 'Email', 'required|valid_email' );
		$this -> form_validation -> set_rules ( 'nom', 'Nom', 'required' );
		$this -> form_validation -> set_rules ( 'prenom', 'Prenom', 'required' );
		$this -> form_validation -> set_rules ( 'statutaire', 'Statutaire', 'required' );
		
		if ( $this -> form_validation -> run () == FALSE ) {
			flash_error ( "Erreur dans votre formulaire, le changement n'a pu etre effectué" );
		} else {
			$login = $this -> session -> userdata ( 'me' )['login'];
			$nom = $this -> input -> post ( 'nom' );
			$prenom = $this -> input -> post ( 'prenom' );
			$email = $this -> input -> post ( 'email' );
			$statutaire = $this -> input -> post ( 'statutaire' );
			
			// Update dans la base de donnée - TODO optimiser car trop de requêtes à la BDD que l'on peut regrouperh
			$this -> Enseignant_model -> update_prenom ( $login, $prenom );
			$this -> Enseignant_model -> update_nom ( $login, $nom );
			$this -> Enseignant_model -> update_email ( $login, $email );
			$this -> Enseignant_model -> update_statutaire ( $login, $statutaire );
			
			// Update dans la session (pour avoir les infos en direct sans avoir à se déconnecter avant)
			$me = $this -> session -> userdata ( 'me' );
			$me ['nom'] = $nom;
			$me ['prenom'] = $prenom;
			$me ['email'] = $email;
			$me ['statutaire'] = $statutaire;
			$this -> session -> set_userdata ( 'me', $me );
			
			flash_success ( "Votre compte a bien été mis à jour." );
		}
		redirect ( site_url ( 'enseignants/edit' ) );
	}

	/**
	 * Récupère les cours (modules et parties) auquel l'enseignant spécifié est inscrit.
	 * 
	 * @param string $login
	 *        	login de l'enseignant dont on veut récupérer les cours. Par défaut il s'agit de l'utilisateur courament connecté.
	 */
	public function cours_de ( $login = null )
	{
		if ( $login == null ) {
			$login = $this -> session -> userdata ( 'me' )['login'];
		}
		if ( ! $this -> Enseignant_model -> exists ( $login ) ) { // Si on fournit un login inconnue... Par exemple modification du paramètre passé en GET dans l'URL.
			redirect ( 'cours', auto );
		}
		
		$Ids = array ();
		$modIds = $this -> Cours_model -> get_modules_id_de ( $login );
		foreach ( $modIds as $mod ) {
			array_push ( $Ids, $mod ['module'] );
		}
		
		$modIds = $this -> Module_model -> get_modules_id_de ( $login );
		foreach ( $modIds as $mod ) {
			if ( ! array_search ( $mod ['id'], $Ids ) ) {
				array_push ( $Ids, $mod ['id'] );
			}
		}
		
		$modules = array ();
		$cours = array ();
		foreach ( $Ids as $Id ) {
			array_push ( $modules, $this -> Module_model -> get ( $Id ) );
			array_push ( $cours, $this -> Cours_model -> get_cours_de ( $login, $Id ) );
		}
		
		$data = array ( 
				
				'cours' => $cours, 
				'modules' => $modules 
		);
		$this -> load -> template ( 'cours/get', $data );
	}

	/**
	 * Inscrit l'utilisateur courant à un cours ou nomme un utilisateur responsable de module.
	 */
	public function inscrire ( $module, $cours = null )
	{
		if ( $cours == null ) {
			if ( ! $this -> Module_model -> est_libre ( $module ) ) {
				flash_error ( "il y a déja un responsable ou le module n'exite pas" );
				redirect ( 'cours', 'auto' ); // TODO renomer avec le nom de la bonne route
			}
			$this -> Module_model -> inscrire_responsable ( $module, $this -> session -> userdata ( 'me' )['login'] );
		} else {
			$cours = rawurldecode ( $cours ); // à cause des espaces
			if ( ! $this -> Cours_model -> est_libre ( $module, $cours ) ) {
				flash_error ( "cours occupé ou non existant " . $cours );
				redirect ( 'cours', 'auto' ); // TODO renomer avec le nom de la bonne route
			}
			$this -> Cours_model -> inscrire_enseignant ( $module, $cours, $this -> session -> userdata ( 'me' )['login'] );
			// TODO un flash_success de confirmation ?
		}
		redirect ( 'cours', 'auto' ); // TODO renomer avec le nom de la bonne route
	}

	public function retirer ( $module, $cours = null )
	{
		if ( $cours == null ) {
			$this -> Module_model -> desinscrire_responsable ( $module, $this -> session -> userdata ( 'me' )['login'] );
			// TODO message success
		} else {
			$cours = rawurldecode ( $cours ); // à cause des espaces
			$this -> Cours_model -> desinscrire_enseignant ( $module, $cours, $this -> session -> userdata ( 'me' )['login'] );
			// TODO message success
		}
		redirect ( 'cours', 'auto' ); // TODO renomer avec le nom de la bonne route
	}

	public function get_heures_effectue ( $login = null )
	{
		if ( $login == null ) {
			$login = $this -> session -> userdata ( 'me' )['login'];
		}
		echo $this -> Enseignant_model -> get_sum_heures ( $login );
	}
	
	// TODO devrait plutôt se trouver dans me modèle étant donné que c'est une règle métier
	private function convert_heures ( $heures, $type )
	{
		switch ( $type ) {
			case "CM" :
				return $heures * COEF_CM;
			case "TD" :
				return $heures * COEF_TD;
			case "TP" :
				return $heures * COEF_TP;
			case "DS" :
				return $heures * COEF_DS;
			case "Projet" :
				return $heures * COEF_TP;
			default :
				return $heures;
		}
	}

}
?>
