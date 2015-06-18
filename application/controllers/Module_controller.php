<?php

include 'Application_controller.php';

class Module_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> model( 'Module_model' );
		$this -> load -> model( 'Cours_model' );
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
		$this -> load -> template( 'modules/index', $data );
	}

	public function get ( $ID )
	{
		$this -> check_ID_parameter( $ID );
		$modules [0] = $this -> Module_model -> get( $ID );
		$cours [0] = $this -> Cours_model -> get( $ID );
		$data = array (
			
				'modules' => $modules,
				'cours' => $cours
		);
		$this -> load -> template( 'modules/get', $data );
	}

	private function check_ID_parameter ( $ID )
	{
		if ( ! isset( $ID ) || ! $this -> Module_model -> exists( $ID ) ) {
			flash_error( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect( 'Module_controller', 'auto' ); // TODO renomer avec le bon nom de route
		}
	}

}
?>
