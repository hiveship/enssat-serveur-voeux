<?php

include "Application_controller.php";

class Decharge_controller extends Application_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'decharge/Decharge_model' );
	}

	public function get ()
	{
		
		$decharge = $this -> Decharge_model -> get ( 'vthion' );
		if ( $decharge == NULL ) {
			$decharge = 0;
			$this -> load -> template ( 'decharge/decharge', array ( 
					'decharge' => $decharge 
			) );
		} else {
			$this -> load -> template ( 'decharge/decharge', array ( 
					'decharge' => $decharge 
			) );
		}
	
	}

	public function add ()
	{
	
	}

	public function delete ()
	{
	
	}

}

?>