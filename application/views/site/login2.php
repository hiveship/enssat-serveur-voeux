
<div class="container">
	<div class="row login-form well col-centered col-md-3">
			<?php
			
			echo form_open( 'Site_controller/login', 'role="form"' );
			$login = array ( 
				
					'id' => 'login', 
					'name' => 'login',
					/* En cas d'erreur, à la validation du formulaire, si le champs était rempli, la saisie de l'utilisateur sera toujours présente.*/
					'value' => set_value( 'login' ) 
			);
			echo form_label( 'Login: ', 'login' );
			echo form_input( $login, '', 'class="form-control"' );
			echo form_error( 'login' );
			
			$password = array ( 
				
					'name' => 'password', 
					'id' => 'password', 
					'value' => set_value( 'password' ) 
			);
			echo form_label( 'Password: ', 'password' );
			echo form_password( $password, 'password', 'class="form-control"' );
			echo form_error( 'password' );
			
			echo br( 1 );
			echo form_submit( 'submit', 'Connexion', 'class="btn btn-primary pull-right"' );
			
			echo form_close();
			?>
		</div>
</div>