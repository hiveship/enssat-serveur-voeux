

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SuperTodo</title>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-2.1.4.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</head>

<body>
	<div class="container">
		<div class="row login-form well col-centered col-md-3">
			<?php
			
			echo form_open( 'SiteController/login', 'role="form"' );
			$login = array ( 
				
					'id' => 'login', 
					'name' => 'login',
					/* En cas d'erreur, à la validation du formulaire, si le champs était rempli, la saisie de l'utilisateur sera toujours présente.*/
					'value' => set_value( 'login' ) 
			);
			echo form_label( 'Login: ', 'login', 'class="icon-white icon-user"' );
			echo form_input( $login, '', 'class="form-control"' );
			echo form_error( 'login' );
			
			$password = array ( 
				
					'name' => 'password', 
					'id' => 'password', 
					'value' => set_value( 'password' ) 
			);
			echo form_label( 'Password: ', 'password', 'class="icon-white icon-question-sign"' );
			echo form_password( $password, 'password', 'class="form-control"' );
			echo form_error( 'password' );
			
			echo br( 1 );
			echo form_submit( 'submit', 'Connexion', 'class="btn btn-primary pull-right"' );
			
			echo form_close();
			?>
		</div>
	</div>


</body>
</html>