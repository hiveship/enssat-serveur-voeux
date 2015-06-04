<?php

class Module_model extends CI_model
{
	
	const TABLE_NAME = 'module';

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function create ( $nom, $public, $semestre, $libelle )
	{
		$data = array ( 
				
				'nom' => $nom, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		$res = $this -> get ( $ID );
		
		if ( sizeof ( $res ) == 0 ) {
			$this -> db -> insert ( self::TABLE_NAME, $data );
			return true;
		} else {
			return false;
		}
	}

	public function get_all ()
	{
		$querry = $this -> db -> get ( self::TABLE_NAME );
		return $querry -> result_array ();
	}

	public function get ( $ID )
	{
		$querry = $this -> db -> get_where ( self::TABLE_NAME, array ( 
				
				'ident' => $ID 
		) );
		return $querry -> result_array ();
	}

	public function delete ( $ID )
	{
		$this -> db -> delete ( 'contenu', array ( 
				
				'module' => $ID 
		) );
		
		$this -> db -> delete ( self::TABLE_NAME, array ( 
				
				'ident' => $ID 
		) );
	}

	public function update ( $ID_orig, $ID, $public, $semestre, $libelle, $responsable )
	{
		if ( $ID != $ID_orig && sizeof ( $this -> get ( $ID ) != 0 ) ) {
			return false;
		}
		
		$data = array ( 
				
				'ident' => $ID, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		// 'responsable' => $responsable
		
		$this -> db -> where ( 'ident', $ID_orig );
		$this -> db -> update ( self::TABLE_NAME, $data );
		return true;
	}

	public function exists ( $ID )
	{
		$this -> db -> select ( 'ident' ); // meaningless
		$this -> db -> where ( 'ident', $ID );
		$query = $this -> db -> get ( self::TABLE_NAME );
		return $query -> num_rows () == 1;
	}

}

?>