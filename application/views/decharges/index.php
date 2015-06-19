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
					<h1 class="panel-title">Vos Décharges</h1>
				</div>
				<div class="panel-body">
					<div class="row-fluid">
						<table
							class="table table-condensed table-responsive table-user-information center">
							<tbody>
								
								<?php
								
								foreach ( $decharge as $value ) {
									
									echo "<tr>";
									echo "<td><center>Décharge</center></td>";
									echo "<td><center>";
									echo $value ['decharge'];
									echo "</center></td>";
									echo "<td><center>";
									?>
									
									<button id='suppr' type='button' content='Supprimer'
									class='btn btn-primary btn-xs' value="<?php $value['id'] ?>"
									onClick="validate('<?php echo $value['id']; ?>')">Supprimer</button>
									
									<?php
									echo "</center></td>";
									echo "<td><center>";
									?>

									<button id='motif' type='button' content='Motif'
									class='btn btn-primary btn-xs' data-toggle='modal'
									data-target='#motifModal' value="<?php $value['id'] ?>"
									onClick="ajax_get_motif('<?php echo $value['id']; ?>')">Motif</button>
									
									<?php
									echo "</center></td>";
									echo "</tr>";
								}
								
								?>

							</tbody>

						</table>
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal"
							data-target="#ajoutDecharge">
							<i class="fa fa-plus"></i> Ajouter une décharge
						</button>
					
					</div>
				</div>

			</div>

			<!--  MODALE CREATION DECHARGE -->
			<div class="modal fade" id="ajoutDecharge" tabindex="-1"
				role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h3 class="modal-title" id="exampleModalLabel">Ajout d'une
								décharge</h3>
						</div>
						<div class="modal-body">
							<!-- Formulaire création d'une décharge -->
					<?php echo form_open('decharges/create','class="form-horizontal"'); ?>
							<fieldset>
								<div class="form-group">
									<label class="col-md-4 control-label" for="password-actuel">Décharge</label>
									<div class="col-md-4">
								<?php echo form_input( 'decharge', '', 'id="decharge" placeholder="" required class="form-control input-md"' ); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label" for="password-actuel">Motif</label>
									<div class="col-md-4">
								<?php echo form_textarea( 'motif', '', 'id="motif" placeholder="" class="form-control input-md" ' ); ?>
								</div>
								</div>

							</fieldset>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Annuler</button>
							<?php echo form_submit('mysubmit', 'Ajouter','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
					</div>
				</div>
			</div>


			<!--  MODAL APERCU / MODIFICATION MODALE-->
			<div class="modal fade" id="motifModal" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h3 class="modal-title" id="exampleModalLabel">Motif de votre
								décharge</h3>
						</div>
						<div class="modal-body">

					<?php
					echo form_open ( 'decharges/update_motif', 'class="form-horizontal" id="motif_id"' );
					?>
							
							<div class="form-group">
								<label class="col-md-4 control-label" for="password-actuel">Motif</label>
								<div class="col-md-4">
								<?php echo form_textarea( 'motif', '', 'id="motif_txt" placeholder="" class="form-control input-md"' ); ?>
								</div>
							</div>

							</fieldset>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Annuler</button>
							<?php
							echo form_submit ( 'mysubmit', 'Modifier', 'class="btn btn-primary" type="button"' );
							echo form_close ();
							?>
					</div>
					</div>
				</div>
			</div>


			<style>
.panel-body {
	padding: 0px;
}

.container {
	width: 400px;
}
</style>
			<script type="text/javascript">
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
			    		url: <?php echo "'".site_url("/decharges/delete")."'";?>+'/'+result,
			    	});
			    	window.location.reload()
			    				    });
			};
			
function ajax_get_motif(id)
		{
		    $.ajax
		    ({
		        url: <?php echo "'".site_url("decharges/ajax_get_motif")."'";?>,
		        type: 'post',
		        data: {"id": id},
		        success: function(result)
		        {
			        tab = JSON.parse(result)[0];
		            $("#motif_id").get(0).setAttribute('action', '<?php echo site_url("decharges/update_motif");?>'+'/'+tab.id); //this works
				        
		           // Populate the form using the returned content
		        	$("#motif_txt").val(tab.motif); // test
		        }
		    });
		}
		</script>