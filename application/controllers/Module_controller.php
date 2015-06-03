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
		$this -> load -> model ( 'cours/Cours_model' );
	}

	public function index ()
	{
		$modules = $this -> Module_model -> get_all ();
		$data = array ( 
				
				'modules' => $modules 
		);
		$this -> load -> template ( 'module/get_module', $data );
	}

	public function create ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$form = $this -> input -> post ();
			
			$test = $this -> Module_model -> create ( $form ['ID'], $form ['public'], $form ['semestre'], $form ['libelle'] );
			
			$Pnames = array ();
			$Ptype = array ();
			$Phed = array ();
			
			foreach ( $form as $key => $value ) {
				if ( strpos ( $key, 'Pname' ) ) {
					$Pnames [] = $value;
				} elseif ( strpos ( $key, 'Ptype' ) ) {
					$Ptype [] = $value;
				} elseif ( strpos ( $key, 'Phed' ) ) {
					$Phed [] = ( int ) $value;
				}
			}
			
			if ( $test ) {
				for ( $i = 0 ; $i < sizeof ( $Pnames ) ; $i ++ ) {
					$this -> Cours_model -> create ( $form ['ID'], $Pnames [$i], $Ptype [$i], $Phed [$i] );
				}
				
				flash_info ( 'Module ' . $form ['ID'] . ' crée' );
				redirect ( 'Module_controller', 'auto' );
			} else {
				flash_error ( "le module existe déjà" );
				$this -> load -> template ( 'module/create_module' );
			}
		} else {
			$this -> load -> template ( 'module/create_module' );
		}
	
	}

	public function get ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$module = $this -> Module_model -> get ( $ID );
		$data = array ( 
				
				'modules' => $module 
		);
		$this -> load -> template ( 'module/get_module', $data );
	}

	public function edit_menu ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$module = $this -> Module_model -> get ( $ID )[0];
		$data = array ( 
				'module' => $module 
		);
		$this -> load -> template ( 'module/edit_module', $data );
	}

	public function delete ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> Module_model -> delete ( $this -> input -> post ( 'ID' ) );
		flash_info ( "module " . $this -> input -> post ( 'ID' ) . " supprimé" );
		redirect ( 'Module_controller', 'auto' );
	}

	public function update ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$nom = $ID;
			$public = $this -> input -> post ( 'public' );
			$semestre = $this -> input -> post ( 'semestre' );
			$libelle = $this -> input -> post ( 'libelle' );
			$responsable = $this -> input -> post ( 'responsable' );
			
			$res = $this -> Module_model -> update ( $ID, $nom, $public, $semestre, $libelle, $responsable );
			if ( $res ) {
				flash_info ( "module " . $this -> input -> post ( 'ID' ) . " mis a jour" );
				redirect ( 'Module_controller', 'auto' );
			} else {
				flash_error ( "nouvel ID invalide" );
				$this -> load -> template ();
				
				$this -> load -> template ( 'module/edit_module' );
			}
		}
	}

	private function check_ID_parameter ( $id )
	{
		if ( ! isset ( $id ) || ! $this -> Module_model -> exists ( $id ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'Module_controller', 'refresh' );
		}
	}

}
?>