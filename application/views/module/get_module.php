<div class="container">
	<a href="Module_controller/create" class='btn btn-primary pull-right'>
		<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
		Créer Module
	</a> <br></br>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modules</h3>
				</div>

				<table id='tableSearchResults'
					class='table table-hover table-striped'>
					<thead>
						<tr>
							<th><center>Module</center></th>
							<th><center>Promo</center></th>
							<th><center>Semestre</center></th>
							<th><center>Description</center></th>
							<th><center>Responsable</center></th>
							<th><center>Modifier</center></th>
							<th><center>Supprimer</center></th>

						</tr>
					</thead>
					<tbody>
<?php
foreach ( $modules as $module ) {
	echo "<tr>";
	foreach ( $module as $key => $value ) {
		if ( $key != 'id' ) {
			echo "<td><center> $value</center></td> ";
		}
	}
	echo "<td><center>";
	echo form_open ( 'Module_controller/edit_menu/' . $module ['id'] );
	$data = array ( 
			'type' => 'submit', 
			'content' => 'Modifier', 
			'class' => 'btn btn-primary btn-xs' 
	);
	echo form_button ( $data );
	echo form_close ();
	
	$params = array ( 
			
			'onsubmit' => 'return(validate(this));' 
	);
	echo "</center></td>";
	echo "<td><center>";
	echo form_open ( 'Module_controller/delete/' . $module ['id'], $params );
	$data = array ( 
			
			'type' => 'submit', 
			'content' => 'Supprimer', 
			'class' => 'btn btn-danger btn-xs' 
	);
	echo form_button ( $data );
	echo form_close ();
	echo "</center></td></tr>";
}
echo "</tbody></table>";
?>
			
			
						</div>
						</div>
						</div>
						</div>
						<script type="text/javascript">
function validate(){
	   return confirm("voulez vous supprimer supprimer ce module ?");
}
</script>