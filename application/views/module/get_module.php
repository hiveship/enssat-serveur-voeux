<div class="container">
	<a href="<?php echo site_url("Module_controller/create") ?>"
		class='btn btn-primary pull-right'> <span
		class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Créer
		Module
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
$i = 1;
foreach ( $modules as $module ) {
	echo "<tr id='package$i' class='accordion-toggle' data-toggle='collapse' 
			data-parent='#OrderPackages' data-target='.packageDetails$i'>";
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
	echo "</center></td>";
	
	echo "</tr>";
	echo "<tr>
	<td colspan='3' class='hiddenRow'>
	<div class='accordion-body collapse packageDetails$i'
		id='accordion$i'>
		<table>";
	echo "<thead>
					<tr>
					<th><center>Partie</center></th>
					<th><center>Type</center></th>
					<th><center>HED</center></th>
					<th><center>Enseignant</center></th>
					</tr>
					</thead>";
	foreach ( $cours [$i - 1] as $cours_mod ) {
		echo "<tr>";
		foreach ( $cours_mod as $key => $value ) {
			if ( $key != "module" ) {
				echo "<td>";
				echo $value;
				echo "</td>";
			}
		}
		echo "</tr>";
	}
	
	echo "</table>
			</div>
			</td>
			</tr>";
	$i ++;

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

$('#accordion1').on('shown.bs.collapse', function () {
    $("#package1 i.indicator").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
});
$('#accordion1').on('hidden.bs.collapse', function () {
    $("#package1 i.indicator").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
});


</script>