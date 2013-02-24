<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
    <head>
<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>
<script type="text/javascript" src="js/jquery.color-2.1.0.js"></script>
<script type='text/javascript' src='mesFonctions.js'></script>
<script type="text/javascript" src="js/formUser.js"></script>
<script type="text/javascript" src="js/formArt.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/menu.js"></script> 
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

<body>
<?php
include_once("connexion.php");
include("mesfonctions.php");
include("fonction.php");

require_once("menu.php");

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
	
	<div class="contenu_droite">
						
							<div class="petit_bloc">
                                                            <h2>concours</h2>
								&Ecirc;tes-vous dessinateur, chanteur, peintre ou encore &eacute;crivain ? 
								MyLittleProd organise un concours &agrave; la fois original et unique.
								Nous recherchons des personnes talentueuses. Pour participer, il vous suffit de cr&eacute;er un compte en tant qu'artiste. 
							</div>
						
							<div class="petit_bloc">
								<h2>profils actifs</h2>
								<?php include_once("top_artiste.php"); ?>
							</div>	
								
							
							<div class="petit_bloc">
                                                            <h2>derniers inscrits</h2>
							</div>
						
	</div>
					
					
					
    
						<div class="contenu_central"> 
						<?php include_once 'contenu_accueil.php';?>
						</div>
<?php if(!isset($_SESSION['type'])) {?>
    <div class='connexionArt'>
	<?php include_once("connexionArt.php"); ?>			
    </div>
<?php } ?>    
    
<?php } ?>	
</div>			
</body>

</html>