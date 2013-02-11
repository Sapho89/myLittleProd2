<?php

if(isset($_POST['rechercher']))
{

$critereJointure = ""; 
$critereJointure = "a.id_artiste = o.id_artiste AND o.id_genre1 = g1.id_genre AND o.id_genre2 = g2.id_genre";

if	(
($_POST['genre'] == "") &&
($_POST['titre'] == "") &&
($_POST['artiste'] == "")
	) 
	{
	header("location: index.php"); 
	}
	
else if($_POST['titre'] != "")	

	{
	
	
	
	$titre = $_POST['titre'];
	
	$critereTitre = "";
	$critereTitre = " titre LIKE ( '%".$titre."%' ) ";	
 
	$requeteRecherche = "SELECT o.*,a.*,g1.id_genre,
						g1.genre as genre1, g1.type,
						g2.id_genre,
						g2.genre as genre2,
						g2.type  FROM oeuvre as o,
						genre as g1,
						genre as g2,
						artiste as a 
						WHERE $critereJointure AND $critereTitre ";
 
		if($_POST['artiste'] != ''){

		$artiste = $_POST['artiste'];

		$critereArtiste = "";
		$critereArtiste = " ( nom LIKE ( '%".$artiste."%') OR prenom LIKE ( '%".$artiste."%') )";

		$requeteRecherche.= " AND $critereArtiste";
		
		}
		
		if($_POST['genre'] != '') {

		$genre = $_POST['genre'];

		$critereGenre = '';	
		$critereGenre = " g1.type='".$genre."' AND O.id_genre1 = g1.id_genre AND O.id_genre2 = g2.id_genre AND O.id_artiste = A.id_artiste";		
		
		$requeteRecherche.=" AND $critereGenre";
		
		}
 //echo $requeteRecherche;

	include_once("afficherResultat.php");


 
	}else if ($_POST['artiste'] != '') {
	
		$artiste = $_POST['artiste'];

		$critereArtiste = "";
		$critereArtiste = " ( nom LIKE ( '%".$artiste."%') OR prenom LIKE ( '%".$artiste."%') )";

		$requeteRecherche = "SELECT o.*,
							a.*,g1.id_genre,
							g1.genre as genre1,
							g1.type,
							g2.id_genre,
							g2.genre as genre2,
							g2.type  
							FROM oeuvre as O, 
							genre as g1, 
							genre as g2, 
							artiste as A  
							WHERE $critereArtiste AND $critereJointure";
	
		 if($_POST['genre'] != ''){
	
			$genre = $_POST['genre'];

			$critereGenre = '';	
			$critereGenre = " g1.type='".$genre."' AND O.id_genre1 = g1.id_genre AND O.id_genre2 = g2.id_genre AND O.id_artiste = A.id_artiste";		
			
			$requeteRecherche.=" AND $critereGenre";
	
			}
	
		//echo $requeteRecherche;
		include_once("afficherResultat.php");
	
			}else if($_POST['genre'] != ''){
			
					$genre = $_POST['genre'];
				
					$critereGenre = '';	
					$critereGenre = " g1.type='".$genre."' AND O.id_genre1 = g1.id_genre AND O.id_genre2 = g2.id_genre AND O.id_artiste = A.id_artiste";	
					
					$requeteRecherche = "SELECT o.*,
										a.*,
										g1.id_genre,
										g1.genre as genre1, 
										g1.type,g2.id_genre,
										g2.genre as genre2,
										g2.type  
										FROM oeuvre as O,
										genre as g1, 
										genre as g2,
										artiste as A 
										WHERE $critereGenre";
			
			//echo $requeteRecherche;
			include_once("afficherResultat.php");
			}
			
			
			
}	

		

	
	?>




    
