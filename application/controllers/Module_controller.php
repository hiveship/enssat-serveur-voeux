<?php

include 'Application_controller.php';

class Module_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> helper ( 'form' );
		$this -> load -> library ( 'form_validation' );
		$this -> load -> model ( 'cours/Module_model' );
	
	}

	public function index ()
	{
		$modules = $this -> Module_model -> get_all();
		$data = array ( 
			
				'modules' => $modules 
		);
		$this -> load -> template( 'cours/aff_get_module', $data );
	}

	public function create ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		// TODO posibilitée d'ajouter un responsable de module
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$ID = $this -> input -> post ( 'ID' );
			$public = $this -> input -> post ( 'public' );
			$semestre = $this -> input -> post ( 'semestre' );
			$libelle = $this -> input -> post ( 'libelle' );
			$this -> Module_model -> create ( $ID, $public, $semestre, $libelle );
			flash_info ( 'Module ' . $ID . ' crée' );
			$this -> load -> template ( 'fake' );
		} else {
			$this -> load -> template ( 'cours/create_module' );
		}
	}

	public function get_all ()
	{
		$modules = $this -> Module_model -> get_all ();
		$data = array ( 
				'modules' => $modules 
		);
		$this -> load -> template ( 'cours/aff_get_module', $data );
	}

	public function get ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		if ( $this -> form_validation -> run () === TRUE ) {
			$module = $this -> Module_model -> get ( $this -> input -> post ( 'ID' ) );
			$data = array ( 
					'modules' => $module 
			);
			$this -> load -> template ( 'cours/aff_get_module', $data );
		} else {
			$this -> load -> template ( 'cours/get_module' );
		}
	}

	public function edit_menu ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		if ( $this -> form_validation -> run () === TRUE ) {
			$module = $this -> Module_model -> get ( $this -> input -> post ( 'ID' ) )[0];
			$data = array ( 
					'module' => $module 
			);
			$this -> load -> template ( 'cours/edit_module', $data );
		
		} else {
			$this -> load -> template( 'cours/get_module' );
		}
	}

	public function delete ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		if ( $this -> form_validation -> run () === TRUE ) {
			// $this -> Module_model -> delete ( $this -> input -> post ( 'ID' ) );
			flash_info ( "module " . $this -> input -> post ( 'ID' ) . " supprimé" );
			$this -> load -> template ( 'fake' );
		}
	}

	public function update_remove ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			if ( $this -> input -> post ( 'req' ) == 'delete' ) {
				echo "test";
				$this -> Module_model -> delete ( $this -> input -> post ( 'ID_orig' ) );
			
			}
		}
	}

}
?>