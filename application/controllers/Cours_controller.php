<?php
include 'Application_controller.php';

class Cours_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> helper ( 'form' );
		$this -> load -> library ( 'form_validation' );
		$this -> load -> model ( 'cours/Module_model' );
		$this -> load -> model ( 'cours/Cours_model' );
	}

	public function index ()
	{
		$modules = $this -> Module_model -> get_all ();
		$cours = array ();
		foreach ( $modules as $module ) {
			$cours [] = $this -> Cours_model -> get ( $module ['id'] );
		}
		$data = array ( 
				'cours' => $cours, 
				'modules' => $modules 
		);
		$this -> load -> template ( 'module/get_module', $data );
	}

	function get ( $module, $partie = NULL )
	{
	
	}

	public function edit ()
	{
	
	}

	public function create ( $module = NULL )
	{
		if ( $module == NULL ) {
			redirect ( 'Module_controller', 'auto' );
		}
		
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$part = $this -> input -> post ( 'nom' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			if ( ! $this -> Cours_model -> exists ( $module, $part ) ) {
				$this -> Cours_model -> create ( $module, $part, $type, $hed );
				redirect ( 'Module_controller', 'auto' );
			} else {
				flash_error ( "la partie existe déja" );
			}
		}
		$data = array ( 
				'module' => $module 
		);
		$this -> load -> template ( 'cours/create', $data );
	}

	function delete ( $module, $partie )
	{
		$this -> check_parameters ( $module, $partie );
		$this -> Cours_model -> delete ( $module, $partie );
		redirect ( 'Module_controller', 'auto' );
	}

	private function check_parameters ( $module, $partie )
	{
		if ( ! isset ( $partie ) || ! isset ( $module ) || ! $this -> Cours_model -> exists ( $module, $partie ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'Module_controller', 'auto' );
		}
	}

}
?>