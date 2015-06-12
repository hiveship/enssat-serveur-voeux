<?php

class Affectation_model extends CI_Model
{
	// =========
	// CONSTANTS
	// =========
	
	const TABLE_NAME = 'contenu';
	
	// =================
	// MODEL CONSTRUCTOR
	// =================
	
	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
		// Utilisation d'Active Record pour les requêtes à la base de données: abstraction du SGBD.
	}
	
	// CREATE
	// ------
	
	public function create ( $module, $partie, $type, $heuresTD, $loginEnseignant )
	{
		$this -> db -> insert( self::TABLE_NAME, array ( 
			
				'module' => $module, 
				'partie' => $partie, 
				'hed' => $heuresTD, 
				'type' => $type, 
				'enseignant' => $loginEnseignant, 
				'statut' => $statut, 
				'statutaire' => $statutaire, 
				'actif' => $actif, 
				'administrateur' => $administrateur 
		) );
	
	}
	
	// GET / GET ALL
	// -------------
	
	public function get_all ( $userLogin )
	{
		$query = $this -> db -> get( self::TABLE_NAME );
		$enseignants = array ();
		foreach ( $query -> result() as $row ) {
			array_push( $enseignants, $this -> create_user_entity( $row ) );
		}
		return $enseignants;
	}
	
	// UPDATE
	// ------
	
	// DELETE
	// ------
	
	public function delete_all_affected_cours ( $login )
	{
		$this -> db -> where( 'enseignant', $login );
		$this -> db -> update( 'contenu', array ( 
			
				'enseignant' => null 
		) );
	}
	
	// ================
	// GLOBAL UTILITIES
	// ================
	
	private function update_field ( $login, $field, $value )
	{
		$this -> db -> where( 'login', $login );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				$field => $value 
		) );
	}

}
?>