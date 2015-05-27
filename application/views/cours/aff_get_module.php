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
	echo form_open ( 'Module_controller/edit_menu' );
	$data = array ( 
			'name' => 'ID', 
			'value' => $module ['ident'], 
			'type' => 'submit', 
			'content' => 'Modifier', 
			'class' => 'btn btn-primary' 
	);
	echo form_button ( $data );
	echo "</td></tr>";
}
echo "</tbody></table>";
?>
