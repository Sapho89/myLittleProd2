<?php
$page = $_GET['page'];
if(!empty($page))
{
	$tab = array("video","litterature","image","musique");
	
	//Pages thématiques
	if(in_array($page,$tab)){
		$_SESSION['page'] = $page;
		include_once("affichage_oeuvres.php");
	}
	else { 
		switch($page){
			case 'profil_structure' : 	include_once("profil_structure.php"); break;
			case 'contact' : 			include_once("contact.php"); break;
			case 'recherche' : 			include_once("moteur_recherche.php"); break;
			case 'resultats' : 			include_once("resultats.php"); break;
			default: header('location: erreur 404.php');
		}
		  }
}

?>

