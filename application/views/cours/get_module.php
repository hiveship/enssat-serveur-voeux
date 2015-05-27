<div class="container">
	<div>
			<?php
			// TODO trouver comment afficher
			echo form_open ( 'Module_controller/get', 'role="form"' );
			
			$ID = array ( 
					
					'id' => 'ID', 
					'name' => 'ID',
					/* En cas d'erreur, à la validation du formulaire, si le champs était rempli, la saisie de l'utilisateur sera toujours présente.*/
					'value' => set_value ( 'ID' ) 
			);
			echo form_label ( 'ID: ', 'ID' );
			echo form_input ( $ID, '', 'class="form-control"' );
			echo form_error ( 'ID' );
			
			echo br ( 1 );
			echo form_submit ( 'submit', 'creer', 'class="btn btn-primary pull-right"' );
			
			echo form_close ();
			?>
		</div>
</div>