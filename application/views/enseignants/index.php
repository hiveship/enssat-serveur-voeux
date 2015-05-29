
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
				<form class="form-horizontal">
					<fieldset>

						<!-- Form Name -->
						<legend>Ajouter un enseignant</legend>

						<!-- Text input-->
						<div class="control-group">
							<label class="control-label" for="nom">Nom</label>
							<div class="controls">
								<input id="nom" name="nom" type="text" placeholder="nom de l'enseignant"
									class="input-medium" required="">

							</div>
						</div>

						<!-- Text input-->
						<div class="control-group">
							<label class="control-label" for="prenom">Prénom</label>
							<div class="controls">
								<input id="prenom" name="prenom" type="text" placeholder="prénom de l'enseignant"
									class="input-medium" required="">

							</div>
						</div>

						<!-- Prepended text-->
						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">@</span> <input id="email" name="email" class="input-xlarge"
										placeholder="email" type="text" required="">
								</div>

							</div>
						</div>

						<!-- Select Basic -->
						<div class="control-group">
							<label class="control-label" for="statut">Statut</label>
							<div class="controls">
								<select id="statut" name="statut" class="input-medium">
									<option>Vacataire</option>
									<option>A faire en php</option>
								</select>
							</div>
						</div>

						<!-- Text input-->
						<div class="control-group">
							<label class="control-label" for="statutaire">Statutaire</label>
							<div class="controls">
								<input id="statutaire" name="statutaire" type="text" placeholder="192" class="input-small"
									required="">
								<p class="help-block">A exprimer en heures</p>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="control-group">
							<label class="control-label" for="level">Rang du compte</label>
							<div class="controls">
								<label class="radio" for="level-0"> <input type="radio" name="level" id="level-0"
									value="Administrateur" checked="checked"> Administrateur
								</label> <label class="radio" for="level-1"> <input type="radio" name="level" id="level-1"
									value="Enseignant"> Enseignant
								</label>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="control-group">
							<label class="control-label" for="etat">Etat du compte</label>
							<div class="controls">
								<label class="radio" for="etat-0"> <input type="radio" name="etat" id="etat-0" value="Actif"
									checked="checked"> Actif
								</label> <label class="radio" for="etat-1"> <input type="radio" name="etat" id="etat-1"
									value="Inactif"> Inactif
								</label>
							</div>
						</div>

					</fieldset>
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<a href="<?php echo site_url("Enseignant_controller/create");?>" class="btn btn-primary">Créer</a>
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
