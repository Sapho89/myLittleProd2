<?php
echo "<header>";
	$req = "SELECT * FROM ARTISTE where id_artiste = ".$_SESSION["id_membre"];
	$res = mysql_query($req);
	$ligne = mysql_fetch_assoc($res);
		echo "<a href='profil_artiste_structure.php'>".$ligne["prenom"]."&nbsp;".$ligne["nom"]."</a>
		<img src='".$ligne["avatar"]."' title='photo profil' width='50px' height='50px'/>
	</header>";
?>