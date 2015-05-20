<?php

class TodoModel extends CI_Model
{

	public function __construct ()
	{
		// Charge les infos depuis la config. En gros ça établie une connection avec la BDD. On accède à ActiveRecord enssuite via $this->db
		$this -> load -> database();
	}

	public function todo_get_tasks ()
	{
		$query = $this -> db -> get( 'contenu' ); // Equivalent à faire un SELECT * FROM todo
		return $query -> result_array();
	}

}
?>