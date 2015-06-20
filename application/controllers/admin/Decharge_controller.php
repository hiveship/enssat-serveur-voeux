<?php
$dir = dirname( __FILE__ );
include ( $dir . '/../Application_controller.php' );

class Decharge_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'Decharge_model' );
		$this -> load -> model( 'Enseignant_model' );
	}

	public function index ()
	{
		$data = array ( 
			
				'decharges' => $this -> Decharge_model -> get_all(), 
				// Récupère uniquement les données dont on a besoin pour les décharges (afficher nom et prénom au lieu de simplement le login).
				'enseignant' => $this -> Enseignant_model -> get_all_login_nom_prenom() 
		);
		
		$this -> load -> template( 'admin/decharges/index', $data );
	}

	public function create ()
	{
		$this -> form_validation -> set_rules( 'decharge', 'Decharge', 'required' );
		
		if ( $this -> form_validation -> run() == FALSE ) {
			flash_error( "Vous n'avez pas indiqué la valeur de votre décharge." );
		} else {
			$enseignant = $this -> input -> post( 'choix_enseignant' );
			$new_decharge = $this -> input -> post( 'decharge' ); // Volume horaire de la décharge
			$new_motif = $this -> input -> post( 'motif' );
			$this -> Decharge_model -> add( $enseignant, $new_decharge, $new_motif );
		}
		redirect( site_url( 'admin/decharges' ) );
	}

	/**
	 * Admin supprime une décharge d'un enseignant
	 */
	public function delete ( $id )
	{
		$this -> Decharge_model -> delete( $id );
		redirect( site_url( 'admin/decharges' ) );
	}

}

?>