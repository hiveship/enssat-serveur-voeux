
<br>
<br>
<div class="container">
	<div class="row-fluid user-row">
		<div class="span1"></div>
		<div class="span1 dropdown-user" data-for=".cyruxx">
			<i class="icon-chevron-down text-muted"></i>
		</div>
	</div>
	<div class="row-fluid user-infos cyruxx">
		<div class="span10 offset1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title">
						<p><?php echo mb_strtoupper($nom) . " " . ucfirst($prenom); ?></p>
					</h1>
				</div>
				<div class="panel-body">
					<div class="row-fluid">
						<table class="table table-condensed table-responsive table-user-information">
							<tbody>
								<tr>
									<td>Statut:</td>
									<td><?php echo ucfirst($statut); ?></td>
								</tr>
								<tr>
									<td>Statutaire:</td>
									<td><?php echo $statutaire; ?></td>
								</tr>
								<tr>
									<td>Compte actif :</td>
									<td><?php
									if ( $actif ) {
										echo "<INPUT type='checkbox' name='actif' value='actif' disabled='disabled' checked>";
									} else {
										echo "<INPUT type='checkbox' name='actif' value='inactif' disabled='disabled'>";
									}
									?></td>
								</tr>
								<tr>
									<td>Compte administrateur :</td>
									<td><?php
									
									if ( $administrateur ) {
										echo "<INPUT type='checkbox' name='administrateur' value='administrateur' disabled='disabled' checked>";
									} else {
										echo "<INPUT type='checkbox' name='administrateur' value='enseignant' disabled='disabled'>";
									}
									?>
								
								
								</tr>
								<tr>
									</td>
									<td>Adresse mail :</td>
									<td><?php echo $email; ?></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				<div class="panel-footer">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
						data-whatever="@mdo">
						<span class="glyphicon glyphicon-lock"></span> Modifier mot de passe
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"
						data-whatever="@mdo">
						<i class="fa fa-envelope-o"></i> Modifier adresse mail
					</button>
				</div>
			</div>
		</div>

		<!--  MODAL CREATION PASSWORD-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3 class="modal-title" id="exampleModalLabel">Modification de votre mot de passe</h3>
					</div>
					<div class="modal-body">

					<?php echo form_open('enseignants/edit/password','class="form-horizontal"'); ?>
							<fieldset>
							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="password-actuel">Mot de passe actuel</label>
								<div class="col-md-4">
								<?php echo form_password ( 'password', '', 'id="password" placeholder="Mot de passe actuel " class="form-control input-md"' ); ?>
								</div>
							</div>
							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="newpassword1">Nouveau mot de passe</label>
								<div class="col-md-4">
										<?php echo form_password ( 'newpassword1', '', 'id="newpassword1" placeholder="Nouveau mot de passe" class="form-control input-md"' ); ?>
								</div>
							</div>

							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="newpassword1">Confirmation</label>
								<div class="col-md-4">
										<?php echo form_password ( 'newpassword2', '', 'id="newpassword2" placeholder="Nouveau mot de passe" class="form-control input-md"' ); ?>
								</div>
							</div>


						</fieldset>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<?php echo form_submit('mysubmit', 'Modifier','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>

		<!--  MODAL CREATION MAIL-->
		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3 class="modal-title" id="exampleModalLabel">Modification de votre mot de passe</h3>
					</div>
					<div class="modal-body">

						<?php echo form_open('enseignants/edit/email','class="form-horizontal"'); ?>
							<fieldset>
							<!-- Text input-->
							<div class="control-group">
								<label class="control-label" for="newemail">Nouvelle adresse mail</label>
								<div class="controls">
								<?php
								
								echo form_input( 'newemail', '', 'id="newemail" placeholder="Adresse
									mail" class="input-xlarge"' );
								?></div>
							</div>

						</fieldset>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<?php echo form_submit('mysubmit', 'Modifier','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>