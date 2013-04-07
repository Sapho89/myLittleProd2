
<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
    <head>
<title>My Little Prod</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="conf/style.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if lt IE 9]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> <!-- Pour que IE comprenne balises HTML-->

<!--[if lte IE 7]>
<link rel="stylesheet" href="style_ie.css" />
<![endif]-->	
		
<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>
<!--<script type="text/javascript" src="js/jquery.color-2.1.0.js"></script>-->
<!--<script type='text/javascript' src='js/mesFonctions.js'></script>-->
<script type="text/javascript" src="js/formUser.js"></script>
<script type="text/javascript" src="js/formArt.js"></script>
<script type="text/javascript" src="js/projekktor.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/menu.js"></script> 



   <script type="text/javascript">
         $(document).ready(function() {
               projekktor('projekktor');
         })
    </script>

  

    </head>

<body>
<?php
include_once("conf/connexion.php");
include("conf/fonction.php");
require_once("menu.php");

date_default_timezone_set('Europe/Paris'); 

?>
		
<div class="main-content">
    
    <?php include_once('moteur_recherche.php');?>

<?php

if (isset($_GET['page']) && $_GET['page'] != 'index') {

  if( (isset($_GET['id_artiste'])) && (!empty($_GET['page'])) && (isset($_GET['id_oeuvre'])) && (!empty($_GET['id_oeuvre'])) ) {	
			include_once("description.php");
			}else  {
			include_once("contenu_principal.php");
		    }
?>		
								

		
<?php }else { ?>		
	
	<div class="contenu_gauche">
						
							<div class="petit_bloc">
                                                            <h2>concours</h2>
                                                                Bienvenue dans le site concours My Little Prod organisé par MUJI.
                                                                Votre magasin MUJI organise un concours à la fois original, unique et gratuit !
                                                                Vous aimez dessiner, chanter ou encore écrire, alors n'attendez plus, ce concours est fait pour vous !
								Publiez ici vos oeuvres d'art et tentez dès à présent de remporter le grand prix.
								Pour participer, il vous suffit de cr&eacute;er un compte en tant qu'artiste. 
							</div>
						
							<div class="petit_bloc">
								<h2>profils actifs</h2>
								<?php include_once("top_artiste.php"); ?>
							</div>	
								
							<!--
							<div class="petit_bloc">
                                                            <h2>derniers inscrits</h2
                                                            <?php //include_once('derniersInscrits.php');?>
							</div>-->

						
	</div>
					
					
					
    
						<div class="contenu_central"> 
						<?php include_once 'contenu_accueil.php';?>
						</div>
<?php if(!isset($_SESSION['type'])) {?>
    
	<?php include_once("connexion_utilisateur.php"); ?>			
    
<?php } ?>    
    
    
    
    <div class="contenu_droite">
        <br/>
        <h2>Dernier contenu ajouté</h2>
        <div><?php include_once('contenu_ajoute.php'); ?></div>
    </div>
    
<?php } ?>	
</div>			
</body>

</html>

