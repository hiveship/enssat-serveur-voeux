<div class="container">
	<div>
			<?php
			echo form_open ( "admin/module/update/" . $module ['id'], 'role="form"' );
			$nom = array ( 
					
					'id' => 'nom', 
					'name' => 'nom', 
					'value' => $module ['nom'] 
			);
			echo form_label ( 'Nom: ', 'nom' );
			echo form_input ( $nom, '', 'class="form-control"' );
			echo form_error ( 'nom' );
			
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
			
			echo br ( 1 );
			$data = array ( 
					
					'name' => 'req', 
					'value' => 'update', 
					'type' => 'submit', 
					'content' => 'Mettre à jour', 
					'class' => 'btn btn-primary' 
			);
			echo form_button ( $data );
			echo form_close ();
			?>
		</div>
</div>