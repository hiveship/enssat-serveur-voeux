<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Enseignants</h3>
				</div>
				<div class="panel-body">
					<input id="search-enseignants" type="text" class="form-control" data-action="filter"
						data-filters="#dev-table" placeholder="Rechercher..." />
				</div>
				<table class="table table-hover" id="enseignants">
					<thead>
						<tr>
							<th><center>Nom</center></th>
							<th><center>Prenom</center></th>
							<th><center>Email</center></th>
							<th><center>Rang</center></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
								<?php
								foreach ( $enseignants as $enseignant ) {
									?>
		<tr>

							<td>
								<center><?php echo mb_strtoupper($enseignant['nom'],'UTF-8')?></center>
							</td>
							<td>
								<center><?php echo $enseignant['prenom']?></center>
							</td>
							<td>
								<center><?php echo $enseignant['email']?></center>
							</td>
					<?php if($enseignant['administrateur']) {?>
					<td>
								<center>
									<span class="label label-danger"> Administrateur </span>
								</center>
							</td> <?php } else {?>
					<td>
								<center>
									<span class="label label-success"> Enseignant </span>
								</center>
							</td><?php }?>
						</tr>
		<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
//Colonnes triables
oTable = $('#enseignants').DataTable( {
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
           ]
 
} );

//Barre de recherche
$('#search-enseignants').keyup(function(){
   oTable.search($(this).val()).draw() ;
});
</script>