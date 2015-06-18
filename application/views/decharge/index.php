
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
						<table class="table table-condensed table-responsive table-user-information center">
							<tbody>
								
								<?php
								$params = array ( 
									
										'onsubmit' => 'return(validate(this));' 
								);
								
								foreach ( $decharge as $value ) {
									
									echo "<tr>";
									echo "<td><center>Décharge</center></td>";
									echo "<td>";
									echo "<center>";
									echo $value ['decharge'];
									echo "</center>";
									echo "</td>";
									echo "<td>";
									echo "<center>";
									
									echo form_open( 'Decharge_controller/delete/' . $value ['id'], $params );
									
									$supprimer = array ( 
										
											'type' => 'textarea', 
											'content' => 'Supprimer', 
											'class' => 'btn btn-primary btn-xs' 
									);
									
									echo form_button( $supprimer );
									echo form_close();
									echo "<c/enter>";
									echo "</td>";
									
									echo "<td>";
									echo "<center>";
									?>
									<form class='form-horizontal' action='Decharge_controller/get_motif/'.$value['id'] >


									<button id='motif' type='button' content='Motif' class='btn btn-primary btn-xs'
										data-toggle='modal' data-target='#motifModal' value="<?php $value['id'] ?>"
										onClick="ajax_get_motif('<?php echo $value['id']; ?>')">Motif</button>
									
									<?php
									echo "</form";
									echo "<c/enter>";
									echo "</td>";
									echo "</tr>";
								}
								
								?>
							
							
							</tbody>

						</table>
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
							data-whatever="@mdo">
							<i class="fa fa-plus"></i> Ajouter une décharge
					
					</div>
				</div>

			</div>

			<!--  MODALE CREATION DECHARGE -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h3 class="modal-title" id="exampleModalLabel">Ajout d'une décharge</h3>
						</div>
						<div class="modal-body">
							<!-- Formulaire création d'une décharge -->
					<?php echo form_open('decharge/create','class="form-horizontal"'); ?>
							<fieldset>
								<div class="form-group">
									<label class="col-md-4 control-label" for="password-actuel">Décharge</label>
									<div class="col-md-4">
								<?php echo form_input( 'decharge', '', 'id="decharge" placeholder="" class="form-control input-md"' ); ?>
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
							<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<?php echo form_submit('mysubmit', 'Ajouter','class="btn btn-primary" type="button"');?>
						<?php echo form_close();?>
					</div>
					</div>
				</div>
			</div>


			<!--  MODAL APERCU / MODIFICATION MODALE-->
			<div class="modal fade" id="motifModal" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h3 class="modal-title" id="exampleModalLabel">Motif de votre décharge</h3>
						</div>
						<div class="modal-body">

					<?php
					echo form_open( 'decharge/update_motif', 'class="form-horizontal" id="motif_id"' );
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
							<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<?php
							echo form_submit( 'mysubmit', 'Modifier', 'class="btn btn-primary" type="button"' );
							echo form_close();
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
function validate(){
	   return confirm("Etes vous sure de vouloir supprimer cette décharge ?");
}

function ajax_get_motif(id)
		{
		    $.ajax
		    ({
		        url: <?php echo "'".site_url("decharge/ajax_get_motif")."'";?>,
		        type: 'post',
		        data: {"id": id},
		        success: function(result)
		        {
			        tab = JSON.parse(result)[0];
		            $("#motif_id").get(0).setAttribute('action', '<?php echo site_url("decharge/update_motif");?>'+'/'+tab.id); //this works
				        
		           // Populate the form using the returned content
		        	$("#motif_txt").val(tab.motif); // test

		        }
		    });

		}



		</script>