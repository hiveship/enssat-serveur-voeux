
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
									<td><?php $email ?></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				<div class="panel-footer">
					<a href="#" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-lock"></span>
						Changer mon mot de passe</a>
				</div>
			</div>
		</div>
		<style>
//
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