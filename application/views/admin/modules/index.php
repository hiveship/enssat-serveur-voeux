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
								data-target="#ajoutDecharge"
								onClick="ajax_change_enseignant('<?php echo $module['id']; ?>')">Changer enseignant</button>
						</td>
	<?php
	
	echo "<td><center>";
	echo form_open( site_url( 'admin/module/edit/' . $module ['id'] ) );
	$data = array ( 
		
			'type' => 'submit', 
			'content' => 'Modifier', 
			'class' => 'btn btn-primary btn-xs' 
	);
	echo form_button( $data );
	echo form_close();
	
	echo "</center></td>";
	echo "<td><center>";
	
	$params = array ( 
		
			'onsubmit' => 'return(validate(this));' 
	);
	?>
			<button id='suppr' type='button' content='Supprimer' class='btn btn-danger btn-xs'
							value="<?php $module ['id'] ?>" onClick="validate('<?php echo $module ['id']; ?>')">Supprimer</button>
					<?php
	
	// echo form_open( 'admin/module/delete/' . $module ['id'], $params );
	// $data = array (
	
	// 'type' => 'submit',
	// 'content' => 'Supprimer',
	// 'class' => 'btn btn-danger btn-xs'
	// );
	// echo form_button( $data );
	// echo form_close();
	
	echo "</center></td>";
	
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
								data-target="#ajoutDecharge"
								onClick="ajax_change_enseignant('<?php echo $cours_mod['module']."','".$cours_mod['partie']; ?>')">
								Changer enseignant</button>
						</td>
				<?php
		echo "<td>";
		echo "<a href='" . site_url( "admin/cours/edit/" . $module ['id'] . '/' . $cours_mod ['partie'] ) . "'
			 class='btn btn-primary btn-xs'>Modifier partie</a>";
		echo "</td>";
		echo "<td>";
		// echo form_open( 'admin/cours/delete/' . $module ['id'] . '/' . $cours_mod ['partie'], $params );
		// $data = array (
		
		// 'type' => 'submit',
		// 'content' => 'Supprimer',
		// 'class' => 'btn btn-danger btn-xs'
		// );
		// echo form_button( $data );
		// echo form_close();
		?>
		<button id='suppr' type='button' content='Supprimer' class='btn btn-danger btn-xs'
							value="<?php $module ['id'] ?>" onClick="validate_partie('<?php echo $module ['id']; ?>')">Supprimer</button>
				<?php
		echo "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	echo "<a href='" . site_url( "admin/cours/create/" . $module ['id'] ) . "' class='btn btn-default'>Créer un partie de cours</a>";
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
<<<<<<< HEAD
<script>
function validate_partie(result) {
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
    		url: <?php echo "'".site_url("admin/cours/delete")."'";?>+'/'+result,
    	});
    	window.location.reload()
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
    		url: <?php echo "'".site_url("admin/module/delete")."'";?>+'/'+result,
    	});
    	window.location.reload()
    	    });
}

<!--  MODALE CREATION DECHARGE -->
<div class="modal fade" id="ajoutDecharge" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="exampleModalLabel">Création d'une
					décharge</h3>
			</div>
			<div class="modal-body">
									
									<?php
									echo form_open( 'admin/Decharge_controller/create', 'class="form-horizontal" id="change"' );
									
									?>

										<fieldset>

					<div class="form-group">
						<label class="col-md-4 control-label" for="enseignant">Choisissez
							un enseignant</label> <select name="login" id="choix_enseignant"
							class="select2-enseignant form form-control">
							<?php
							foreach ( $enseignant as $info ) {
								echo '
							<option value="' . $info ['login'] . '">' . ucfirst( $info ['prenom'] ) . ' ' . mb_strtoupper( $info ['nom'] ) . '</option>';
							}
							?>
							</select>
					</div>
				</fieldset>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<?php echo form_submit('mysubmit', 'Ajouter','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function ajax_change_enseignant(id,cours){
	$("#change").get(0).setAttribute('action', '<?php echo site_url("admin/enseignants/inscrire_force");?>'+'/'+id+'/'+cours);
}
							
function ajax_change_responsable(id){
	$("#change").get(0).setAttribute('action', '<?php echo site_url("admin/enseignants/inscrire_force");?>'+'/'+tab.id);
}
							
</script>
