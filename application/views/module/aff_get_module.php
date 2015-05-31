<div class="container">
<?php
echo "<table id='tableSearchResults' class='table table-hover 
		table-striped table-condensed'>";
echo "<thead>
			<tr>
				<th>Module</th>
				<th>Promo</th>
				<th>Semestre</th>
				<th>Description</th>
				<th>Responsable</th>
				<th>Action<th>
			</tr>
		</thead>";
echo "<tbody>";
foreach ( $modules as $module ) {
	echo "<tr>";
	foreach ( $module as $value ) {
		echo "<td> $value </td> ";
	}
	echo "<td>";
	echo form_open( 'Module_controller/edit_menu' );
	$data = array ( 
		
			'name' => 'ID', 
			'value' => $module ['ident'], 
			'type' => 'submit', 
			'content' => 'Modifier', 
			'class' => 'btn btn-primary btn-xs' 
	);
	echo form_button( $data );
	echo form_close();
	
	$params = array ( 
		
			'onsubmit' => 'return(validate(this));' 
	);
	echo form_open( 'Module_controller/delete', $params );
	$data = array ( 
		
			'name' => 'ID', 
			'value' => $module ['ident'], 
			'type' => 'submit', 
			'content' => 'Supprimer', 
			'class' => 'btn btn-danger btn-xs' 
	);
	echo form_button( $data );
	echo form_close();
	echo "</td></tr>";
}
echo "</tbody></table>";
?>
</div>
<script type="text/javascript">
function validate(){
	   return confirm("voulez vous supprimer supprimer ce module ?");
}
</script>