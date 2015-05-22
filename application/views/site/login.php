

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SuperTodo</title>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-2.1.4.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</head>

<body>
	<div class="page-header">
		<center>
			<h2>Espace réservé, veillez vous identifier</h2>
		</center>
	</div>

	<form role="form">
		<div class="span12 row ">
			<label for="email">Login:</label> <input type="email" class="form-control" id="login">
		</div>
		<div class="form-group span12 row">
			<label for="pwd">Password:</label> <input type="password" class="form-control" id="password">
		</div>
		<button type="submit" class="btn btn-default">Connexion</button>
	</form>
</body>
</html>