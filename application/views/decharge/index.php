
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
									
									echo form_open ( 'Decharge_controller/delete/' . $value ['id'], $params );
									
									$data = array ( 
											
											'type' => 'textarea', 
											'content' => 'Supprimer', 
											'class' => 'btn btn-primary btn-xs' 
									);
									
									echo form_button ( $data );
									echo form_close ();
									?>
									
								
								<?php
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
					<?php echo form_open('Decharge_controller/create','class="form-horizontal"'); ?>
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
.panel-body {
	padding: 0px;
}

.panel-body {
	padding: 10;
}

.container {
	width: 350px;
}

.container {
	padding-right: 15px;
	padding-left: 15px;
	margin-right: 200px;
	margin-left: auto;
}
</style>
			<script type="text/javascript">
function validate(){
	   return confirm("Etes vous sure de vouloir supprimer cette décharge ?");
}
</script>