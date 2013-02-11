<?php
//$i est le nombre d'oeuvres crées

echo "<div class='menu' >
	<ul > 
		<li><a href='index.php?page=profil_structure&onglet=profil'"; if($page_courante == "profil" ){echo "class='active'";} echo ">Profil</a></li>";
	if($_SESSION['type'] == 'a'){echo "<li><a href='index.php?page=profil_structure&onglet=recap'"; if($page_courante == "recap"){echo "class='active'";} echo ">Recapitulatif</a></li>";
			if($i >= 0){
		echo "<li><a href='index.php?page=profil_structure&onglet=1'"; if($page_courante == "1"){echo "class='active'";} echo ">Oeuvre 1</a></li>";}
			if($i  >=1){
		echo "<li><a href='index.php?page=profil_structure&onglet=2'"; if($page_courante == "2"){echo "class='active'";} echo ">Oeuvre 2</a></li>";}
			if($i  >= 2){
		echo "<li><a href='index.php?page=profil_structure&onglet=3'"; if($page_courante == "3"){echo "class='active'";} echo ">Oeuvre 3</a></li>";}}
	echo "</ul>
</div>";
?><br />