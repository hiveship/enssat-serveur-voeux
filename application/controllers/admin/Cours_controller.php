<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Cours_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> helper ( 'form' );
		$this -> load -> library ( 'form_validation' );
		$this -> load -> model ( 'cours/Module_model' );
		$this -> load -> model ( 'cours/Cours_model' );
	}

	public function edit ( $module, $partie )
	{
		$this -> check_parameters ( $module, $partie );
		
		$this -> form_validation -> set_rules ( 'partie_new', 'partie_new', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$partie_new = $this -> input -> post ( 'partie_new' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			if ( $partie != $partie_new && $this -> Cours_model -> exists ( $module, $partie_new ) ) {
				flash_error ( "nom de module déja alloué ! " );
				redirect ( 'admin/cours/edit/' . $module . '/' . $partie, 'auto' );
			}
			$this -> Cours_model -> update ( $module, $partie, $partie_new, $type, $hed );
			redirect ( 'admin/cours', 'auto' );
		}
		
		$data = array ( 
				
				'cours' => $this -> Cours_model -> get ( $module, $partie )[0] 
		);
		$this -> load -> template ( 'cours/edit', $data );
	}

	public function create ( $module = NULL )
	{
		if ( $module == NULL ) {
			redirect ( 'admin/cours', 'auto' );
		}
		
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'type', 'type', 'trim|required' );
		$this -> form_validation -> set_rules ( 'hed', 'hed', 'trim|required' );
		
		if ( $this -> form_validation -> run () === TRUE ) {
			$part = $this -> input -> post ( 'nom' );
			$type = $this -> input -> post ( 'type' );
			$hed = $this -> input -> post ( 'hed' );
			if ( ! $this -> Cours_model -> exists ( $module, $part ) ) {
				$this -> Cours_model -> create ( $module, $part, $type, $hed );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "la partie existe déja" );
			}
		}
		$data = array ( 
				
				'module' => $module 
		);
		$this -> load -> template ( 'cours/create', $data );
	}

	public function delete ( $module, $partie )
	{
		$this -> check_parameters ( $module, $partie );
		$this -> Cours_model -> delete ( $module, $partie );
		redirect ( 'admin/cours', 'auto' );
	}

	private function check_parameters ( $module, $partie )
	{
		if ( ! isset ( $partie ) || ! isset ( $module ) || ! $this -> Cours_model -> exists ( $module, $partie ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'admin/cours', 'auto' );
		}
	}

}
?>