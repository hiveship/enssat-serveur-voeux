<div class="container">
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
						<h1 class="panel-title">
							<p>Création de module</p>
						</h1>
					</div>
					<div class="panel-body">
						<div class="row-fluid">
							<div>
								<table class="table table-condensed table-responsive table-user-information">
									<tbody>
			<?php
			
			echo form_open ( 'admin/module/create', 'role="form"' );
			$ID = array ( 
					
					'id' => 'ID', 
					'name' => 'ID', 
					'value' => set_value ( 'ID' ) 
			);
			echo form_label ( "Nom d'affichage", 'ID' );
			echo form_input ( $ID, '', 'class="form-control"' );
			echo form_error ( 'ID' );
			
			$public = array ( 
					
					'name' => 'public', 
					'id' => 'public', 
					'value' => set_value ( 'public' ) 
			);
			echo form_label ( 'public: ', 'public' );
			echo form_input ( $public, '', 'class="form-control"' );
			echo form_error ( 'public' );
			
			$semestre = array ( 
					
					'name' => 'semestre', 
					'id' => 'semestre', 
					'value' => set_value ( 'semestre' ) 
			);
			echo form_label ( 'semestre: ', 'semestre' );
			echo form_input ( $semestre, '', 'class="form-control"' );
			echo form_error ( 'semestre' );
			
			$libelle = array ( 
					
					'name' => 'libelle', 
					'id' => 'libelle', 
					'value' => set_value ( 'libelle' ) 
			);
			echo form_label ( 'libelle: ', 'libelle' );
			echo form_input ( $libelle, '', 'class="form-control"' );
			echo form_error ( 'libelle' );
			
			//
			//
			// debut gestion dynamique parties de modules
			//
			//
			
			echo "<div id=parties><p id=P0>";
			echo br ( 2 );
			
			$Pn = array ( 
					
					'name' => 'P0-Pname' 
			);
			
			echo form_label ( 'Nom Partie: ', 'Partie' );
			echo form_input ( $Pn, '', 'class="form-control"' );
			
			$Pt = array ( 
					
					'Projet' => 'Projet', 
					'CM' => 'CM', 
					'TD' => 'TD', 
					'TP' => 'TP', 
					'DS' => 'DS' 
			);
			
			echo form_label ( 'Type: ', 'Type' );
			echo form_dropdown ( 'P0-Ptype', $Pt, 'CM' );
			
			$Ph = array ( 
					
					'name' => 'P0-Phed', 
					'type' => 'number', 
					'value' => '30' 
			);
			echo form_label ( 'hed: ', 'hed' );
			echo form_input ( $Ph );
			
			echo "</p></div>";
			
			//
			//
			// fin zone dynamique
			//
			//
			echo br ( 2 );
			$button = array ( 
					
					'type' => 'button', 
					'name' => 'ajouter partie', 
					'content' => 'Ajouter Partie', 
					'onClick' => 'ajouterPartie()', 
					'class' => 'btn btn-primary btn-xs' 
			);
			echo form_button ( $button );
			
			echo form_submit ( 'submit', 'creer', 'class="btn btn-primary pull-right"' );
			
			echo form_close ();
			?>
			</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
var ID = <?php echo 1;?>;
			
function ajouterPartie() {

	var form = $( "#P0" ).clone().html();
	form = replaceAll("P0", "P"+ID,form);

	button = '<button class="btn btn-danger btn-xs pull-right" onclick="supprimerPartie('+ID+')" type="button">'+
	'supprimer Partie'+
	'</button>';
	
	$('#parties').append("<p id='P"+ID+"'>"+form+button+"</p>");
	ID++;
}

function supprimerPartie(ID){
				$( "#P" + ID ) . remove ();
			}

function replaceAll(find, replace, str) {
	  return str.replace(new RegExp(find, 'g'), replace);
	}
</script>
