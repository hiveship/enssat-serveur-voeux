<?php

class Decharge_model extends CI_Model
{
	const TABLE_NAME = "decharge";

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	/**
	 * Récupère toutes les décharges avec leur motif correspondant de tous les enseignants.
	 */
	public function get_all ()
	{
		// $this -> db -> select( 'id, enseignant, decharge, motif' );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> result_array ();
	}

	/**
	 * Récupère les décharges d'un enseignant à partir de son login.
	 * 
	 * @param unknown $login        	
	 */
	public function get ( $login )
	{
		$query = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'enseignant' => $login 
		) );
		
		return $query -> result_array ();
	}

	/**
	 * Calcul la somme des décharges d'un enseignant à partir de son login.
	 * 
	 * @param unknown $login        	
	 */
	public function get_sum ( $login )
	{
		$this -> db -> select_sum ( 'decharge' );
		$this -> db -> where ( 'enseignant', $login );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> result ()[0] -> decharge;
	}

	/**
	 * Ajoute une décharge pour un enseignant.
	 * 
	 * @param unknown $login        	
	 * @param unknown $decharge        	
	 * @param unknown $motif        	
	 */
	public function add ( $login, $decharge, $motif )
	{
		$this -> db -> insert ( self::TABLE_NAME, array ( 
				
				'enseignant' => $login, 
				'decharge' => $decharge, 
				'motif' => $motif 
		) );
	}

	/**
	 * Supprime une décharge à l'aide de son id
	 * 
	 * @param unknown $id        	
	 */
	public function delete ( $id )
	{
		$this -> db -> where ( 'id', $id );
		$this -> db -> delete ( self::TABLE_NAME );
	}

	/**
	 * Supprime toute les décharges d'un enseignant
	 * 
	 * @param unknown $login        	
	 */
	public function delete_all ( $login )
	{
		$this -> db -> where ( 'enseignant', $login );
		$this -> db -> delete ( self::TABLE_NAME );
	}

	/**
	 * Récupère le motif et la valeur d'une décharge à partir de son id
	 * 
	 * @param unknown $id        	
	 */
	public function get_from_id ( $id )
	{
		$query = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'id' => $id 
		) );
		
		return $query -> result_array ();
	}

	/**
	 * Modifie un motif qui est sélectionné à l'aide de son id
	 * 
	 * @param unknown $id        	
	 * @param unknown $motif        	
	 */
	public function update_motif ( $id, $motif )
	{
		$this -> db -> where ( 'id', $id );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				'motif' => $motif 
		) );
	}

}

?>
