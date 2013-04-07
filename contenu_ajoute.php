<?php

$reqContenuAjoute = "SELECT * FROM oeuvre ORDER BY date_updated DESC LIMIT 4";
$resContenuAjoute = mysql_query($reqContenuAjoute) OR die("erreur selection note ".mysql_error());;

$x = 0;
$titre = "";
while($tabContenuAjoute = mysql_fetch_assoc($resContenuAjoute))
{/*
$reqOeuvre = "SELECT * FROM oeuvre WHERE id_oeuvre = '".$tabContenuAjoute['id_oeuvre']."'";
$resOeuvre = mysql_query($reqOeuvre) OR die("erreur selection oeuvre ".mysql_error());
$tabOeuvre = mysql_fetch_assoc($resOeuvre);*/
$reqGenre = "SELECT * FROM genre WHERE id_genre= '".$tabContenuAjoute['id_genre1']."'";
$resGenre = mysql_query($reqGenre) OR die("erreur selection genre ".mysql_error());
$tabGenre = mysql_fetch_assoc($resGenre);
$genre = $tabGenre['type'];
		
$heure = conversionToHourFacebook(new DateTime($tabContenuAjoute['date_updated']));
$type = getTypeId($tabContenuAjoute['id_artiste']);
$src = getSrcAvatar($tabContenuAjoute['id_artiste'],$type);
//$id_note = $ligne['id_note'];
$titre = $tabContenuAjoute['titre']; 
$url = "index.php?page=".$genre."&id_artiste=".$tabContenuAjoute['id_artiste']."&id_oeuvre=".$tabContenuAjoute['id_oeuvre'];
echo "<a href='".$url."' ><img src='".$tabContenuAjoute['url']."' alt='".$titre."' title='".$titre."' class='contenuAjoute'/></a>";
$x++;
}

?>
