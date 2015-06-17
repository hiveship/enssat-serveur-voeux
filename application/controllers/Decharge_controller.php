<?php

include "Application_controller.php";

class Decharge_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'decharge/Decharge_model' );
		$this -> load -> model( '' );
		$this -> load -> model( 'enseignant/Enseignant_model' );
	}

	public function get_all ()
	{
		
		$enseignants = $this -> Enseignant_model -> get_all_login_nom_prenom();
		
		$decharges = $this -> Decharge_model -> get_all();
		
		$data = array ( 
			
				'decharges' => $decharges, 
				'enseignant' => $enseignants 
		);
		
		$this -> load -> template( 'decharge/decharge_admin', $data );
	}

	/**
	 * Récupère les ou la décharge(s) d'une personne
	 */
	public function get ()
	{
		
		$login = $this -> session -> userdata( 'me' )['login'];
		$decharges = $this -> Decharge_model -> get( $login );
		
		$data = array ( 
			
				'decharge' => $decharges 
		);
		$this -> load -> template( 'decharge/decharge_enseignant', $data );
	}

	/**
	 * Ajoute une décharge, c'est la personne connectée qui s'ajoute une décharge
	 */
	public function add ()
	{
		$login = $this -> session -> userdata( 'me' )['login'];
		$decharge = $this -> Decharge_model -> get( $login );
		$new_decharge = $this -> input -> post( 'decharge' );
		$new_motif = $this -> input -> post( 'motif' );
		
		$this -> form_validation -> set_rules( 'decharge', 'Decharge', 'required' );
		
		if ( $this -> form_validation -> run() == FALSE ) {
			flash_error( "Vous n'avez pas indiqué la valeur de votre décharge." );
			redirect( site_url( 'Decharge_controller/get' ) );
		} else {
			$this -> Decharge_model -> add( $login, $new_decharge, $new_motif );
			redirect( site_url( 'Decharge_controller/get' ) );
		}
	}

	public function add_admin ()
	{
		$enseignant = $this -> input -> post( 'choix_enseignant' );
		var_dump( $enseignant );
	}

	/**
	 * Supprime une décharge
	 */
	public function delete ( $id )
	{
		$this -> Decharge_model -> delete( $id );
		redirect( site_url( 'Decharge_controller/get' ) );
	
	}

	/**
	 * Admin supprime une décharge d'un enseignant
	 */
	public function delete_admin ( $id )
	{
		$this -> Decharge_model -> delete( $id );
		redirect( site_url( 'Decharge_controller/get_all' ) );
	}

}

?>