
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
						<p><?php echo $nom . " " . $prenom; ?></p>
					</h1>
				</div>
				<div class="panel-body">
					<div class="row-fluid">
						<table class="table table-condensed table-responsive table-user-information">
							<tbody>
								<tr>
									<td>Statut:</td>
									<td><?php echo $statut; ?></td>
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
				</div>
			</div>
		</div>

		<!--  MODAL CREATION -->
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


						<form class="form-horizontal">
							<fieldset>
								<!-- Password input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="password-actuel">Mot de passe actuel</label>
									<div class="col-md-4">
										<input id="password-actuel" name="password-actuel" placeholder="mot de passe actuel"
											class="form-control input-md" type="password">
									</div>
								</div>

								<!-- Password input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="newpassword1">Nouveau mot de passe</label>
									<div class="col-md-4">
										<input id="newpassword1" name="newpassword1" placeholder="nouveau mot de passe"
											class="form-control input-md" type="password">
									</div>
								</div>
								<!-- Password input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="newpassword1">Nouveau mot de passe</label>
									<div class="col-md-4">
										<input id="newpassword2" name="newpassword2" placeholder="nouveau mot de passe"
											class="form-control input-md" type="password">
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








		<style>
Reusing bootstrap 3 panel CSS
.panel {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0);
	border-radius: 4px 4px 4px 4px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
	margin-bottom: 20px;
}

.panel-primary {
	border-color: #428BCA;
}

.panel-primary>.panel-heading {
	background-color: #428BCA;
	border-color: #428BCA;
	color: #FFFFFF;
}

.panel-heading {
	border-bottom: 1px solid rgba(0, 0, 0, 0);
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	padding: 10px 15px;
}

.panel-title {
	font-size: 18px;
	margin-bottom: 0;
	margin-top: 0;
}

.panel-body:before, .panel-body:after {
	content: " ";
	display: table;
}

.panel-body:before, .panel-body:after {
	content: " ";
	display: table;
}

.panel-body:after {
	clear: both;
}

.panel-body {
	padding: 25px;
}

.panel-footer {
	background-color: #F5F5F5;
	border-bottom-left-radius: 3px;
	border-bottom-right-radius: 3px;
	border-top: 1px solid #DDDDDD;
	padding: 10px 15px;
}

//
CSS from v3 snipp
.user-row {
	margin-bottom: 14px;
}

.user-row:last-child {
	margin-bottom: 0;
}

.dropdown-user {
	margin: 13px 0;
	padding: 5px;
	height: 100%;
}

.dropdown-user:hover {
	cursor: pointer;
}

.table-user-information>tbody>tr {
	border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information>tbody>tr:first-child {
	border-top: 0;
}

.table-user-information>tbody>tr>td {
	border-top: 0;
}
</style>