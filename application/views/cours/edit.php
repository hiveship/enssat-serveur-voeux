<div class="container">
	<div>
			<?php
			echo form_open ( 'Cours_controller/edit/' . $cours ['module'] . '/' . $cours ['partie'], 'role="form"' );
			$nom = array ( 
					
					'id' => 'partie_new', 
					'name' => 'partie_new', 
					'value' => $cours ['partie'] 
			);
			echo form_label ( 'Nom: ', 'nom' );
			echo form_input ( $nom, '', 'class="form-control"' );
			echo form_error ( 'partie_new' );
			
			$type = array ( 
					
					'CM' => 'CM', 
					'TD' => 'TD', 
					'TP' => 'TP', 
					'DS' => 'DS' 
			);
			
			echo form_label ( 'Type: ', 'Type' );
			echo form_dropdown ( 'type', $type, $cours ['type'] );
			
			$Ph = array ( 
					'name' => 'hed', 
					'type' => 'number', 
					'value' => $cours ['hed'] 
			);
			echo form_label ( 'hed: ', 'hed' );
			echo form_input ( $Ph );
			
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