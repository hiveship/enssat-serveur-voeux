<?php

include "Application_controller.php";

class Decharge_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Decharge_model' );
		$this -> load -> model ( 'Enseignant_model' );
	}

	/**
	 * Récupère la ou les décharge(s) de l'utilisateur actuellement connecté.
	 */
	public function index ()
	{
		$this -> load -> template ( 'decharges/index', array ( 
				
				'decharge' => $this -> Decharge_model -> get ( $this -> session -> userdata ( 'me' )['login'] ) 
		) );
	}

	/**
	 * Ajoute une décharge, c'est la personne connectée qui s'ajoute une décharge
	 */
	public function create ()
	{
		$this -> form_validation -> set_rules ( 'decharge', 'Decharge', 'required' );
		
		if ( $this -> form_validation -> run () == FALSE ) {
			flash_error ( "Vous n'avez pas indiqué la valeur de votre décharge." );
		} else {
			$login = $this -> session -> userdata ( 'me' )['login'];
			$new_decharge = $this -> input -> post ( 'decharge' ); // Volume horaire de la décharge
			$new_motif = $this -> input -> post ( 'motif' );
			$this -> Decharge_model -> add ( $login, $new_decharge, $new_motif );
		}
		redirect ( site_url ( 'decharges' ) );
	}

	/**
	 * Modifie le motif d'une décharge de l'utilisateur connecté.
	 * 
	 * @param unknown $id        	
	 */
	public function update_motif ( $id )
	{
		// TODO vérifier que l'ID passé en paramètre appartient bien à l'utilisateur courrant.
		$this -> Decharge_model -> update_motif ( $id, $this -> input -> post ( 'motif' ) );
		redirect ( site_url ( 'decharges' ) );
	}

	/**
	 * Supprime une décharge de l'utilisateur actuellement connecté.
	 */
	public function delete ( $id )
	{
		$login = $this -> session -> userdata ( 'me' )['login'];
		$enseignant = $this -> Decharge_model -> get_from_id ( $id );
		$enseignant_login = $enseignant [0] ['enseignant'];
		
		if ( $login == $enseignant_login || $this -> session -> userdata ( 'me' )['administrateur'] == 1 ) {
			$this -> Decharge_model -> delete ( $id );
			// TODO flash success
			redirect ( site_url ( 'decharges' ) );
		} else {
			flash_error ( "Non mais oh, on ajoute pas de décharge à ses petits camarade!" );
		}
	}

	/**
	 * Génère un motif correspondant à son id en JSON.
	 */
	public function ajax_get_motif ()
	{
		echo json_encode ( $this -> Decharge_model -> get_from_id ( $this -> input -> post ( 'id' ) ) );
	}

}

?>