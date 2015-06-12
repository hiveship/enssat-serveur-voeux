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
								<table
									class="table table-condensed table-responsive table-user-information">
									<tbody>

<?php
// $module = 1;
echo form_open ( "Cours_controller/create/$module", 'role="form"' );

echo "<p id=P0>";
echo br ( 2 );

$Pn = array ( 
		
		'name' => 'nom' 
);

echo form_label ( 'Nom Partie: ', 'Partie' );
echo form_input ( $Pn, '', 'class="form-control"' );

$Pt = array ( 
		
		'CM' => 'CM', 
		'TD' => 'TD', 
		'TP' => 'TP', 
		'DS' => 'DS' 
);

echo form_label ( 'Type: ', 'Type' );
echo form_dropdown ( 'type', $Pt, 'CM' );

$Ph = array ( 
		
		'name' => 'hed', 
		'type' => 'number', 
		'value' => '30' 
);
echo form_label ( 'hed: ', 'hed' );
echo form_input ( $Ph );

echo "</p>";

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