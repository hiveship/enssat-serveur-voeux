
<div class="page-header">
	<h2>
		<center>Liste des comptes</center>
	</h2>
</div>
<!--  MODAL CREATION -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
	data-whatever="@mdo">Ajouter un enseignant</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="exampleModalLabel">Nouvel enseignant</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="control-label">Recipient:</label> <input type="text"
							class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Message:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-primary">Créer</button>
			</div>
		</div>
	</div>
</div>

<!--  LIST -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Do you want to save changes you made to document before closing?</p>
				<p class="text-warning">
					<small>If you don't save, your changes will be lost.</small>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<%= link_to 'Nouvel utilisateur', new_admin_user_path, class: "btn pull-right" %> Le mot de passe
pour tous les comptes animateurs est unique: "<%= User::PASSWORD %>"
<br>
<br>
<br>
<div class="container">
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
