
<div class="container">
	<h2>Mon Compte</h2>

	<p><?php echo $nom . " " . $prenom; ?></p>
	<p> Statut: <?php echo $statut; ?></p>
	<p> Statutaire: <?php echo $statutaire; ?></p>
	<p> Compte actif :

	<?php
	if ( $actif ) {
		echo "<INPUT type='checkbox' name='actif' value='actif' disabled='disabled' checked>";
	} else {
		echo "<INPUT type='checkbox' name='actif' value='inactif' disabled='disabled'>";
	}
	?>
</p>
	<p> Compte administrateur :

<?php

if ( $administrateur ) {
	echo "<INPUT type='checkbox' name='administrateur' value='administrateur' disabled='disabled' checked>";
} else {
	echo "<INPUT type='checkbox' name='administrateur' value='enseignant' disabled='disabled'>";
}

?>
</p>























</div>