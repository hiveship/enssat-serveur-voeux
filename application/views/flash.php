<!--  TODO il faut optimiser ce code étant donné que seul le 'level' change d'une div à l'autre ! -->

<div class="container">
	<br />
<?php
if ( $success ) {
	?>
<div class="alert alert-success fade in"> <?= $success?><a href="#" class="close"
			data-dismiss="alert">&times;</a>
	</div>
<?php
}
?>
<?php

if ( $error ) {
	?>

<div class="alert alert-danger fade in"> <?= $error?><a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
<?php
}
?><?php

if ( $warning ) {
	?>
<div class="alert alert-warning fade in"> <?= $warning?><a href="#" class="close"
			data-dismiss="alert">&times;</a>
	</div>
<?php
}
?><?php

if ( $info ) {
	?>
<div class="alert alert-info fade in"> <?= $info?><a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
<?php
}
?>
</div>