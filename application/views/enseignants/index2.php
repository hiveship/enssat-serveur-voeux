
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
						<legend>Nouvel enseignant</legend>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nom">Nom</label>
							<div class="col-md-4">
								<input id="nom" name="nom" type="text" placeholder="nom" class="form-control input-md"
									required="">
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="prenom">Prénom</label>
							<div class="col-md-4">
								<span class="add-on"> <input id="prenom" name="prenom" type="text" placeholder="prenom"
									class="form-control input-md" required="">
							
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="prependedtext">Email</label>
							<div class="col-md-5">
								<div class="input-group">
									<span class="input-group-addon">@</span> <input id="prependedtext" name="prependedtext"
										class="form-control" placeholder="email" type="text" required="">
								</div>

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
