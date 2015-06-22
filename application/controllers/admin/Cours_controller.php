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
		if ( $module == NULL ) {
			redirect ( 'admin/cours', 'auto' );
		}
		
		$modules = array ( 
				'module' => $module 
		);
		
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$part = $this -> input -> post ( 'nom' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			if ( ! $this -> Cours_model -> exists ( $module, $part ) ) {
				$this -> Cours_model -> create ( $module, $part, $type, $hed );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "la partie existe déja" );
			}
		}
		
		$this -> load -> template ( 'admin/cours/create', $modules );
	}

	public function delete ( $module, $partie )
	{
		$partie = rawurldecode ( $partie );
		$this -> check_parameters ( $module, $partie );
		$this -> Cours_model -> delete ( $module, $partie );
		redirect ( 'admin/cours', 'auto' );
	}

	public function get_ajax ( $module, $partie )
	{
		$partie = rawurldecode ( $partie );
		$this -> check_parameters ( $module, $partie );
		echo json_encode ( $this -> Cours_model -> get ( $module, $partie ) );
	}

	private function check_parameters ( $module, $partie )
	{
		if ( ! isset ( $partie ) || ! isset ( $module ) || ! $this -> Cours_model -> exists ( $module, $partie ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $module . "  " . $partie );
			redirect ( 'admin/cours', 'auto' );
		}
	}

}
?>