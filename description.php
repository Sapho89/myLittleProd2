<?php
if(isset($_GET['id_oeuvre']) && isset($_GET['id_artiste'])){
			$reqInfo = "SELECT * FROM artiste AS A 
		INNER JOIN oeuvre AS O ON A.id_artiste = O.id_artiste
		WHERE id_oeuvre = '".$_GET['id_oeuvre']."' AND A.id_artiste='".$_GET['id_artiste']."'";
		
		if($rsInfo= mysql_query($reqInfo))
		{
			WHILE($tabInfo = mysql_fetch_assoc($rsInfo))
			{?>
	<div class="contenu_gauche">
		<div class="petit_bloc"> 
			<h2>&Agrave; propos de l'artiste</h2>
				<img class="avatar" src='<?php echo $tabInfo['avatar']; ?>'  alt='avatar'/>
			<p><?php echo htmlentities($tabInfo['description']); ?></p>
		</div>
	
			<?php

			$reqMmAuteur = "SELECT * FROM oeuvre as O, artiste as A WHERE  O.id_artiste = A.id_artiste AND A.id_artiste = '".$_GET['id_artiste']."'";
			if($resMmAuteur = mysql_query($reqMmAuteur))
			{
			

			
			?>
	
	
			<div class='petit_bloc'>		
			<?php
			 $i=0;
                         
                         if($_GET['page']!= 'musique') echo "<h2> Oeuvres du m&ecirc;me artiste </h2> ";
			 
				WHILE($tabMmAuteur = mysql_fetch_assoc($resMmAuteur))
					{ 

					
					if(($_GET['page'] == 'musique') && ($tabMmAuteur['id_oeuvre'] == $_GET['id_oeuvre']) ){
					
				?>
                            <h2> <?php echo $tabMmAuteur['titre']; ?> </h2> 
				
					<object type="application/x-shockwave-flash" data="musique/dewplayer-rect.swf?autostart=true" width="150" height="20" id="dewplayer" name="dewplayer">
					<param name="movie" value="musique/dewplayer-rect.swf?autostart=true" />
					<param name="flashvars" value="mp3=<?php echo $tabMmAuteur['url_son']; ?>" />
					<param name="wmode" value="transparent" />
					</object>
				
                            

                            
				<?php }else if($tabMmAuteur['id_oeuvre'] != $_GET['id_oeuvre']){?>
				
			
				
				<a href="index.php?page=<?php echo $_SESSION['page']; ?>&id_artiste=<?php echo $tabMmAuteur['id_artiste']; ?>&id_oeuvre=<?php echo $tabMmAuteur['id_oeuvre'];?>" target="_self">
				<img class="avatar" src="<?php echo $tabMmAuteur['url']; ?>"  title="<?php echo $tabMmAuteur['titre']; ?>" alt="<?php echo $tabMmAuteur['titre']; ?>"/></a>
				<?php
				
				
				}
				$i++;	
					}
					
			}else die("Aucune autre oeuvre du m�me auteur trouv�");//die("Impossible d'afficher les oeuvres du meme auteur ".mysql_error());
	

	?>
			</div>
	
	
	</div>
				
			
				
		<div class="contenu_central">
		<div class="bloc_horizontal">
	<h1><?php echo htmlentities($tabInfo['titre']); ?></h1><h4><?php echo "R&eacute;alis&eacute; par ".htmlentities($tabInfo['prenom'])." ".htmlentities($tabInfo['nom']); ?></h4>


	<br/>
	
        <?php if($_GET['page'] == 'video') {?>
       

<video id="player_a" class="projekktor" poster="<?php echo $tabInfo['url'];?>" title="this is projekktor" width="100%" height="auto" controls>
    <source src="<?php echo $tabInfo['url_son'];?>" type="video/mp4" />

</video>
        
        <?php }else { ?>
        
        
	<a href="<?php echo $tabInfo['url'];?>" onClick='PopupImage();return false;'>
		<img class='img_texte'	name='img_texte' src="<?php echo $tabInfo['url'];?>" alt='image'/>
		<!--<img src='image/loupe.png' id='loupe' alt='icone_loupe' width='25px' height='30px'/>-->
	</a>
	
        <?php  } ?>
        
	<p>
	
	<!-- Recuperation de la date au format francais -->
	
	<i>Publi&eacute; le <?php echo substr($tabInfo['date_updated'], 8, 2)."".substr($tabInfo['date_updated'], 4, 4)."".substr($tabInfo['date_updated'], 0, 4); ?></i>
	
        <!-- Note de l'oeuvre -->
         <?php if(getNote($_GET['id_oeuvre']) != 0 ) { ?>
        
        <?php echo "<br/>Note globale :".getNote($_GET['id_oeuvre']); 
        
         }else echo ""; ?>
        
	<!-- Description de l'artiste -->
	
	<h2>Description </h2><?php echo htmlentities($tabInfo['synopsis']); ?><br /><br />
	


<!-- Systeme de notes -->
<?php
if((isset($_SESSION["id_artiste"]) && !empty($_SESSION["id_artiste"])) || (isset($_SESSION["id_membre"]) &&  !empty($_SESSION["id_membre"])))
{
require_once("note.php");
}
else  { echo "<b>Pour noter une oeuvre ou la commenter, vous devez d'abord vous connecter !</b>";}
?>

	</div>
	


<div class="bloc_horizontal" >

	<h2> Autres oeuvres qui pourraient &eacute;galement vous int&eacute;resser</h2>
	
	<?php
	$reqAutre = "SELECT * FROM oeuvre as O, genre as g1, genre as g2, artiste as A WHERE O.id_oeuvre!='".$_GET['id_oeuvre']."' AND g1.type='".$_GET['page']."' AND O.id_genre1 = g1.id_genre AND O.id_genre2 = g2.id_genre AND O.id_artiste = A.id_artiste LIMIT 4";
	
        
        if($resAutre = mysql_query($reqAutre))
	{
	 $i=0;
		WHILE($tabAutre = mysql_fetch_assoc($resAutre))
			{ 

		?>
		<a href="index.php?page=<?php echo  $_GET['page']; ?>&id_artiste=<?php echo $tabAutre['id_artiste']; ?>&id_oeuvre=<?php echo $tabAutre['id_oeuvre'];?>" target="_self">
		<img src="<?php echo $tabAutre['url']; ?>" class="miniature" title="<?php echo $tabAutre['titre']; ?>" alt="<?php echo $tabAutre['titre']; ?>"/></a>
		<?php
		$i++;
			}
	}else die("Erreur affichage d'autres oeuvres ".mysql_error());
	?>
</div>

<?php
if( (isset($_SESSION["id_artiste"]) && !empty($_SESSION["id_artiste"]))
  || isset($_SESSION["id_membre"]) &&  !empty($_SESSION["id_membre"])  &&  
    isset($_SESSION['type']) && !empty($_SESSION['type']) )
{

//BLOC INTERACTION
require_once('includes/bloc_interaction.php');

}?>
</div> <?php 
?>

	
	<?php
	}
	
		}
		else die("erreur sur la recuperation des artistes :" .mysql_error());
			
}
else {
	header("location: erreur404.php");
}

	?>


<?php if(!isset($_SESSION['type'])) { ?>

	<?php include_once("connexion_utilisateur.php"); ?>


<?php }  ?>