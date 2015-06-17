<?php
include 'Application_controller.php';

class Cours_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'cours/Module_model' );
		$this -> load -> model( 'cours/Cours_model' );
	}

	public function index ()
	{
		$modules = $this -> Module_model -> get_all();
		$cours = array ();
		foreach ( $modules as $module ) {
			array_push( $cours, $this -> Cours_model -> get( $module ['id'] ) );
		}
		$data = array ( 
			
				'cours' => $cours, 
				'modules' => $modules 
		);
		$this -> load -> template( 'module/index', $data );
	}

}
?>