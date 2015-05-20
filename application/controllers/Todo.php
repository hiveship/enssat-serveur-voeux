<?php

class Todo extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		// Chargement des modèles et des helpers (librairies) nécéssaires.
		$this -> load -> model( 'TodoModel' ); // Définis également le nom pour accéder au modèle
		$this -> load -> helper( 'url' );
	}

	public function index ()
	{
		// Gestion des flash-like à faire ici
		$this -> load -> helper( 'form' );
		$this -> load -> library( 'form_validation' );
		
		$data ['todolist'] = $this -> TodoModel -> todo_get_tasks();
		$this -> load -> view( 'task_list', $data );
	}

}
?>