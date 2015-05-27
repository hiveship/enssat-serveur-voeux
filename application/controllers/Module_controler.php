<?php

class Module_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
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
		}
	}

}

?>