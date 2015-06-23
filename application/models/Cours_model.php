<?php

class Cours_model extends CI_model
{
	const TABLE_NAME = 'contenu';

	public function __construct ()
	{
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * permet de creer une nouvelle partie d'un module
	 * 
	 * @param string $id
	 *        	identifiant du module de la partie
	 * @param string $part
	 *        	nom de la partie
	 * @param string $type
	 *        	type de la partie
	 * @param string $hed
	 *        	volume horaire de la partie
	 */
	public function create ( $id, $part, $type, $hed )
	{
		$this -> db -> insert( 'contenu', array ( 
			
				'module' => $id, 
				'partie' => $part, 
				'type' => $type, 
				'hed' => $hed 
		) );
	}

	/**
	 * permet de supprimer la partie identifiée par le couple module/partie
	 * la partie n'est pas renseignée alors la fonction supprime toute les parties du module désigné
	 * 
	 * @param string $module
	 *        	identifiant du module
	 * @param string $partie
	 *        	identifiant de la partie
	 */
	public function delete ( $module, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$this -> db -> delete( self::TABLE_NAME, array ( 
				
					'module' => $module 
			) );
		} else {
			$this -> db -> delete( self::TABLE_NAME, array ( 
				
					'module' => $module, 
					'partie' => $partie 
			) );
		}
	}

	/**
	 * permet de recuperer un tableau contenant les donnée de la partie identifiée par le couple module/partie
	 * la partie n'est pas renseignée alors la fonction revoie toute les parties du module désigné
	 * 
	 * @param string $module
	 *        	identifiant du module
	 * @param string $partie
	 *        	identifiant de la partie
	 */
	public function get ( $module, $partie = NULL )
	{
		if ( $partie == NULL ) {
			$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
				
					'module' => $module 
			) );
		} else {
			$querry = $this -> db -> get_where( self::TABLE_NAME, array ( 
				
					'module' => $module, 
					'partie' => $partie 
			) );
		}
		return $querry -> result_array();
	}
	// TODO finir doc
	/**
	 *
	 * @param unknown $module        	
	 * @param unknown $partie_old        	
	 * @param unknown $partie_new        	
	 * @param unknown $type        	
	 * @param unknown $hed        	
	 */
	public function update ( $module, $partie_old, $partie_new, $type, $hed )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie_old );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'partie' => $partie_new, 
				'type' => $type, 
				'hed' => $hed 
		) );
	}

	public function inscrire_enseignant ( $module, $partie, $enseignant )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => $enseignant 
		) );
	}

	public function desinscrire_enseignant ( $module, $partie, $enseignant )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => NULL 
		) );
	}

	public function desinscrire_enseignant_tout ( $enseignant )
	{
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> update( self::TABLE_NAME, array ( 
			
				'enseignant' => NULL 
		) );
	}

	public function get_modules_id_de ( $enseignant )
	{
		$this -> db -> where( 'enseignant', $enseignant );
		$this -> db -> order_by( "module", "asc" );
		$this -> db -> select( 'module' );
		$this -> db -> distinct();
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function get_cours_de ( $enseignant, $module = NULL )
	{
		if ( $module != NULL ) {
			$this -> db -> where( 'module', $module );
		}
		$this -> db -> where( 'enseignant', $enseignant );
		$querry = $this -> db -> get( self::TABLE_NAME );
		return $querry -> result_array();
	}

	public function exists ( $module, $partie )
	{
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

	public function est_libre ( $module, $partie )
	{
		$this -> db -> where( 'enseignant', null );
		$this -> db -> where( 'module', $module );
		$this -> db -> where( 'partie', $partie );
		$query = $this -> db -> get( self::TABLE_NAME );
		return $query -> num_rows() == 1;
	}

}
?>
