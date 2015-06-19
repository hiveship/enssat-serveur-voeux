<?php

include "Application_controller.php";
class Decharge_controller extends Application_controller
{
	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'decharge/Decharge_model' );
		$this -> load -> model ( 'enseignant/Enseignant_model' );
	}
	/**
	 * Récupère les ou la décharge(s) de l'utilisateur actuellement connecté.
	 */
	public function index ()
	{
		$data = array ( 
				
				'decharge' => $this -> Decharge_model -> get ( $this -> session -> userdata ( 'me' )['login'] ) 
		);
		$this -> load -> template ( 'decharge/index', $data );
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
		redirect ( site_url ( 'decharge/index' ) );
	}
	public function update_motif ( $id = null )
	{
		if ( $id != null ) {
			$motif = $this -> input -> post ( 'motif' );
		}
		
		echo $id . "    " . $motif;
		$this -> Decharge_model -> update_motif ( $id, $motif );
		redirect ( site_url ( 'decharge/index' ) );
	}
	/**
	 * Supprime une décharge
	 */
	public function delete ( $id )
	{
		$login = $this -> session -> userdata ( 'me' )['login'];
		
		$enseignant = $this -> Decharge_model -> get_from_id ( $id );
		$enseignant_login = $enseignant [0] ['enseignant'];
		
		if ( $login == $enseignant_login ) {
			$this -> Decharge_model -> delete ( $id );
			redirect ( site_url ( 'decharge/index' ) );
		} else {
			flash_error ( "Non mais oh, on ajoute pas de décharge à ses petits camarade!" );
		}
	}
	public function ajax_get_motif ()
	{
		$id = $this -> input -> post ( 'id' );
		
		$decharge = $this -> Decharge_model -> get_from_id ( $id );
		echo json_encode ( $decharge );
	}
}

?>