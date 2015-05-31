<div class="container">

	<button type="button" class="btn btn-primary pull-right" data-toggle="modal"
		data-target="#ajoutEnseignant">Ajouter un enseignant</button>
	<br> <br>

	<div class="modal fade" id="ajoutEnseignant" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="exampleModalLabel">Nouvel enseignant</h4>
				</div>
				<div class="modal-body">
					<form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST"
						action=<?php echo site_url("admin/enseignants/create");?>>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nom">Nom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="nom"
										name="nom" class="form-control" placeholder="Nom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="prenom">Prénom</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="prenom"
										name="prenom" class="form-control" placeholder="Prénom" type="text" required="">
								</div>
							</div>
						</div>

						<!-- Prepended text-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-5">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> <input id="email"
										name="email" class="form-control" placeholder="Email" type="email" required="">
								</div>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statutaire">Statutaire</label>
							<div class="col-md-2">
								<input id="statutaire" name="statutaire" type="number" value=192
									class="form-control input-md" required="">
							</div>
							<div class="col-md-5">
								<span class="help-block">En heures équivalent TD</span>
							</div>

						</div>

						<!-- Select Basic -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="statut">Statut</label>
							<div class="col-md-4">
								<select id="statut" name="statut" class="form-control">
									<?php
									foreach ( $allowedStatuts as $statut ) {
										?>
										<option value="<?php echo $statut ;?>"><?php echo ucfirst($statut);?></option>
										<?php }?>
									</select>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="administrateur">Statut</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="administrateur-0"> <input type="radio" name="administrateur"
										id="administrateur-0" value="0" checked="checked"> Enseignant
									</label>
								</div>
								<div class="radio">
									<label for="administrateur-1"> <input type="radio" name="administrateur"
										id="administrateur-1" value="1"> Administrateur
									</label>
								</div>
							</div>
						</div>

						<!-- Multiple Radios -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="actif">Etat</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="actif-0"> <input type="radio" name="actif" id="actif-0" value="1"
										checked="checked"> Actif
									</label>
								</div>
								<div class="radio">
									<label for="actif-1"> <input type="radio" name="actif" id="actif-1" value="0"> Inactif
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">

							<div class="modal-footer">
								<button id="submit-button" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
								<button type="submit" href="#" class="btn btn-primary pull-right">Valider</button>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Enseignants</h3>
				</div>
				<div class="panel-body">
					<input type="text" class="form-control" id="dev-table-filter" data-action="filter"
						data-filters="#dev-table" placeholder="Rechercher..." />
				</div>
				<table class="table table-striped table-hover" id="dev-table">
					<thead>
						<tr>
							<th><center>Nom</center></th>
							<th><center>Prenom</center></th>
							<th><center>Email</center></th>
							<th><center>Rang</center></th>
							<th></th>
							<th></th>
							<th></th>
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
								<center><?php echo ucfirst($enseignant['prenom'])?></center>
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
					<td>
								<center>
								<?php
									if ( $enseignant ['actif'] ) {
										?>
								<a href="<?php echo site_url('admin/enseignants/deactivate/'.$enseignant['login']) ?>"> <i
										class="fa fa-eye"></i> Désactiver
									</a>
									<?php } else { ?>
									<a href="<?php echo site_url('admin/enseignants/activate/'.$enseignant['login']) ?>"> <i
										class="fa fa-eye-slash"></i> Activer
									</a>
									<?php }?>
									
								</center>
							</td>
						</tr>
		<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
/**
 * Script ok pour des tables de tailles raisonables, mais provoquera de gros problèmes de performances sur des énormes tables de données.
 */
(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this),
                        search = $this.val().toLowerCase(),
                        target = $this.attr('data-filters'),
                        $target = $(target),
                        $rows = $target.find('tbody tr');
                        
					if(search == '') {
						$rows.show();
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">Aucun résultat correspondant à votre recherche.</td></tr>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();
	
	$('.container').on('click', '.panel-heading span.filter', function(e){
		var $this = $(this),
			$panel = $this.parents('.panel');
		
		$panel.find('.panel-body').slideToggle();
		if($this.css('display') != 'none') {
			$panel.find('.panel-body input').focus();
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
})
</script>