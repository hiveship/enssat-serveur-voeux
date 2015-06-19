
<div class="container">

	<button type="button" class="btn btn-primary pull-right" data-toggle="modal"
		data-target="#ajoutDecharge">
		<i class="fa fa-plus"></i> Ajouter une décharge
	</button>
	<br> <br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Enseignants</h3>
				</div>
				<table class="table table-striped table-hover" id="enseignants-admin">

					<table class="table table-condensed table-responsive table-user-information">
						<table id='tableSearchResults' class='table table-hover table-striped'>
							<thead>
								<tr>
									<th><center>Enseignant</center></th>
									<th><center>Décharge</center></th>
									<th><center>Motif</center></th>

								</tr>
							</thead>
							<tbody>
								
								<?php
								$params = array ( 
										
										'onsubmit' => 'return(validate(this));' 
								);
								
								foreach ( $decharges as $value ) {
									
									echo "<tr>";
									echo "<td>";
									echo "<center>";
									echo $value ['enseignant'];
									echo "</center>";
									echo "</td>";
									echo "<td>";
									echo "<center>";
									echo $value ['decharge'];
									echo "</center>";
									echo "</td>";
									echo "<td>";
									echo "<center>";
									echo $value ['motif'];
									echo "</center>";
									echo "</td>";
									echo "<td>";
									echo "<center>";
									
									echo form_open ( 'admin/Decharge_controller/delete/' . $value ['id'], $params, 'class="form-horizontal"' );
									
									$data = array ( 
											
											'type' => 'textarea', 
											'content' => 'Supprimer', 
											'class' => 'btn btn-primary btn-xs' 
									);
									
									echo form_button ( $data );
									echo form_close ();
									
									echo "</td>";
									echo "</tr>";
								}
								
								?>
							</tbody>
						</table>

						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						<!--  MODAL CREATION DECHARGE-->
						<div class="modal fade" id="ajoutDecharge" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h3 class="modal-title" id="exampleModalLabel">Création d'une décharge</h3>
									</div>
									<div class="modal-body">
									
									<?php
									echo form_open ( 'admin/Decharge_controller/create', 'class="form-horizontal"' );
									
									?>

										<fieldset>

											<div class="form-group">
												<label class="col-md-4 control-label" for="enseignant">Choisissez un enseignant</label>
												<div class="col-md-4">
													<select name="choix_enseignant" id="choix_enseignant"
														class="select2-enseignant form form-control">
																	<?php
																	
																	foreach ( $enseignant as $info ) {
																		?>
														<option value="<?php echo $info['login']?>"> <?php echo ucfirst($info ['prenom']) . " " . mb_strtoupper($info ['nom']) ?></option>
														<?php
																	}
																	?>
												</select>

												</div>
											</div>
											</span>
											<div class="form-group">
												<label class="col-md-4 control-label" for="password-actuel">Décharge</label>
												<div class="col-md-4">
											<?php echo form_input( 'decharge', '', 'id="decharge" placeholder="" class="form-control input-md"' ); ?>
											</div>
											</div>

											<div class="form-group">
												<label class="col-md-4 control-label" for="password-actuel">Motif</label>
												<div class="col-md-4">
								<?php echo form_textarea( 'motif', '', 'id="motif" placeholder="" class="form-control input-md"' ); ?>
								</div>
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

						<style>
.container {
	width: 1000px;
}

élément {
	width: 170px;
}
</style>


						<script type="text/javascript">
function validate(){
	   return confirm("Etes vous sure de vouloir supprimer cette décharge ?");
}

$(".select2-enseignant").select2({
	  placeholder: "Select a state",
	  width: 'resolve'
	});

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

   
</script>