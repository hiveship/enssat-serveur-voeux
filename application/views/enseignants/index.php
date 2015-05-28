
<div class="page-header">
	<h2>
		<center>Liste des comptes</center>
	</h2>
</div>
<%= link_to 'Nouvel utilisateur', new_admin_user_path, class: "btn pull-right" %> Le mot de passe
pour tous les comptes animateurs est unique: "<%= User::PASSWORD %>"
<br>
<br>
<br>
<div class="container-fluid">
	<table class="table table-condensed table-stipped">
		<thead>
			<tr>
				<th><center>Nom</center></th>
				<th><center>Prenom</center></th>
				<th><center>Email</center></th>
				<th><center>Rang</center></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>

		<?php
		foreach ( $enseignants as $enseignant ) {
			?>
		<tr>

				<td>
					<h6>
						<center><?php echo $enseignant['nom']?></center>
					</h6>
				</td>
				<td>
					<center><?php echo $enseignant['prenom']?></center>
				</td>
				<td>
					<center><?php echo $enseignant['email']?></center>
				</td>
					<?php if($enseignant['administrateur']) {?>
					<td>
					<center>
						<span class="label label-danger"> Administrateur </span>
					</center>
				</td> <?php } else {?>
					<td>
					<center>
						<span class="label label-success"> Enseignant </span>
					</center>
				</td><?php }?>
					<td>
					<center>
						<a
							class:
								"icon-remove-sign"
								href="<?php echo site_url('Enseignant_controller/rendre_administrateur/'.$enseignant['login']) ?>">Rendre
							administrateur</a>
					</center>
				</td>
			</tr>
		<?php }?>

	</tbody>
	</table>
</div>
