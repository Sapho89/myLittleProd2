
<div id="menu">
    
    <ul class="menu">
        
        <li><a href="index.php"><span><img alt="accueil" title="accueil" style="margin-top:-8px;" src="images/home.png" /></span></a> </li>
		<li><a href="index.php?page=video"><span>Vid&eacute;o</span></a> </li>
		<li><a href="index.php?page=musique"><span>Musique</span></a> </li>
		<li><a href="index.php?page=image"><span>Image</span></a> </li>
		<li><a href="index.php?page=litterature"><span>Litt&eacute;rature</span></a> </li>
                <li><a href="#"><span>Contact</span></a></li>
		<!--<li>
			<a href="#" class="parent"><span>Moteur de recherche</span></a>
                        <fieldset>
                            <form action="index.php?page=resultats" method="POST" >
                        <div><ul>
                           <?php // include_once("moteur_recherche.php"); ?>
                        </ul></div>  
                        </form>
                        </fieldset>
			
		</li>-->
     
 <?php if(isset($_SESSION['id_artiste']) || isset($_SESSION['id_membre']) ){ ?>
                <li><a href="index.php?page=profil_structure"><span>Mon profil</span></a></li>
                <li class="last"><a href="deconnexion.php"><span>d&eacute;connexion</span></a></li>
  <?php } ?>
                
        
    </ul>
</div>

<div id="copyright"><a href="http://apycom.com/"></a></div>




