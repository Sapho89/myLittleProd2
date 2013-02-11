<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
    <head>
<script type='text/javascript' src='jquery-1.7.2.min.js'></script>
<script type="text/javascript" src="jquery.color-2.1.0.js"></script>
<script type='text/javascript' src='mesFonctions.js'></script>
<script type="text/javascript" src="formUser.js"></script>
<script type="text/javascript" src="formArt.js"></script> 
<title>My Little Prod</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if lt IE 9]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> <!-- Pour que IE comprenne balises HTML-->

<!--[if lte IE 7]>
<link rel="stylesheet" href="style_ie.css" />
<![endif]-->	
		
    </head>

<body onLoad="if(document.getElementById('pseudo'))document.getElementById('pseudo').focus();">
<?php
include_once("connexion.php");
include("mesfonctions.php");
include("fonction.php");

require_once("menu.php");

?>
		
<div class="main-content">

<?php

if (isset($_GET['page']) && $_GET['page'] != 'index') {

  if( isset($_GET['id_artiste']) && !empty($_GET['page']) && isset($_GET['id_oeuvre']) && !empty($_GET['id_oeuvre'])) {	
			include_once("description.php");
			}else  {
			include_once("contenu_principal.php");
		    }
?>		
								

		
<?php }else { ?>		
	
	<div class="contenu_droite">
						
							<div class="affiche">
								&Ecirc;tes-vous dessinateur, chanteur, peintre ou encore &eacute;crivain ? 
								MyLittleProd organise un concours &agrave; la fois original et unique.
								Nous recherchons des personnes talentueuses. Pour participer, il vous suffit de cr&eacute;er un compte en tant qu'artiste. 
							</div>
						
							<div class="top-artiste">
								<h2>Profils les plus participatifs</h2>
								<?php include_once("top_artiste.php"); ?>
							</div>	
								
							<h1 class='titre_fiche'>5 DERNIERS INSCRITS</h1>
							<div class="presentation2">
							</div>
						
	</div>
					
					
					<div class='connexionArt'>
							<?php include_once("connexionArt.php"); ?>
					</div>
						<div class="contenu_central"> 
						<h1>SLIDE DERNIERS CONTENUS</h1>
						<div class="presentation2">
						</div> 
						
							<h1 class='titre_fiche'>TOP NOTE</h1>
							<div class="presentation2"> <?php 
							$req = "SELECT COUNT( * ) AS nb, o.*, AVG( n.note_valeur ) AS note_val FROM  `note` AS n, oeuvre AS o WHERE n.id_oeuvre = o.id_oeuvre GROUP BY n.id_oeuvre ORDER BY COUNT( * ) DESC , AVG( n.note_valeur ) DESC LIMIT 0,5"; 
							$res = mysql_query($req) or die($req);
							$i = 1;
							
							while($ligne = mysql_fetch_assoc($res)){
							$req_g = "SELECT * FROM GENRE WHERE id_genre=".$ligne['id_genre1'];
							$res_g = mysql_query($req_g);
							$ligne_g = mysql_fetch_assoc($res_g);
							$genre = $ligne_g['type'];
							$url = "index.php?page=".$genre."&id_artiste=".$ligne['id_artiste']."&id_oeuvre=".$ligne['id_oeuvre'];
							echo "<div class='note_top note_top$i'><a href='".$url."'>".$i." ".strtoupper($ligne['titre'])." ".number_format($ligne['note_val'],1).",Total de ".$ligne['nb']." votes</a><br /></div>";
							$i++;
							} ?>
							</div>
							<h1>WALL D'ACTUALITE [Commentaires]</h1>
							<div class="presentation2"> 
							<div id='bloc_interaction' >
							<div id='Comm'><?php 
							$req = "SELECT * FROM commentaire ORDER BY date_updated DESC";
							$res = mysql_query($req);
							$titre = "";
							while($ligne = mysql_fetch_assoc($res))
							{
							$req_o = "SELECT * FROM oeuvre WHERE id_oeuvre = ".$ligne['id_oeuvre']." ORDER by date_updated DESC";
							$res_o = mysql_query($req_o);
							$ligne_o = mysql_fetch_assoc($res_o);
							$req_g = "SELECT * FROM GENRE WHERE id_genre=".$ligne_o['id_genre1'];
							$res_g = mysql_query($req_g);
							$ligne_g = mysql_fetch_assoc($res_g);
							$genre = $ligne_g['type'];
							
							$heure = conversionToHourFacebook(new DateTime($ligne['date_updated']));
							$type = getTypeId($ligne['id_membre']);
							$src = getSrcAvatar($ligne['id_membre'],$type);
							$id_commentaire = $ligne['id_commentaire'];
							$titre = $ligne_o['titre']; 
							$url = "index.php?page=".$genre."&id_artiste=".$ligne_o['id_artiste']."&id_oeuvre=".$ligne_o['id_oeuvre'];
								echo "<div class='pane post' id='$id_commentaire'>
									<img src='$src'		alt='avatar' id='img_mini' width='50px' height='50px'>
									<div id='post_text'>
										<div>".$ligne['txt_com']."</div>
										<span><a href='#'>".getPseudo($ligne['id_membre'],$type)."</a></span>
										<span>$heure</span>
										<span class='lien_wall'><a href='".$url."' >".html_entity_decode($titre)."</a></span>
									</div>";
								echo "</div>";
							} ?>
							</div></div>
							<!-- <img src="icones/Twitter.bmp" width="480px" height="614px"/> -->
							<!--   Qui as commenté ? qui as noté quoi ? Qui vient de s'inscrire ? Qui vient de se connecter ? -->
							</div> 
							
							<h1>WALL D'ACTUALITE [Notes]</h1>
							<div class="presentation2"> 
							<div id='bloc_interaction' >
							<div id='Comm'><?php 
							$req = "SELECT * FROM note";
							$res = mysql_query($req);
							$titre = "";
							while($ligne = mysql_fetch_assoc($res))
							{
							$req_o = "SELECT * FROM oeuvre WHERE id_oeuvre = ".$ligne['id_oeuvre']." ORDER by date_updated DESC";
							$res_o = mysql_query($req_o);
							$ligne_o = mysql_fetch_assoc($res_o);
							$req_g = "SELECT * FROM GENRE WHERE id_genre=".$ligne_o['id_genre1'];
							$res_g = mysql_query($req_g);
							$ligne_g = mysql_fetch_assoc($res_g);
							$genre = $ligne_g['type'];
							
							//$heure = conversionToHourFacebook(new DateTime($ligne['date_updated']));
							$type = getTypeId($ligne['id_membre']);
							$src = getSrcAvatar($ligne['id_membre'],$type);
							$id_note = $ligne['id_note'];
							$titre = $ligne_o['titre']; 
							$url = "index.php?page=".$genre."&id_artiste=".$ligne_o['id_artiste']."&id_oeuvre=".$ligne_o['id_oeuvre'];
								echo "<div class='pane post' id='$id_note'>
									<img src='$src'		alt='avatar' id='img_mini' width='50px' height='50px'>
									<div id='post_text'>
										<div>Note de ".$ligne['note_valeur']."</div>
										<span><a href='#'>".getPseudo($ligne['id_membre'],$type)."</a></span>
										<span>$heure</span>
										<span class='lien_wall'><a href='".$url."' >".html_entity_decode($titre)."</a></span>
									</div>";
								echo "</div>";
							} ?>
							</div></div>
							<!-- <img src="icones/Twitter.bmp" width="480px" height="614px"/> -->
							<!--   Qui as commenté ? qui as noté quoi ? Qui vient de s'inscrire ? Qui vient de se connecter ? -->
							</div> 
							
							<h1>WALL D'ACTUALITE [Nouveau contenu ajouté]</h1>
							<div class="presentation2"> 
							<div id='bloc_interaction' >
							<div id='Comm'><?php 
							$req = "SELECT * FROM oeuvre ORDER BY date_updated DESC";
							$res = mysql_query($req);
							$titre = "";
							while($ligne = mysql_fetch_assoc($res))
							{
							$req_o = "SELECT * FROM oeuvre WHERE id_oeuvre = ".$ligne['id_oeuvre']." ORDER by date_updated DESC";
							$res_o = mysql_query($req_o);
							$ligne_o = mysql_fetch_assoc($res_o);
							$req_g = "SELECT * FROM GENRE WHERE id_genre=".$ligne_o['id_genre1'];
							$res_g = mysql_query($req_g);
							$ligne_g = mysql_fetch_assoc($res_g);
							$genre = $ligne_g['type'];
							
							$heure = conversionToHourFacebook(new DateTime($ligne['date_updated']));
							$type = getTypeId($ligne['id_artiste']);
							$src = getSrcAvatar($ligne['id_artiste'],$type);
							$id_oeuvre = $ligne['id_oeuvre'];
							$titre = $ligne_o['titre']; 
							$url = "index.php?page=".$genre."&id_artiste=".$ligne_o['id_artiste']."&id_oeuvre=".$ligne_o['id_oeuvre'];
								echo "<div class='pane post' id='$id_oeuvre'>
									<img src='$src'		alt='avatar' id='img_mini' width='50px' height='50px'>
									<div id='post_text'>
										<div><i>".$ligne_o['titre']."</i> a ete rajoute</div>
										<span><a href='#'>".getPseudo($ligne['id_artiste'],'a')."</a></span>
										<span>$heure</span>
										<span class='lien_wall'><a href='".$url."' >".html_entity_decode($titre)."</a></span>
									</div>";
								echo "</div>";
							} ?>
							</div></div>
							<!-- <img src="icones/Twitter.bmp" width="480px" height="614px"/> -->
							<!--   Qui as commenté ? qui as noté quoi ? Qui vient de s'inscrire ? Qui vient de se connecter ? -->
							</div> 
							<h1>WALL D'ACTUALITE [Nouveaux Inscrits]</h1>
							<div class="presentation2"> 
							<div id='bloc_interaction' >
							<div id='Comm'><?php 
							$req = "SELECT * FROM artiste ORDER BY date_updated DESC";
							$res = mysql_query($req);
							$titre = "";
							while($ligne = mysql_fetch_assoc($res))
							{/*
							$req_o = "SELECT * FROM oeuvre WHERE id_oeuvre = ".$ligne['id_oeuvre']." ORDER by date_updated DESC";
							$res_o = mysql_query($req_o);
							$ligne_o = mysql_fetch_assoc($res_o);
							$req_g = "SELECT * FROM GENRE WHERE id_genre=".$ligne_o['id_genre1'];
							$res_g = mysql_query($req_g);
							$ligne_g = mysql_fetch_assoc($res_g);
							$genre = $ligne_g['type']; */
							
							$heure = conversionToHourFacebook(new DateTime($ligne['date_updated']));
							$type = getTypeId($ligne['id_artiste']);
							$src = getSrcAvatar($ligne['id_artiste'],$type);
							//$id_commentaire = $ligne['id_commentaire'];
							//$titre = $ligne_o['titre']; 
							$url = "index.php?page=".$genre."&id_artiste=".$ligne_o['id_artiste']."&id_oeuvre=".$ligne_o['id_oeuvre'];
								echo "<div class='pane post' id='".$ligne['id_artiste']."'>
									<img src='$src'		alt='avatar' id='img_mini' width='50px' height='50px'>
									<div id='post_text'>
										<div></div>
										<span><a href='#'>".getPseudo($ligne['id_artiste'],$type)."</a></span>
										<span>$heure</span>
										<span class='lien_wall'><a href='".$url."' >".html_entity_decode($titre)."</a></span>
									</div>";
								echo "</div>";
							} ?>
							</div></div>
							<!-- <img src="icones/Twitter.bmp" width="480px" height="614px"/> -->
							<!--   Qui as commenté ? qui as noté quoi ? Qui vient de s'inscrire ? Qui vient de se connecter ? -->
							</div> 
							
						</div>

<?php } ?>	
</div>			
</body>

</html>