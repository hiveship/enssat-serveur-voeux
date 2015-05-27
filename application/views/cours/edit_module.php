<div class="container">
	<div>
			<?php
			$hidden = array ( 
					"ID_orig" => $module ['ident'] 
			);
			echo form_open ( 'Module_controller/update_remove', 'role="form"', $hidden );
			$ID = array ( 
					
					'id' => 'ID', 
					'name' => 'ID',
					/* En cas d'erreur, à la validation du formulaire, si le champs était rempli, la saisie de l'utilisateur sera toujours présente.*/
					'value' => $module ['ident'] 
			);
			echo form_label ( 'ID: ', 'ID' );
			echo form_input ( $ID, '', 'class="form-control"' );
			echo form_error ( 'ID' );
			
			$public = array ( 
					
					'name' => 'public', 
					'id' => 'public', 
					'value' => $module ['public'] 
			);
			echo form_label ( 'public: ', 'public' );
			echo form_input ( $public, '', 'class="form-control"' );
			echo form_error ( 'public' );
			
			$semestre = array ( 
					
					'name' => 'semestre', 
					'id' => 'semestre', 
					'value' => $module ['semestre'] 
			);
			echo form_label ( 'semestre: ', 'semestre' );
			echo form_input ( $semestre, '', 'class="form-control"' );
			echo form_error ( 'semestre' );
			
			$libelle = array ( 
					
					'name' => 'libelle', 
					'id' => 'libelle', 
					'value' => $module ['libelle'] 
			);
			echo form_label ( 'libelle: ', 'libelle' );
			echo form_input ( $libelle, '', 'class="form-control"' );
			echo form_error ( 'libelle' );
			
			$responsable = array ( 
					
					'name' => 'responsable module', 
					'id' => 'responsable', 
					'value' => $module ['responsable'] 
			);
			echo form_label ( 'Responsable: ', 'responsable' );
			echo form_input ( $responsable, '', 'class="form-control"' );
			echo form_error ( 'responsable' );
			
			echo br ( 1 );
			$data = array ( 
					'name' => 'req', 
					'value' => 'update', 
					'type' => 'submit', 
					'content' => 'Mettre à jour', 
					'class' => 'btn btn-primary' 
			);
			echo form_button ( $data );
			$data = array ( 
					'name' => 'req', 
					'value' => 'delete', 
					'type' => 'submit', 
					'content' => 'supprimer', 
					'class' => 'btn btn-primary' 
			);
			echo form_button ( $data );
			
			echo form_close ();
			?>
		</div>
</div>