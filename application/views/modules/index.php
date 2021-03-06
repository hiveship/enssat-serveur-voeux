<div class="container">


	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modules</h3>
				</div>
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
					echo "<a href=" . site_url( "enseignants/inscrire/" . $module ['id'] ) . ">Inscrire</a>";
				} elseif ( $value == $this -> session -> userdata( 'me' )['login'] ) {
					echo "<a href=" . site_url( "enseignants/retirer/" . $module ['id'] ) . ">Retirer</a>";
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
	$hed_pris = 0;
	foreach ( $cours [$i - 1] as $cours_mod ) {
		$hed_total += $cours_mod ['hed'];
		if ( $cours_mod ['enseignant'] != NULL ) {
			$hed_pris += $cours_mod ['hed'];
		}
	}
	if ( $hed_pris != $hed_total ) {
		echo "<td class='success'><center>$hed_pris h / $hed_total h</center></td>";
	} else {
		echo "<td class='danger'><center>$hed_total (complet) </center></td>";
	}
	echo "</tr>";
	echo "<tr>
	<td colspan='7' class='hiddenRow'>
	<div class='accordion-body collapse packageDetails$i'
		id='accordion$i'>
		<table id='tableSearchResults' class='table table-bordered table-hover table-striped table-condensed'>";
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
						echo "<a href=" . site_url( "enseignants/inscrire/" . $module ['id'] . '/' . rawurlencode( $cours_mod ['partie'] ) ) . ">Inscrire</a>";
					} elseif ( $value == $this -> session -> userdata( 'me' )['login'] ) {
						echo "<a href=" . site_url( "enseignants/retirer/" . $module ['id'] . '/' . rawurlencode( $cours_mod ['partie'] ) ) . ">Retirer</a>";
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


