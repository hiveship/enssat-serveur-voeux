<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Enseignants</h3>
				</div>
				<div class="panel-body">
					<input type="text" class="form-control" id="search-enseignants-admin" data-action="filter"
						data-filters="#dev-table" placeholder="Rechercher..." />
				</div>
				<table class="table table-striped table-hover" id="enseignants-admin">
					<thead>
						<tr>
							<th><center>Droits</center></th>
							<th><center>Identité</center></th>
							<th><center>Email</center></th>
							<th><center>Statut</center></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
								<?php
								foreach ( $enseignants as $enseignant ) {
									?>
		<tr>
							<td>
								<center>
							
		<?php if($enseignant['administrateur']) {?>
									<span title="Administrateur" class="label label-danger"> </span>
						 <?php } else {?>
										<span title="Enseignant" class="label label-success"> </span>							<?php }?></center>
							</td>
							<td>
								<center><?php echo mb_strtoupper($enseignant['nom'],'UTF-8')." ".ucfirst($enseignant['prenom'])?></center>
							</td>
							<td>
								<center><?php echo $enseignant['email']?></center>
							</td>
							<td>
								<center><?php echo ucfirst($enseignant['statut'])?></center>
							</td>
							<td><a href="<?php echo site_url('/enseignants/cours_de/'.$enseignant['login']) ?>"> <i
									class="fa fa-tasks"></i> Ses cours
							</a></td>
						</tr>
		<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
									
// Colonnes triables
oTable = $('#enseignants-admin').DataTable( {
    paging: false,
    "language": {
        "zeroRecords": "Aucune résultat ne correspond à votre recherche.",
    },
    "aaSorting": [
                  [0, "asc"]
              ],
              "aoColumns": [
                  null,
                  null,
                  null,
                  null,
                  {'bSortable': false },
              ]
    
} );

// Barre de recherche
$('#search-enseignants-admin').keyup(function(){
      oTable.search($(this).val()).draw() ;
});
</script>
