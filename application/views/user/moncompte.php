
<div class="container">
	<h2>
<?php echo $title;?>
	</h2>

<?php
echo "<p>";
echo $user ['nom'] . " " . $user ['prenom'];
echo "</p>";

echo "<p>";
echo "Statut : " . $user ['statut'];
echo "</p>";
echo "<p>";
echo "Statutaire : " . $user ['statutaire'];
echo "</p>";

echo "<p>";
$actif = $user ['actif'];

if ( $actif == '1' ) {
	echo "<form method='POST'>";
	echo "Compte actif : ";
	echo "<INPUT type='checkbox' name='nom' value='actif' disabled='disabled' checked>";
	echo "</form>";
} else {
	echo "<form method='POST'>";
	echo "Compte actif : ";
	echo "<INPUT type='checkbox' name='nom' value='actif' disabled='disabled'>";
	echo "</form>";
}
echo "</p>";

echo "<p>";
$admin = $user ['administrateur'];

if ( $admin == '1' ) {
	echo "<form method='POST'>";
	echo "Administrateur : ";
	echo "<INPUT type='checkbox' name='nom' value='actif' disabled='disabled' checked>";
	echo "</form>";
} else {
	echo "<form method='POST'>";
	echo "Administrateur : ";
	echo "<INPUT type='checkbox' name='nom' value='actif' disabled='disabled'>";
	echo "</form>";
}
echo "</p>";
?>
</div>