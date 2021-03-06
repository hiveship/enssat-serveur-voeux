
<br>
<br>


<div class="container" style="width: 800px">

	<div class="row-fluid user-infos cyruxx">
		<div class="span10 offset1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title">
						<p><?php echo mb_strtoupper($me['nom']) . " " . ucfirst($me['prenom']); ?></p>
					</h1>
				</div>
				<div class="panel-body">
					<div class="row-fluid">
						<table class="table table-condensed table-responsive table-user-information">
							<tbody>
								<tr>
									<td>Statut:</td>
									<td><?php echo ucfirst($me['statut']); ?></td>
								</tr>
								<tr>
									<td>Statutaire de base:</td>
									<td><?php echo $me['statutaire']; ?> heures équivalent TD</td>
								</tr>
								<tr>
									<td>Total heures déchargées:</td>
									<td><?php echo $total_decharges; ?>  heures équivalent TD</td>
								</tr>
								<tr>
									<td>Heures à éffectuer:</td>
									<td><?php echo $me['statutaire'] - $total_decharges; ?>  heures équivalent TD</td>
								</tr>
								<tr>
									<td>Compte actif :</td>
									<td><?php
									if ( $me ['actif'] ) {
										echo "<INPUT type='checkbox' name='actif' value='actif' disabled='disabled' checked>";
									} else {
										echo "<INPUT type='checkbox' name='actif' value='inactif' disabled='disabled'>";
									}
									?></td>
								</tr>
								<tr>
									<td>Compte administrateur :</td>
									<td><?php
									
									if ( $me ['administrateur'] ) {
										echo "<INPUT type='checkbox' name='administrateur' value='administrateur' disabled='disabled' checked>";
									} else {
										echo "<INPUT type='checkbox' name='administrateur' value='enseignant' disabled='disabled'>";
									}
									?></td>
								</tr>
								<tr>
									<td>Adresse mail :</td>
									<td><?php echo $me['email']; ?></td>
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


					<button type="button" class="btn btn-primary" onClick="populate_edit_form()"
						data-toggle="modal" data-target="#editMoi" data-toggle="modal" data-whatever="@mdo">
						<i class="fa  fa-pencil-square-o"></i> Modification du profil
					</button>

					<a class="btn btn-primary pull-right" href="<?php echo site_url('decharges')?>">Vos décharges</a>
				</div>
			</div>
		</div>

		<!--  MODAL MODIFICATION PASSWORD-->
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
								<?php echo form_password ( 'password', '', 'id="password" required placeholder="Mot de passe actuel " class="form-control input-md"' ); ?>
								</div>
							</div>
							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="newpassword1">Nouveau mot de passe</label>
								<div class="col-md-4">
										<?php echo form_password ( 'newpassword1', '', 'id="newpassword1" required placeholder="Nouveau mot de passe" class="form-control input-md"' ); ?>
								</div>
							</div>

							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="newpassword1">Confirmation</label>
								<div class="col-md-4">
										<?php echo form_password ( 'newpassword2', '', 'id="newpassword2" required placeholder="Nouveau mot de passe" class="form-control input-md"' ); ?>
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

		<!--  MODAL MODIFICATION EDITION -->
		<div class="modal fade" id="editMoi" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3 class="modal-title" id="exampleModalLabel">Edition</h3>
					</div>
					<div class="modal-body">

						<?php echo form_open('enseignants/update','class="form-horizontal"'); ?>
							<fieldset>
							<!-- Nom -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="nom">Nom</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="nomEdit"
											name="nom" class="form-control" placeholder="Nom" type="text" required="">
									</div>
								</div>
							</div>

							<!-- Prenom -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="prenom">Prénom</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="prenomEdit"
											name="prenom" class="form-control" placeholder="Prénom" type="text" required="">
									</div>
								</div>
							</div>

							<!-- Email -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="email">Email</label>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> <input
											id="emailEdit" name="email" class="form-control" placeholder="Email" type="email"
											required="">
									</div>
								</div>
							</div>

							<!-- Statutaire-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="statutaire">Statutaire</label>
								<div class="col-md-2">
									<input id="statutaire" name="statutaire" type="number" class="form-control input-md"
										required="">
								</div>
								<div class="col-md-5">
									<span class="help-block">En heures équivalent TD</span>
								</div>

							</div>




							<div class="form-group">

								<div class="modal-footer">
									<button type="button" id="submit-button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<?php echo form_submit('mysubmit', 'Modifier','class="btn btn-primary pull-right" type="button" ');?>
						<?php echo form_close();?>
					</div>




							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid user-row">
		<div class="span1"></div>
		<div class="span1 dropdown-user" data-for=".cyruxx">
			<i class="icon-chevron-down text-muted"></i>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div id="chartdiv" style="width: 100%; height: 300px;"></div>
		</div>
		<div class="col-md-6">
			<div id="chartdiv2" style="width: 100%; height: 330px;"></div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url("assets/js/amcharts.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/pie.js"); ?>"></script>

<?php
// TODO faire ce graphique avec les VRAIES données
// On a besoin de: heures à enseigner (statutaire-somme décharges)
// Heures éffectués (somme de tous les cours affectés)
$delta = ( $me ['statutaire'] - $total_decharges ) - $enseigne;
if ( $delta > 0 ) {
	$categ = "Heures libres";
} else {
	$delta = - $delta;
	$categ = "Heures complémentaires";
}
?>
<!-- amCharts javascript code -->
<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "pie",
					"angle": 12,
					"depth3D": 8,
					"innerRadius": "40%",
					"titleField": "category",
					"valueField": "column-1",
					"allLabels": [],
					"balloon": {},
					"colors": [
								"#BB9C94",
								"#C44949"
								],
					"export": {
						"enabled": false
					},
					"legend": {
						"align": "center",
						"markerType": "circle"
					},
					"titles": [],
					"dataProvider": [
						{
							"category": "Heures enseignées",
							"column-1": <?php echo $enseigne;?>
						},
						{
							"category": "<?php echo "$categ";?>",
							"column-1": <?php echo $delta;?>
						}
					]
				}
			);

			AmCharts.makeChart("chartdiv2",
					{
				"type": "pie",
				"angle": 12,
				"depth3D": 8,
				"innerRadius": "40%",
				"titleField": "category",
				"valueField": "column-1",
				"allLabels": [],
				"balloon": {},
				"colors": [
				   		"#836953",
				   		"#C44949",
				   		"#BB9C94",
				   		"#FFB347"
				   	],
				"legend": {
					"align": "center",
					"markerType": "circle"
				},
				"titles": [],
				"dataProvider": [
					{
						"category": "CM",
						"column-1": "<?php echo $sum_cm;?>"
					},
					{
						"category": "TD",
						"column-1": "<?php echo $sum_td;?>"
					},
					{
						"category": "DS",
						"column-1": "<?php echo $sum_ds;?>"
					},
					{
						"category": "TP / Projet",
						"column-1": "<?php echo $sum_tp_projet;?>"
					}
				]
			}
				);
		</script>


<script>
		function populate_edit_form()
		{
		    $.ajax
		    ({
		        url: <?php echo "'".site_url("enseignants/get")."'";?>,
		        type: 'post',
		        success: function(result)
		        {
		            var array = JSON.parse(result);
		           // Populate the form using the returned content
		        	$("#nomEdit").val(array.nom);
		        	$("#prenomEdit").val(array.prenom);
		        	$("#emailEdit").val(array.email);
		        	$("#statutaire").val(array.statutaire);
		        }
		    });

		}
		</script>