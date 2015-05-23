<div id="OrderPackages">
	<table id="tableSearchResults" class="table table-hover  table-striped table-condensed">
		<thead>
			<tr>
				<th>Package ID</th>
				<th>Quantity</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr id="package1" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages"
				data-target=".packageDetails1">
				<td>123456</td>
				<td>3</td>
				<td><i class="indicator glyphicon glyphicon-chevron-up pull-right"></i></td>
			</tr>
			<tr>
				<td colspan="3" class="hiddenRow">
					<div class="accordion-body collapse packageDetails1" id="accordion1">
						<table>
							<tr>
								<td>Revealed item 1</td>
							</tr>
							<tr>
								<td>Revealed item 2</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr id="package2" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages"
				data-target=".packageDetails2">
				<td>654321</td>
				<td>2</td>
				<td><i class="indicator glyphicon glyphicon-chevron-up pull-right"></i></td>
			</tr>
			<tr>
				<td colspan="3" class="hiddenRow">
					<div class="accordion-body collapse packageDetails2" id="accordion2">
						<table>
							<tr>
								<td>Revealed item 1</td>
							</tr>
							<tr>
								<td>Revealed item 2</td>
							</tr>
							<tr>
								<td>Revealed item 3</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr></tr>
		</tbody>
	</table>
</div>