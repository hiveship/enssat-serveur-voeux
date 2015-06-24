<div class="container">
	<a href="<?php echo site_url("admin/module/create") ?>" class='btn btn-primary pull-right'> <span
		class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Créer Module
	</a> <br></br>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modules</h3>
				</div>

				<table id='tableSearchResults' class='table table-hover table-striped'>
					<thead>
						<tr>
							<th><center>Module</center></th>
							<th><center>Promo</center></th>
							<th><center>Semestre</center></th>
							<th><center>Description</center></th>
							<th><center>Responsable</center></th>
							<th><center>Volume Horaire</center></th>
							<th></th>
							<th></th>

						</tr>
					</thead>
					<tbody>
<?php
$i = 1;
foreach ( $modules as $module ) {
	echo "<tr id='package$i' class='accordion-toggle' data-toggle='collapse'
			data-parent='#OrderPackages' data-target='.packageDetails$i'>";
	foreach ( $module as $key => $value ) {
		if ( $key != 'id' ) {
			echo "<td><center> $value</center></td> ";
		}
	}
	
	$hed_total = 0;
	$hed_pris = 0;
	foreach ( $cours [$i - 1] as $cours_mod ) {
		$hed_total += $cours_mod ['hed'];
		if ( $cours_mod ['enseignant'] != NULL ) {
			$hed_pris += $cours_mod ['hed'];
		}
	}
	if ( $hed_pris != $hed_total ) {
		echo "<td><center>$hed_pris / $hed_total</center></td>";
	} else {
		echo "<td><center>$hed_total</center></td>";
	}
	
	?>
			<td>
							<button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
								data-target="#assigner" onClick="change_responsable('<?php echo $module['id']; ?>')">Changer
								enseignant</button>
						</td>
						<td>
							<button type="button" class='btn btn-primary btn-xs' data-toggle="modal"
								data-target="#gestion-module"
								onClick="ajax_modifier_module('<?php echo $cours_mod ['module']."','".$cours_mod ['partie']; ?>')">Modifier
								partie</button>
						</td>
						<td>
							<button id='suppr' type='button' content='Supprimer' class='btn btn-danger btn-xs'
								value="<?php $module ['id'] ?>" onClick="validate('<?php echo $module ['id']; ?>')">Supprimer</button>
						</td>
					<?php
	
	echo "</tr>";
	echo "<tr>
	<td colspan='10' class='hiddenRow'>
	<div class='accordion-body collapse packageDetails$i'
		id='accordion$i'>
		<table id='tableSearchResults' class='table table-hover table-striped table-condensed'>";
	echo "<thead>
					<tr>
					<th><center>Partie</center></th>
					
					<th><center>Type</center></th>
					
					<th><center>HED</center></th>
				
					<th><center>Enseignant</center></th>
					
					<th><center></center></th>
					
			       	<th><center></center></th>
			
					</tr>
					</thead>";
	foreach ( $cours [$i - 1] as $cours_mod ) {
		echo "<tr>";
		foreach ( $cours_mod as $key => $value ) {
			if ( $key != "module" ) {
				echo "<td><center>";
				echo $value;
				echo "</center></td>";
			}
		}
		
		?>
		<td>
							<button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
								data-target="#assigner"
								onClick="change_enseignant('<?php echo $cours_mod['module']."','".$cours_mod['partie']; ?>')">
								Changer enseignant</button>
						</td>
						<td>
							<button type="button" class='btn btn-primary btn-xs' data-toggle="modal"
								data-target="#gestion-cours"
								onClick="ajax_modifier_cours('<?php echo $cours_mod ['module']."','".$cours_mod ['partie']; ?>')">Modifier
								partie</button>
						</td>
						<td>
							<button id='suppr' type='button' content='Supprimer' class='btn btn-danger btn-xs'
								value="<?php $module ['id'] ?>"
								onClick="validate_partie('<?php echo $cours_mod ['module']."','".$cours_mod ['partie']; ?>')">Supprimer</button>
				<?php
		echo "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	?>
	<button type='button' content='Creer cours' data-toggle="modal" data-target="#gestion-cours"
								class='btn btn-default' onClick="creer_cours('<?php echo $module ['id']; ?>')">Creer cours</button>
	<?php
	echo "</div>";
	echo "</td>";
	
	echo "</tr>";
	$i ++;

}
?>

					

					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--  MODALE ASSIGNATION ENSEIGNANT -->
<div class="modal fade" id="assigner" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="exampleModalLabel">Choix de l'enseignant</h3>
			</div>
			<div class="modal-body">
									
									<?php
									echo form_open ( '#', 'class="form-horizontal" id="change"' );
									
									?>

										<fieldset>

					<div class="form-group">
						<label class="col-md-4 control-label" for="enseignant">Choisissez un enseignant</label> <select
							name="login" id="choix_enseignant" class="select2-enseignant form form-control">
							<div class="col-md-4">
							<?php
							foreach ( $enseignant as $info ) {
								echo '
							<option value="' . $info ['login'] . '">' . ucfirst ( $info ['prenom'] ) . ' ' . mb_strtoupper ( $info ['nom'] ) . '</option>';
							}
							?>
							
						
						
						
						</select>

					</div>
				</fieldset>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<?php echo form_submit('mysubmit', 'Choisir','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
		</div>
	</div>
</div>

<!--  MODAL CREER / MODIFICATION MODALE-->
<div class="modal fade" id="gestion-cours" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="exampleModalLabel">Créer Cours</h3>
			</div>
			<div class="modal-body">
								<?php
								echo form_open ( "admin/cours/create", 'role="form" id="form_gest_cours"' );
								
								?>
			<!-- NOM PARTIE -->
				<fieldset>
					<label class="col-md-4 control-label" for="email">Nom Partie</label>
					<div class="col-md-5">
						<div class="input-group">
							<?php
							
							$Pn = array ( 
									
									'id' => 'nom_partie', 
									'name' => 'nom' 
							);
							echo form_input ( $Pn, '', 'class="form-control"' );
							
							$Pt = array ( 
									
									'CM' => 'CM', 
									'Projet' => 'Projet', 
									'TD' => 'TD', 
									'TP' => 'TP', 
									'DS' => 'DS' 
							);
							?>
							</div>
					</div>


					<!-- TYPE -->
					<label class="col-md-4 control-label" for="email">Type</label>
					<div class="col-md-5">
						<div class="input-group">
							<?php
							
							echo form_dropdown ( 'type', $Pt, 'CM', "id='type_partie'" );
							?>
							</div>
					</div>

					<!-- HED -->
					<label class="col-md-4 control-label" for="email">HED</label>
					<div class="col-md-5">
						<div class="input-group">
							<?php
							$Ph = array ( 
									
									'id' => 'HED', 
									'name' => 'hed', 
									'type' => 'number', 
									'value' => '30' 
							);
							
							echo form_input ( $Ph );
							
							?>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<?php
				
				echo form_submit ( 'submit', 'creer', 'id="sub-form-cours"class="btn btn-primary pull-right"' );
				echo form_close ();
				?>
					
			</div>
		</div>
	</div>
</div>

<!--  MODAL CREER / MODIFICATION MODALE-->
<div class="modal fade" id="gestion-module" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="exampleModalLabel">Modification de module</h3>
			</div>
			<div class="modal-body">
			<?php
			echo form_open ( "admin/module/update/", 'role="form" id="form_gest_module"' );
			$nom = array ( 
					
					'id' => 'nom_module', 
					'name' => 'nom' 
			);
			echo form_label ( 'Nom: ', 'nom' );
			echo form_input ( $nom, '', 'class="form-control"' );
			echo form_error ( 'nom' );
			
			$public = array ( 
					
					'name' => 'public', 
					'id' => 'public_module' 
			);
			echo form_label ( 'public: ', 'public' );
			echo form_input ( $public, '', 'class="form-control"' );
			echo form_error ( 'public' );
			
			$semestre = array ( 
					
					'name' => 'semestre', 
					'id' => 'semestre_module' 
			);
			echo form_label ( 'semestre: ', 'semestre' );
			echo form_input ( $semestre, '', 'class="form-control"' );
			echo form_error ( 'semestre' );
			
			$libelle = array ( 
					
					'name' => 'libelle', 
					'id' => 'libelle_module' 
			);
			echo form_label ( 'libelle: ', 'libelle' );
			echo form_input ( $libelle, '', 'class="form-control"' );
			echo form_error ( 'libelle' );
			?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			<?php
			echo form_submit ( 'mysubmit', 'Modifier', 'class="btn btn-primary" type="button"' );
			echo form_close ();
			?>
				</div>
		</div>
	</div>
</div>



<script>
function validate_partie(module,partie) {
    swal({
        title: "Confirmer la suppression ?",
        text: "Cela supprimera le cours definitivement",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e67e22",
        confirmButtonText:"Supprimer",
        cancelButtonText:"Annuler",
        
        closeOnConfirm: false
    }, function () {
    	$.ajax({
    		url: <?php echo "'".site_url("admin/cours/delete")."'";?>+'/'+module+'/'+encodeURIComponent(partie),
    	});
    	window.location.reload()
    	    });
};
function validate(result) {
    swal({
        title: "Confirmer la suppression ?",
        text: "Cela supprimera le module et ses cours definitivement",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e67e22",
        confirmButtonText:"Supprimer",
        cancelButtonText:"Annuler",
        
        closeOnConfirm: false

        
    }, function () {
    	$.ajax({
    		url: <?php echo "'".site_url("admin/module/delete")."'";?>+'/'+result,
    	});
    	window.location.reload()
    	    });
}
function change_enseignant(id,cours){
	$("#change").get(0).setAttribute('action', '<?php echo site_url("admin/enseignants/inscrire_force");?>'+'/'+id+'/'+encodeURIComponent(cours));
}
							
function change_responsable(id){
	$("#change").get(0).setAttribute('action', '<?php echo site_url("admin/enseignants/inscrire_force");?>'+'/'+id);
}

function creer_cours(id)
{
	$("#form_gest_cours").get(0).setAttribute('action', '<?php echo site_url("admin/cours/create");?>'+'/'+id);
	$("#sub-form-cours").val('Creer');
}

function ajax_modifier_cours(id,cours)
{
	$("#form_gest_cours").get(0).setAttribute('action', '<?php echo site_url("admin/cours/edit");?>'+'/'+id+'/'+encodeURIComponent(cours));
    $.ajax
    ({
        url: <?php echo "'".site_url("admin/cours/get_ajax")."'";?>+'/'+id+'/'+encodeURIComponent(cours),
        success: function(result)
        {
	        tab = JSON.parse(result)[0];
	        
	        $("#nom_partie").val(tab.partie);
	        $('#type_partie option[value="'+tab.type+'"]').attr('selected','selected');
	        $("#HED").val(tab.hed);
	        $("#sub-form-cours").val('Modifier');
       }
    });
}

function ajax_modifier_module(id){
	$("#form_gest_module").get(0).setAttribute('action', '<?php echo site_url("admin/module/update");?>'+'/'+id);
    $.ajax
    ({
        url: <?php echo "'".site_url("admin/module/get_ajax")."'";?>+'/'+id,
        success: function(result)
        {
	        tab = JSON.parse(result);

	        $("#nom_module").val(tab.nom);
	        $("#public_module").val(tab.public);
	        $("#semestre_module").val(tab.semestre);
	        $("#libelle_module").val(tab.libelle);
       }
    });
}

</script>