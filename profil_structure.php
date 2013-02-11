<?php 
//error_reporting(E_ALL ^ E_NOTICE); //Enl�ve les notices

	if($_SESSION['type'] == 'a') $req =  "SELECT * FROM ARTISTE WHERE id_artiste = ".$_SESSION['id_artiste']; else $req =  "SELECT * FROM membre WHERE id_membre = ".$_SESSION['id_membre']; 
	$res = mysql_query($req) or die(mysql_error());
	$ligne = mysql_fetch_assoc($res); 
$_SESSION['avatar'] = $ligne['avatar'];
$_SESSION['pseudo'] = $ligne['pseudo'];

//Selection des oeuvres du membre connecte (Si c'est un artiste)
if($_SESSION['type'] == 'a' ){
$req = 	"SELECT `id_oeuvre`, `id_artiste`, `titre`, `url`, `date_updated`, `synopsis`, `avis_artiste`, `id_genre1`, `id_genre2` FROM `oeuvre` 
		WHERE id_artiste = ".$_SESSION['id_artiste'];
$res = mysql_query($req);
$i = 0;
$_SESSION['fiche_artiste'] = array();
	while($ligne = mysql_fetch_assoc($res)){
		$_SESSION['fiche_artiste'][$i] = $ligne; //Variable de session contenant la totalit� des oeuvres de l'artiste dont c'est la page
		$i++; //$i est le nombre d'oeuvres cr�es
	}
}

/*Page courante ?*/
$page_courante = 'profil';
if (isset($_GET["onglet"])) {
	$page_courante = $_GET["onglet"]; 
	if (is_numeric($_GET["onglet"])) 
		$_GET['num']= $_GET["onglet"];
}

include("includes/nav_haut.php");

	//bloc central
	
	// Profil commun aux Artistes  && Membre
	switch($page_courante){
	case 'profil': 
		//ARTISTE
		if($_SESSION['type'] == 'a') include('modif_compte_artiste.php'); 
		else include('modif_compte_membre.php');
	break;
	case 'recap': 
			echo "<div style='border-bottom:7px black ridge;margin-bottom: 10px;'>
			<div class='section_titre' align='center'>Oeuvres mises en ligne </div></div>";
			$cpt = 0;  ?>

<!-- Systeme de notes -->
			<?php
			while($cpt < $i){
				$url = urldecode($_SESSION['fiche_artiste'][$cpt]['url']);
				$description_url = "index.php?page=".$_SESSION['genre']."&id_artiste=".$_SESSION['id_artiste']."&id_oeuvre=".$_SESSION['fiche_artiste'][$cpt]['id_oeuvre'];
				echo "<a href='$description_url'><img src='$url'/></a>"; 
			$cpt++;
			}
	break;
	case '1': require_once('includes/bloc_upload.php'); break;
	case '2': require_once('includes/bloc_upload.php'); break;
	case '3': require_once('includes/bloc_upload.php'); break;

	}

	//BLOC INTERACTION
	//require_once('includes/bloc_interaction.php');
?>
 <!--FIN BLOC PRINCIPAL -->