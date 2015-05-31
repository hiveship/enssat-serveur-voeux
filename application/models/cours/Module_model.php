<?php

class Module_model extends CI_model
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> database ();
	}

	public function create ( $ID, $public, $semestre, $libelle )
	{
		$data = array ( 
				'ident' => $ID, 
				'public' => $public, 
				'semestre' => $semestre, 
				'libelle' => $libelle 
		);
		$res = $this -> get ( $ID );
		
		if ( sizeof ( $res ) == 0 ) {
			$this -> db -> insert ( 'module', $data );
			return true;
		} else {
			return false;
		}
	}

	public function get_all ()
	{
		$querry = $this -> db -> get ( 'module' );
		return $querry -> result_array ();
	}

	public function get ( $ID )
	{
		$querry = $this -> db -> get_where ( 'module', array ( 
				'ident' => $ID 
		) );
		return $querry -> result_array ();
	}

	public function delete ( $ID )
	{
		$this -> db -> delete ( 'contenu', array ( 
				'module' => $ID 
		) );
		
		$this -> db -> delete ( 'module', array ( 
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
				'libelle' => $libelle, 
				'responsable' => $responsable 
		);
		
		$this -> db -> where ( 'id', $ID_orig );
		$this -> db -> update ( 'module', $data );
		return true;
	}

}

?>