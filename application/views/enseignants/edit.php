
<div class="container">
	<h2>Mon Compte</h2>

<?php
echo "<p>";
echo $nom . " " . $prenom;
echo "</p>";

echo "<p>";
echo "Statut : " . $statut;
echo "</p>";
echo "<p>";
echo "Statutaire : " . $statutaire;
echo "</p>";

echo "<p>";

/**
 * * Actif **
 */
echo "Compte actif : ";
if ( $actif ) {
	echo "<INPUT type='checkbox' name='actif' value='actif' disabled='disabled' checked>";
} else {
	echo "<INPUT type='checkbox' name='actif' value='inactif' disabled='disabled'>";
}
echo "</p>";

/**
 * * Admin ***
 */
echo "<p>";
echo "Compte administrateur : ";
echo $administrateur;
if ( $administrateur ) {
	echo "<INPUT type='checkbox' name='administrateur' value='administrateur' disabled='disabled' checked>";
} else {
	echo "<INPUT type='checkbox' name='administrateur' value='enseignant' disabled='disabled'>";
}
echo "</p>";
?>
</div>