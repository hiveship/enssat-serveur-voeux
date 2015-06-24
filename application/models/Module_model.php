<?php

class Module_model extends CI_model
{
	
	const TABLE_NAME = 'module';

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	/**
	 * la fonction va inserer dans la base un nouveau module a condition qu'aucun autre module ait le meme nom
	 * 
	 * @param string $nom
	 *        	nom
	 *        	du module
	 * @param string $public
	 *        	public
	 *        	visé par le module
	 * @param string $semestre
	 *        	semsetre
	 *        	du module
	 * @param string $libelle
	 *        	libelle
	 *        	du module
	 * @return NULL si echec de creation, l'id du module sinon
	 */
	public function create ( $nom, $public, $semestre, $libelle )
	{
		$data = array ( 
				
				'nom' => $nom, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		
		$res = $this -> get_nom ( $nom );
		
		if ( sizeof ( $res ) == 0 ) {
			$this -> db -> insert ( self::TABLE_NAME, $data );
			return $this -> get_nom ( $nom );
		} else {
			return null;
		}
	}

	/**
	 *
	 * @return tableau contenant tout les modules de la base
	 */
	public function get_all ()
	{
		$querry = $this -> db -> get ( self::TABLE_NAME );
		return $querry -> result_array ();
	}

	/**
	 *
	 * @param string $ID
	 *        	identifiant du module a recuperer
	 * @return tableau contenant tout le module avec l'id transmis en parametre
	 */
	public function get ( $ID )
	{
		$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'id' => $ID 
		) );
		return $querry -> result_array ()[0];
	}

	/**
	 *
	 * @param string $nom
	 *        	nom du module a recuperer
	 * @return tableau contenant tout le module avec l'id transmis en parametre
	 */
	public function get_nom ( $nom )
	{
		$this -> db -> select ( 'id' );
		$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'nom' => $nom 
		) );
		return $querry -> result_array ()[0];
	}

	/**
	 *
	 * @param string $responsable        	
	 * @return tableau contenant tout les module ou le responsable transmis en parametre est inscrit
	 */
	public function get_modules_id_de ( $responsable )
	{
		$this -> db -> where ( 'responsable', $responsable );
		$this -> db -> order_by ( "id", "asc" );
		$this -> db -> select ( 'id' );
		$this -> db -> distinct ();
		$querry = $this -> db -> get ( self::TABLE_NAME );
		return $querry -> result_array ();
	}

	/**
	 *
	 * @param string $ID
	 *        	supprime le module et ses parties avec l'identifiant transmis en parametre
	 */
	public function delete ( $ID )
	{
		$this -> db -> delete ( 'contenu', array ( 
				
				'module' => $ID 
		) );
		
		$this -> db -> delete ( self::TABLE_NAME, array ( 
				
				'id' => $ID 
		) );
	}

	/**
	 *
	 * @param string $ID
	 *        	id du module a modifier
	 * @param string $nom
	 *        	nouveau nom
	 * @param string $public
	 *        	nouveau public
	 * @param string $semestre
	 *        	nouveau semestre
	 * @param string $libelle
	 *        	nouveau libelle
	 * @return boolean
	 */
	public function update ( $ID, $nom, $public, $semestre, $libelle )
	{
		if ( ! $this -> exists ( $ID ) ) {
			return false; // FIXME cette vérification doit être faite dans le controlleur, pas dans le modèle
		}
		
		$this -> db -> where ( 'id', $ID );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				'nom' => $nom, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		) );
		return true;
	}

	/**
	 *
	 * @param string $ID
	 *        	id a verifier
	 * @return boolean retourne vrai si le module existe faux sinon
	 */
	public function exists ( $ID )
	{
		$this -> db -> select ( 'id' );
		$this -> db -> where ( 'id', $ID );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> num_rows () == 1;
	}

	/**
	 *
	 * @param string $ID
	 *        	id a verifier
	 * @return boolean retourne vrai si le module n'a pas de responsable faux sinon
	 */
	public function est_libre ( $ID )
	{
		$this -> db -> where ( 'responsable', null );
		$this -> db -> where ( 'id', $ID );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> num_rows () == 1;
	}

	/**
	 * permet d'inscrire un responsable dans un module
	 * 
	 * @param string $ID
	 *        	id du module ou inscrire le responsable
	 * @param string $enseignant
	 *        	login du responssable
	 */
	public function inscrire_responsable ( $ID, $enseignant )
	{
		$this -> db -> where ( 'id', $ID );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				'responsable' => $enseignant 
		) );
	}

	/**
	 * permet de desinscrire un responsable dans un module
	 * 
	 * @param string $ID
	 *        	id du module ou inscrire le responsable
	 * @param string $enseignant
	 *        	login du responssable
	 */
	public function desinscrire_responsable ( $ID, $enseignant )
	{
		$this -> db -> where ( 'id', $ID );
		$this -> db -> where ( 'responsable', $enseignant );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				'responsable' => NULL 
		) );
	}

	/**
	 * permet de desinscrire un responsable de tout ses modules
	 * 
	 * @param string $enseignant
	 *        	login du responssable
	 */
	public function desinscrire_responsable_tout ( $enseignant )
	{
		$this -> db -> where ( 'responsable', $enseignant );
		$this -> db -> update ( self::TABLE_NAME, array ( 
				
				'responsable' => NULL 
		) );
	}

}

?>