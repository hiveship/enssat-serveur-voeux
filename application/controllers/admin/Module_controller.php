<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Module_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Module_model' );
		$this -> load -> model ( 'Cours_model' );
		$this -> load -> model ( 'Enseignant_model' );
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
			$form = $this -> input -> post (); // récupère toute les données passées par POST.
			
			$ID = $this -> Module_model -> create ( $form ['ID'], $form ['public'], $form ['semestre'], $form ['libelle'] );
			
			$Pnames = array ();
			$Ptype = array ();
			$Phed = array ();
			foreach ( $form as $key => $value ) {
				if ( strpos ( $key, 'Pname' ) ) {
					array_push ( $Pnames, $value );
				} elseif ( strpos ( $key, 'Ptype' ) ) {
					array_push ( $Ptype, $value );
				} elseif ( strpos ( $key, 'Phed' ) ) {
					array_push ( $Phed, ( int ) $value );
				}
			}
			
			if ( $ID != null ) {
				
				for ( $i = 0 ; $i < sizeof ( $Pnames ) ; $i ++ ) {
					$this -> Cours_model -> create ( $ID ['id'], $Pnames [$i], $Ptype [$i], $Phed [$i] );
				}
				
				flash_info ( 'Module ' . $form ['nom'] . ' crée' );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "Le module existe déjà" );
				$this -> load -> template ( 'admin/module/create' );
			}
		} else {
			$this -> load -> template ( 'admin/modules/create' );
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
				array_push ( $cours, $this -> Cours_model -> get ( $module ['id'] ) );
			}
		}
		$data = array ( 
				
				'cours' => $cours, 
				'modules' => $modules, 
				'enseignant' => $this -> Enseignant_model -> get_all_login_nom_prenom () 
		);
		$this -> load -> template ( 'admin/modules/index', $data );
	}

	public function edit ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$module = $this -> Module_model -> get ( $ID );
		$data = array ( 
				
				'module' => $module 
		);
		$this -> load -> template ( 'admin/modules/edit', $data );
	}

	public function delete ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> Module_model -> delete ( $ID );
		flash_success ( "module supprimé" );
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
				$this -> load -> template ( 'admin/modules/edit' );
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