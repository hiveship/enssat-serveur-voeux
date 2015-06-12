<nav class="navbar navbar-default">
	<div class="navbar-inner">

		<div class="container-fluid">

			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url();?>">ENSSAT</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo site_url("enseignants/".$this->session->userdata('me')['login']);?>"
						value="mescours">Mes Cours</a></li>
					<li><a href="<?php echo site_url("admin/cours");?>" value="cours"> Cours (admin) </a></li>
					<li><a href="<?php echo site_url("admin/enseignants");?>" value="enseignantsAdmin"> Enseignants
							(admin) </a></li>
					<li><a href="<?php echo site_url("enseignants");?>" value="enseignants"> Enseignants (public) </a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a value="moncompte" href="<?php echo site_url("enseignants/edit") ?>">Mon Compte</a></li>
					<li><a href="<?php echo site_url('logout') ?>" value="deconnexion">Déconnexion</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
