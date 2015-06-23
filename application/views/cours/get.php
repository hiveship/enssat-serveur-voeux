<?php
// TODO pas idéal d'avoir cette fonction ici, il faudrait plutôt appeler la fonction écrite dans Enseignant_controller.
function convert_heures ( $heures, $type )
{
	switch ( $type ) {
		case "CM" :
			return $heures * COEF_CM;
		case "TD" :
			return $heures * COEF_TD;
		case "TP" :
			return $heures * COEF_TP;
		case "DS" :
			return $heures * COEF_DS;
		case "Projet" :
			return $heures * COEF_TP;
		default :
			return $heures;
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modules</h3>
				</div>

				<script type="text/javascript"
					src="<?php echo base_url("assets/js/amcharts.js"); ?>"></script>
				<script type="text/javascript"
					src="<?php echo base_url("assets/js/radar.js"); ?>"></script>

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
							"balloonText": "[[value]] heures réelles",
							"bullet": "round",
							"id": "AmGraph-1",
							"valueField": "Heures"
						},
						{
							"balloonText": "[[value]] heures_TD",
							"bullet": "round",
							"id": "AmGraph-2",
							"valueField": "Heures_TD"
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
	$heures = 0;
	$heures_TD = 0;
	foreach ( $cours [$i] as $cours_mod ) {
		$heures += $cours_mod ['hed'];
		$heures_TD += convert_heures ( $cours_mod ['hed'], $cours_mod ['type'] );
	}
	echo "{	\"Heures\": \"$heures\" ,
						\"Heures_TD\": \"$heures_TD\" ,
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
				} elseif ( $this -> session -> userdata ( 'me' )['administrateur'] ) {
					echo "<a href=" . site_url ( "admin/Enseignant_controller/retirer/" . $module ['responsable'] . "/" . $module ['id'] ) . ">retirer</a>";
				} else {
					echo $value;
				}
			} else {
				echo $value;
			}
			echo "</center></td> ";
		}
	}
	
	$heures = 0;
	$heures_TD = 0;
	foreach ( $cours [$i - 1] as $cours_mod ) {
		$heures += $cours_mod ['hed'];
		$heures_TD += convert_heures ( $cours_mod ['hed'], $cours_mod ['type'] );
	}
	
	if ( $module ['responsable'] == $this -> session -> userdata ( 'me' )['login'] ) {
		echo "<td class='info'>";
	} else {
		echo "<td>";
	}
	
	if ( $heures == 0 ) {
		echo "<center>Uniquement responsable</center></td>";
	
	} else {
		echo "<center>$heures ($heures_TD)</center></td>";
	}
	
	echo "</tr>";
	echo "<tr>
	<td colspan='7' class='hiddenRow'>
	<div class='accordion-body collapse packageDetails$i'
		id='accordion$i'>
		<table id='tableSearchResults' class='table table-hover table-striped table-condensed'>";
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
					echo "<a href=" . site_url ( "Enseignant_controller/retirer/" . $module ['id'] . '/' . rawurlencode ( $cours_mod ['partie'] ) ) . ">me retirer</a>";
				} else if ( $key == 'hed' ) {
					echo "$value (" . convert_heures ( $value, $cours_mod ['type'] ) . ")";
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

