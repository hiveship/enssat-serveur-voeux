<div class="container">

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
				<table class="table table-hover" id="dev-table">
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