<nav class="navbar navbar-inverse">
	<div class="navbar-inner">

		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
						class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">ENSSAT</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#" value="mescours">Mes Cours <span class="sr-only">(current)</span></a></li>
					<li><a href="#" value="voeux"> Voeux </a></li>
					<li><a href="#" value="enseignants"> Enseignants </a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a value="moncompte"
						href="<?php echo site_url("Enseignant_controller/get/".$this->session->userdata('me')['login']) ?>">Mon
							Compte</a></li>
					<li><a href="<?php echo site_url('Site_controller/logout') ?>" value="deconnexion">Déconnexion</a></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
	</div>

	<!-- /.container-fluid -->
</nav>
