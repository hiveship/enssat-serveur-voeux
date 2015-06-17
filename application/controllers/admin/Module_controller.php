<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Module_controller extends Admin_controller
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
		$this -> get ();
	}

	public function create ()
	{
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$form = $this -> input -> post ();
			
			$ID = $this -> Module_model -> create ( $form ['ID'], $form ['public'], $form ['semestre'], $form ['libelle'] );
			
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
			
			if ( $ID != null ) {
				
				for ( $i = 0 ; $i < sizeof ( $Pnames ) ; $i ++ ) {
					$this -> Cours_model -> create ( $ID ['id'], $Pnames [$i], $Ptype [$i], $Phed [$i] );
				}
				
				flash_info ( 'Module ' . $form ['nom'] . ' crée' );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "le module existe déjà" );
				$this -> load -> template ( 'module/create_module' );
			}
		} else {
			$this -> load -> template ( 'module/create_module' );
		}
	
	}

	public function get ( $ID = null )
	{
		if ( $ID != null ) {
			$this -> check_ID_parameter ( $ID );
			$modules [0] = $this -> Module_model -> get ( $ID );
			$cours [0] = $this -> Cours_model -> get ( $ID );
		} else {
			$modules = $this -> Module_model -> get_all ();
			$cours = array ();
			foreach ( $modules as $module ) {
				$cours [] = $this -> Cours_model -> get ( $module ['id'] );
			}
		}
		$data = array ( 
				
				'cours' => $cours, 
				'modules' => $modules 
		);
		$this -> load -> template ( 'module/get_module_admin', $data );
	}

	public function edit ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$module = $this -> Module_model -> get ( $ID );
		$data = array ( 
				
				'module' => $module 
		);
		$this -> load -> template ( 'module/edit_module', $data );
	}

	public function delete ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> Module_model -> delete ( $ID );
		flash_info ( "module supprimé" );
		redirect ( 'admin/cours', 'auto' );
	}

	public function update ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$nom = $this -> input -> post ( 'nom' );
			$public = $this -> input -> post ( 'public' );
			$semestre = $this -> input -> post ( 'semestre' );
			$libelle = $this -> input -> post ( 'libelle' );
			$responsable = $this -> input -> post ( 'responsable' );
			
			$res = $this -> Module_model -> update ( $ID, $nom, $public, $semestre, $libelle, $responsable );
			if ( $res ) {
				flash_info ( "module " . $this -> input -> post ( 'ID' ) . " mis a jour" );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "nouvel ID invalide" );
				$this -> load -> template ( 'module/edit_module' );
			}
		}
	}

	private function check_ID_parameter ( $ID )
	{
		if ( ! isset ( $ID ) || ! $this -> Module_model -> exists ( $ID ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'admin/cours', 'auto' );
		}
	}

}