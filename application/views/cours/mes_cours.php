<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modules</h3>
				</div>

				<script src="http://cdn.amcharts.com/lib/3/amcharts.js"
					type="text/javascript"></script>
				<script src="http://www.amcharts.com/lib/3/radar.js"
					type="text/javascript"></script>

				<!-- amCharts javascript code -->
				<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "radar",
					"path": "https://www.amcharts.com/lib/3/",
					"categoryField": "Module",
					"startDuration": 2,
					"graphs": [
						{
							"balloonText": "[[value]] heures",
							"bullet": "round",
							"id": "AmGraph-1",
							"valueField": "Heures"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"axisTitleOffset": 20,
							"gridType": "circles",
							"id": "ValueAxis-1",
							"minimum": 0,
							"axisAlpha": 0.15,
							"dashLength": 3
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [],
					"dataProvider": [
<?php
$i = 0;
foreach ( $modules as $module ) {
	$hed_total = 0;
	foreach ( $cours [$i] as $cours_mod ) {
		$hed_total += $cours_mod ['hed'];
	}
	echo "{	\"Heures\": \"$hed_total\" ,
					\"Module\": \"" . $module ['nom'] . "\" ,
				},";
	$i ++;
}
?>
					]
				}
			);
		</script>

				<div id="chartdiv"
					style="width: 100%; height: 400px; background-color: #FFFFFF;"></div>

				<table id='modules' class='table table-hover table-striped'>
					<thead>
						<tr>
							<th><center>Module</center></th>
							<th><center>Promo</center></th>
							<th><center>Semestre</center></th>
							<th><center>Description</center></th>
							<th><center>Responsable</center></th>
							<th><center>Volume Horaire</center></th>
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
			echo "<td><center>";
			if ( $key == 'responsable' ) {
				if ( $value == null ) {
					echo "<a href=" . site_url ( "Enseignant_controller/inscrire/" . $module ['id'] ) . ">m'incrire</a>";
				} elseif ( $value == $this -> session -> userdata ( 'me' )['login'] ) {
					echo "<a href=" . site_url ( "Enseignant_controller/retirer/" . $module ['id'] ) . ">me retirer</a>";
				} else {
					echo $value;
				}
			} else {
				echo $value;
			}
			echo "</center></td> ";
		}
	}
	
	$hed_total = 0;
	foreach ( $cours [$i - 1] as $cours_mod ) {
		$hed_total += $cours_mod ['hed'];
	}
	echo "<td><center>$hed_total</center></td>";
	
	echo "</tr>";
	echo "<tr>
	<td colspan='7' class='hiddenRow'>
	<div class='accordion-body collapse packageDetails$i'
		id='accordion$i'>
		<table id='tableSearchResults' class='table table-hover table-striped'>";
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
				echo "<center>";
				if ( $key == 'enseignant' ) {
					if ( $value == null ) {
						echo "<a href=" . site_url ( "Enseignant_controller/inscrire/" . $module ['id'] . '/' . $cours_mod ['partie'] ) . ">m'incrire</a>";
					} elseif ( $value == $this -> session -> userdata ( 'me' )['login'] ) {
						echo "<a href=" . site_url ( "Enseignant_controller/retirer/" . $module ['id'] . '/' . $cours_mod ['partie'] ) . ">me retirer</a>";
					} else {
						echo $value;
					}
				} else {
					echo $value;
				}
				
				echo "</center>";
				echo "</td>";
			}
		}
		echo "<td>";
		echo "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
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
<script type="text/javascript">
$('#accordion1').on('shown.bs.collapse', function () {
    $("#package1 i.indicator").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
});
$('#accordion1').on('hidden.bs.collapse', function () {
    $("#package1 i.indicator").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
});

</script>