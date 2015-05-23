<?php

require_once ( APPPATH . 'models/enseignant/EnumEnseignantCompteLevel.php' );

class MY_Loader extends CI_Loader
{

	/**
	 * Charge automatique le bon header en fonction du statut de l'utilisateur éffectuant la requête (aucun header si non connecté, header simple enseignant ou header enseignant administrateur.
	 * Le paramètre $data est donné pour la vue chargée. Afin de disposer des headers, il est demandé de ne plus utiliser directement la fonction CodeIgniter '$this->load->view()'.
	 * 
	 * @param String $view        	
	 * @param array $data
	 *        	Array used to store all the data available from the view.
	 *        	Default: empty array.
	 */
	public function template ( $view, $data = array() )
	{
		$this -> view( 'header', $data );
		print_r( $this -> session -> userdata( 'me' ) );
		
		if ( $this -> session -> userdata( 'me' ) !== NULL ) {
			$me = $this -> session -> userdata( 'me' );
			if ( $me ['level'] == EnumEnseignantCompteLevel::ADMINISTRATEUR ) {
				$this -> view( 'admin/navbar', $data );
			} else {
				$this -> view( 'navbar', $data );
			}
		}
		$this -> view( $view, $data );
		$this -> view( 'footer', $data );
	}

}
