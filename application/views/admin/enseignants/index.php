<div class="container">

	<button type="button" class="btn btn-primary pull-right" data-toggle="modal"
		data-target="#ajoutEnseignant">
		<i class="fa fa-user-plus"></i> Ajouter un enseignant
	</button>
	<br> <br>

	<!-- ============== -->
	<!-- CREATION MODAL -->
	<!-- ============== -->

	<div class="modal fade" id="ajoutEnseignant" tabindex="-1" role="dialog"
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
					<form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST"
						action=<?php echo site_url("admin/enseignants/create");?>>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nom">Nom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="nom"
										name="nom" class="form-control" placeholder="Nom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="prenom">Prénom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="prenom"
										name="prenom" class="form-control" placeholder="Prénom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-5">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> <input id="email"
										name="email" class="form-control" placeholder="Email" type="email">
								</div>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statutaire">Statutaire</label>
							<div class="col-md-2">
								<input id="statutaire" name="statutaire" type="number" value=192
									class="form-control input-md" required=>
							</div>
							<div class="col-md-5">
								<span class="help-block">En heures équivalent TD</span>
							</div>

						</div>

						<!-- Select Basic -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statut">Statut</label>
							<div class="col-md-4">
								<select id="statut" name="statut" class="form-control">
									<?php
									foreach ( $allowedStatuts as $statut ) {
										?>
										<option value="<?php echo $statut ;?>"><?php echo ucfirst($statut);?></option>
										<?php }?>
									</select>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="administrateur">Statut</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="administrateur-0"> <input type="radio" name="administrateur"
										id="administrateur-0" value="0" checked="checked"> Enseignant
									</label>
								</div>
								<div class="radio">
									<label for="administrateur-1"> <input type="radio" name="administrateur"
										id="administrateur-1" value="1"> Administrateur
									</label>
								</div>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="actif">Etat</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="actif-0"> <input type="radio" name="actif" id="actif-0" value="1"
										checked="checked"> Actif
									</label>
								</div>
								<div class="radio">
									<label for="actif-1"> <input type="radio" name="actif" id="actif-1" value="0"> Inactif
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">

							<div class="modal-footer">
								<button id="submit-button" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
								<button type="submit" href="#" class="btn btn-primary pull-right">Valider</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ============= -->
	<!-- EDITION MODAL -->
	<!-- ============= -->



	<div class="modal fade" id="editEnseignant" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="exampleModalLabel">Informations personelles d'un enseignant</h4>
				</div>
				<div class="modal-body">
					<form name="form" id="editForm" class="form-horizontal" enctype="multipart/form-data"
						method="POST" action="">

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nom">Nom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="nomEdit"
										name="nom" class="form-control" placeholder="Nom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="prenom">Prénom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="prenomEdit"
										name="prenom" class="form-control" placeholder="Prénom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
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

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statutaire">Statutaire</label>
							<div class="col-md-2">
								<input id="statutaire" name="statutaire" type="number" value=192
									class="form-control input-md" required="">
							</div>
							<div class="col-md-5">
								<span class="help-block">En heures équivalent TD</span>
							</div>

						</div>

						<!-- Select Basic -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statut">Statut</label>
							<div class="col-md-4">
								<select id="statutEdit" name="statut" class="form-control">
									<?php
									foreach ( $allowedStatuts as $statut ) {
										?>
										<option value="<?php echo $statut ;?>"><?php echo ucfirst($statut);?></option>
										<?php }?>
									</select>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="administrateur">Statut</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="administrateur-0"> <input type="radio" name="administrateur" id="editAdminEns"
										value="0"> Enseignant
									</label>
								</div>
								<div class="radio">
									<label for="administrateur-1"> <input type="radio" name="administrateur" id="editAdminAdm"
										value="1"> Administrateur
									</label>
								</div>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="actif">Etat</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="actif-0"> <input type="radio" name="actif" id="editActifYes" value="1"
										checked="checked"> Actif
									</label>
								</div>
								<div class="radio">
									<label for="actif-1"> <input type="radio" name="actif" id="editActifNo" value="0"> Inactif
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">

							<div class="modal-footer">
								<button id="submit-button" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
								<button type="submit" href="#" class="btn btn-primary pull-right">Valider</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ===== -->
	<!-- TABLE -->
	<!-- ===== -->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Enseignants</h3>
				</div>
				<div class="panel-body">
					<input type="text" class="form-control" id="search-enseignants-admin" data-action="filter"
						data-filters="#dev-table" placeholder="Rechercher..." />
				</div>
				<table class="table table-striped table-hover" id="enseignants-admin">
					<thead>
						<tr>
							<th><center>Droits</center></th>
							<th><center>Identité</center></th>
							<th><center>Email</center></th>
							<th><center>Statut</center></th>
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
								<center>
							
		<?php if($enseignant['administrateur']) {?>
									<span title="Administrateur" class="label label-danger"> </span>
						 <?php } else {?>
										<span title="Enseignant" class="label label-success"> </span>							<?php }?></center>
							</td>
							<td>
								<center><?php echo mb_strtoupper($enseignant['nom'],'UTF-8')." ".ucfirst($enseignant['prenom'])?></center>
							</td>
							<td>
								<center><?php echo $enseignant['email']?></center>
							</td>
							<td>
								<center><?php echo ucfirst($enseignant['statut'])?></center>
							</td>
							<td><a href="<?php echo site_url('/enseignants/cours_de/'.$enseignant['login']) ?>"> <i
									class="fa fa-tasks"></i> Ses cours
							</a></td>
							<td><a id='editLink' href="#" onClick="populate_modal('<?php echo $enseignant['login'];?>')"
								data-toggle="modal" data-target="#editEnseignant"><i class="fa fa-info"></i> Voir / Modifier</a></td>
							<td><a onClick='validate("<?php echo $enseignant['login'];?>")' href="#"> <i
									class="fa fa-times"></i> Supprimer
							</a></td>
						</tr>
		<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
									
// Colonnes triables
oTable = $('#enseignants-admin').DataTable( {
    paging: false,
    "language": {
        "zeroRecords": "Aucune résultat ne correspond à votre recherche.",
    },
    "aaSorting": [
                  [0, "asc"]
              ],
              "aoColumns": [
                  null,
                  null,
                  null,
                  null,
                  {'bSortable': false },
                  {'bSortable': false },
                  {'bSortable': false },
              ]
    
} );

// Barre de recherche
$('#search-enseignants-admin').keyup(function(){
      oTable.search($(this).val()).draw() ;
});

function populate_modal(login)
{
    $.ajax
    ({
        url: <?php echo "'".site_url("/admin/enseignants/get")."'";?>,
        data: {"login": login},
        type: 'post',
        success: function(result)
        {
            var array = JSON.parse(result);
            
            // Set the parameter of the URL destination form
              $("#editForm").get(0).setAttribute('action', '<?php echo site_url("admin/enseignants/edit");?>'+'/'+array.login); //this works
            
           // Populate the form using the returned content
        	$("#nomEdit").val(array.nom);
        	$("#prenomEdit").val(array.prenom);
        	$("#emailEdit").val(array.email);
        	$("#statutaireEdit").val(array.statutaire);
        	if (array.administrateur) {
            	$("#editAdminAdm").prop("checked", true);
        	} else {
            	$("#editAdminEns").prop("checked", true);
        	}
        	if (array.actif) {
            	$("#editActifYes").prop("checked", true);
        	} else {
            	$("#editActifNo").prop("checked", true);
        	}
        	
        }
    });
};
function validate(result) {
    swal({
        title: "Confirmer la suppression ?",
        text: "Cela supprimera toutes ses décharges et rendra libre l'enssemble des cours occupé/gérés.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e67e22",
        confirmButtonText:"Supprimer",
        cancelButtonText:"Annuler",
        
        closeOnConfirm: false
    }, function () {
    	$.ajax({
    		url: <?php echo "'".site_url("/admin/enseignants/delete")."'";?>+'/'+result,
    	});
    	window.location.reload()
    	    });
}
</script>
