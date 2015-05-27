<?php

require_once ( APPPATH . 'models/enseignant/enum_enseignant_compte_level.php' );

class MY_Loader extends CI_Loader
{

	/**
	 * Charge automatique le header et le footer.
	 * Détermine également la barre de navigation à afficher en fonction du statut de l'utilisateur éffectuant la requête (aucune si non connecté, simple enseignant ou enseignant administrateur.
	 * Le paramètre $data est donné pour la vue '$view' demandée. Il est demandé de ne plus utiliser directement la fonction CodeIgniter '$this->load->view()'.
	 * 
	 * @param String $view
	 *        	Chemin relatif à partir du répertoire 'views' du fichier à charger. Ne pas indiquer l'extension du fichier.
	 * @param Array $data
	 *        	Tableau associatif de donnée qui sera accéssible depuis la vue demandée. Par défaut, un tableau vide.
	 */
	public function template ( $view, $data = array() )
	{
		$this -> view( 'header' );
		if ( $this -> session -> userdata( 'me' ) !== NULL ) {
			$me = $this -> session -> userdata( 'me' );
			if ( $me ['level'] == EnumEnseignantCompteLevel::ADMINISTRATEUR ) {
				$this -> view( 'admin/navbar' );
			} else {
				$this -> view( 'navbar' );
			}
		}
		$this -> view( 'flash', get_flashs() );
		$this -> view( $view, $data );
		$this -> view( 'footer' );
	}

}
