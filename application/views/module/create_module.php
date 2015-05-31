<div class="container">
	<div>
			<?php
			// TODO rendre + dynamique
			
			echo form_open ( 'Module_controller/create', 'role="form"' );
			$ID = array ( 
					
					'id' => 'ID', 
					'name' => 'ID',
					/* En cas d'erreur, à la validation du formulaire, si le champs était rempli, la saisie de l'utilisateur sera toujours présente.*/
					'value' => set_value ( 'ID' ) 
			);
			echo form_label ( 'ID: ', 'ID' );
			echo form_input ( $ID, '', 'class="form-control"' );
			echo form_error ( 'ID' );
			
			$public = array ( 
					
					'name' => 'public', 
					'id' => 'public', 
					'value' => set_value ( 'public' ) 
			);
			echo form_label ( 'public: ', 'public' );
			echo form_input ( $public, '', 'class="form-control"' );
			echo form_error ( 'public' );
			
			$semestre = array ( 
					
					'name' => 'semestre', 
					'id' => 'semestre', 
					'value' => set_value ( 'semestre' ) 
			);
			echo form_label ( 'semestre: ', 'semestre' );
			echo form_input ( $semestre, '', 'class="form-control"' );
			echo form_error ( 'semestre' );
			
			$libelle = array ( 
					
					'name' => 'libelle', 
					'id' => 'libelle', 
					'value' => set_value ( 'libelle' ) 
			);
			echo form_label ( 'libelle: ', 'libelle' );
			echo form_input ( $libelle, '', 'class="form-control"' );
			echo form_error ( 'libelle' );
			
			$test = array ( 
					
					'name' => 'test', 
					'id' => 'test', 
					'value' => set_value ( 'test' ) 
			);
			echo form_label ( 'test 1: ', 'test' );
			echo form_input ( $test, '', 'class="form-control"' );
			echo form_error ( 'test' );
			
			$test = array ( 
					
					'name' => 'test', 
					'id' => 'test', 
					'value' => set_value ( 'test' ) 
			);
			echo form_label ( 'test 2: ', 'test' );
			echo form_input ( $test, '', 'class="form-control"' );
			echo form_error ( 'test' );
			
			echo br ( 1 );
			echo form_submit ( 'submit', 'creer', 'class="btn btn-primary pull-right"' );
			echo "<div id=parties></div>";
			echo form_close ();
			?>
		</div>
</div>

<script type="text/javascript">
function myFunction() {
	document.getElementById("myList").appendChild(test);
}
</script>