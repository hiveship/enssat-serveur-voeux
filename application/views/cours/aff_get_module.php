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
			</tr>
		</thead>";
echo "<tbody>";
foreach ( $modules as $module ) {
	echo "<tr>";
	foreach ( $module as $value ) {
		echo "<td> $value </td> ";
	}
	echo "</tr>";
}
echo "</tbody></table>";
?>
