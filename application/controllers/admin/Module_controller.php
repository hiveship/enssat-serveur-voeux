<?php
$dir = dirname ( __FILE__ );
include ( $dir . '/Admin_controller.php' );

class Module_controller extends Admin_controller
{

	public function __construct ()
	{
		parent::__construct ();
		$this -> load -> model ( 'Module_model' );
		$this -> load -> model ( 'Cours_model' );
		$this -> load -> model ( 'Enseignant_model' );
	}

	public function index ()
	{
		$this -> get (); // charge tous les modules
	}

	/**
	 * fonction permettant de creer un module, avec ses parties
	 */
	public function create ()
	{
		// ajout de regles de de validation du formulaire
		$this -> form_validation -> set_rules ( 'ID', 'ID', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		// verification de la validitée du formulaire
		if ( $this -> form_validation -> run () === TRUE ) {
			$form = $this -> input -> post (); // récupère toute les données passées par POST.
			                                   
			// crée le module et recupere son identifiant
			$ID = $this -> Module_model -> create ( $form ['ID'], $form ['public'], $form ['semestre'], $form ['libelle'] );
			
			// verifie que le module a bien été crée avnt de passer à la suite
			if ( $ID != null ) {
				
				// extraction des parties du formulaire
				$Pnames = array ();
				$Ptype = array ();
				$Phed = array ();
				foreach ( $form as $key => $value ) {
					if ( strpos ( $key, 'Pname' ) ) {
						array_push ( $Pnames, $value );
					} elseif ( strpos ( $key, 'Ptype' ) ) {
						array_push ( $Ptype, $value );
					} elseif ( strpos ( $key, 'Phed' ) ) {
						array_push ( $Phed, ( int ) $value );
					}
				}
				
				// crée les partie extraites du formulaire
				for ( $i = 0 ; $i < sizeof ( $Pnames ) ; $i ++ ) {
					$this -> Cours_model -> create ( $ID ['id'], $Pnames [$i], $Ptype [$i], $Phed [$i] );
				}
				
				flash_info ( 'Module ' . $form ['ID'] . ' crée' );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "Le module existe déjà" );
				$this -> load -> template ( 'admin/module/create' );
			}
		} else {
			$this -> load -> template ( 'admin/modules/create' );
		}
	
	}

	/**
	 * fonction permettant d'afficher la liste des modules avec leurs cours
	 * si ID est préciséon affiche que celui avec ses parties
	 * si il n'est pas précisé alors on affiche tout les modules
	 * 
	 * @param string $ID
	 *        	du module à afficher
	 */
	public function get ( $ID = null )
	{
		if ( $ID != null ) {
			// chargement du module spécifié avec ses cours
			$this -> check_ID_parameter ( $ID );
			$modules [0] = $this -> Module_model -> get ( $ID );
			$cours [0] = $this -> Cours_model -> get ( $ID );
		} else {
			// chargement des tout les modules et cours
			$modules = $this -> Module_model -> get_all ();
			$cours = array ();
			foreach ( $modules as $module ) {
				array_push ( $cours, $this -> Cours_model -> get ( $module ['id'] ) );
			}
		}
		
		// mise en forme des données a passer à la vue
		$data = array ( 
				
				'cours' => $cours, 
				'modules' => $modules, 
				'enseignant' => $this -> Enseignant_model -> get_all_login_nom_prenom () 
		);
		$this -> load -> template ( 'admin/modules/index', $data );
	}

	/**
	 * fonction de chargement de la page de modification
	 * 
	 * @param string $ID
	 *        	id du module à modifier
	 */
	public function edit ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> load -> template ( 'admin/modules/edit', array ( 
				
				'module' => $this -> Module_model -> get ( $ID ) 
		) );
	}

	/**
	 * foinction permetant de déclencher la suppression d'un module et de ses parties
	 * 
	 * @param string $ID
	 *        	identifiant de la fonction à supprimer
	 */
	public function delete ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		$this -> Module_model -> delete ( $ID );
		flash_success ( "module supprimé" );
		redirect ( 'admin/cours', 'auto' );
	}

	/**
	 * fonction de mise a jour d'un module, affiche la page de modification en cas d'erreur
	 * 
	 * @param string $ID
	 *        	identifiant du module a modifier
	 */
	public function update ( $ID )
	{
		// verification de la validitée de l'identifiant transmis
		$this -> check_ID_parameter ( $ID );
		
		// ajout de regles de de validation du formulaire
		$this -> form_validation -> set_rules ( 'nom', 'nom', 'trim|required' );
		$this -> form_validation -> set_rules ( 'public', 'public', 'trim|required' );
		$this -> form_validation -> set_rules ( 'semestre', 'semestre', 'trim|required' );
		$this -> form_validation -> set_rules ( 'libelle', 'libelle', 'required' );
		
		// verification de la validitée des données transmise par le formolaire
		if ( $this -> form_validation -> run () === TRUE ) {
			$nom = $this -> input -> post ( 'nom' );
			$public = $this -> input -> post ( 'public' );
			$semestre = $this -> input -> post ( 'semestre' );
			$libelle = $this -> input -> post ( 'libelle' );
			$responsable = $this -> input -> post ( 'responsable' );
			
			// modification
			$res = $this -> Module_model -> update ( $ID, $nom, $public, $semestre, $libelle, $responsable );
			if ( $res ) {
				flash_info ( "module " . $ID . " mis a jour" );
				redirect ( 'admin/cours', 'auto' );
			} else {
				flash_error ( "nouvel ID invalide" );
				$this -> load -> template ( 'admin/modules/edit' );
			}
		}
	}

	/**
	 * genere les information d'un module en Json
	 * 
	 * @param string $ID
	 *        	identifiant du module à récupérer
	 */
	public function get_ajax ( $ID )
	{
		$this -> check_ID_parameter ( $ID );
		echo json_encode ( $modules [0] = $this -> Module_model -> get ( $ID ) );
	
	}

	/**
	 * verifie que le ID passé en paramettre est valide
	 * 
	 * @param string $ID
	 *        	a valider
	 */
	private function check_ID_parameter ( $ID )
	{
		if ( ! isset ( $ID ) || ! $this -> Module_model -> exists ( $ID ) ) {
			flash_error ( "Vous devez spécifier un ID valide ! : recu -> " . $id );
			redirect ( 'admin/cours', 'auto' );
		}
	}

}