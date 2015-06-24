<?php

include 'Application_controller.php';

class Module_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Module_model' );
		$this -> load -> model ( 'Cours_model' );
	}

	/**
	 * affiche la liste de tout les modules avec les cours
	 */
	public function index ()
	{
		$modules = $this -> Module_model -> get_all ();
		$cours = array ();
		foreach ( $modules as $module ) {
			array_push ( $cours, $this -> Cours_model -> get ( $module ['id'] ) );
		}
		$data = array ( 
				
				'cours' => $cours, 
				'modules' => $modules 
		);
		$this -> load -> template ( 'modules/index', $data );
	}

	/**
	 * verifie que le ID passé en paramettre est valide
	 * 
	 * @param string $ID
	 *        	a valider
	 */
	private function check_ID_parameter ( $ID )
	{
		if ( ! isset ( $ID ) || ! $this -> Module_model -> exists ( $ID ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'cours', 'auto' );
		}
	}

}
?>
