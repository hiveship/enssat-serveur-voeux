<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Cours_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Module_model' );
		$this -> load -> model ( 'Cours_model' );
	}

	/**
	 *
	 * @param string $module        	
	 * @param string $partie        	
	 */
	public function edit ( $module, $partie )
	{
		$partie = rawurldecode ( $partie );
		$this -> check_parameters ( $module, $partie );
		
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$partie_new = $this -> input -> post ( 'nom' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			if ( $partie != $partie_new && $this -> Cours_model -> exists ( $module, $partie_new ) ) {
				flash_error ( "nom de module déja alloué ! " );
				redirect ( 'admin/cours/edit/' . $module . '/' . $partie, 'auto' );
			}
			$this -> Cours_model -> update ( $module, $partie, $partie_new, $type, $hed );
			redirect ( 'admin/cours', 'auto' );
		}
		
		$this -> load -> template ( 'admin/cours/edit', $this -> Cours_model -> get ( $module, $partie )[0] );
	}

	/**
	 * Permet de créer une partie dans un module.
	 * 
	 * @param string $module        	
	 */
	public function create ( $module = NULL )
	{
		// verification de de l'existance du module
		if ( $module == NULL ) {
			redirect ( 'admin/cours', 'auto' );
		}
		
		// preparation en cas d'erreur
		$modules = array ( 
				
				'module' => $module 
		);
		
		// préparation verification formulaire
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		// vérification formulaire
		if ( $this -> form_validation -> run () === TRUE ) {
			$part = $this -> input -> post ( 'nom' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			
			// verification de l'unicitée de la partie
			if ( ! $this -> Cours_model -> exists ( $module, $part ) ) {
				$this -> Cours_model -> create ( $module, $part, $type, $hed );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "la partie existe déja" );
			}
		}
		
		$this -> load -> template ( 'admin/cours/create', $modules );
	}

	/**
	 * supprime une partie transmise en parametre
	 * 
	 * @param string $module
	 *        	identifiant du module de la partie à supprimer
	 * @param string $partie
	 *        	nom de la partie à supprimer
	 */
	public function delete ( $module, $partie )
	{
		$partie = rawurldecode ( $partie );
		$this -> check_parameters ( $module, $partie );
		$this -> Cours_model -> delete ( $module, $partie );
		redirect ( 'admin/cours', 'auto' );
	}

	/**
	 * retourne sous la forme de Json la partie transmise en parametre
	 * 
	 * @param string $module
	 *        	identifiant du module de la partie à recuperer
	 * @param string $partie
	 *        	nom de la partie à recupérer
	 */
	public function get_ajax ( $module, $partie )
	{
		$partie = rawurldecode ( $partie );
		$this -> check_parameters ( $module, $partie );
		echo json_encode ( $this -> Cours_model -> get ( $module, $partie ) );
	}

	/**
	 * verifie l'existance d'une partie
	 * 
	 * @param string $module
	 *        	identifiant du module de la partie à verifier
	 * @param string $partie
	 *        	nom de la partie à verifier
	 */
	private function check_parameters ( $module, $partie )
	{
		if ( ! isset ( $partie ) || ! isset ( $module ) || ! $this -> Cours_model -> exists ( $module, $partie ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $module . "  " . $partie );
			redirect ( 'admin/cours', 'auto' );
		}
	}

}
?>