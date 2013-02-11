<script type="text/javascript">
$(document).ready(function() {
	
$(".n1_liste").click(function(){
		 $(this).siblings().toggle();
});
	
});
</script>

<div class="menu" >
  <nav>
    <ul>
      <!--<li><a href="index.php"><img src="logo.jpg" id="logo"/></a></li>-->
      <li class="niveau1"><a href="index.php" id="accueil">Accueil</a></li>
      <li class="niveau1"><a href="index.php?page=video">Vid&eacute;o</a></li>
      <li class="niveau1"><a href="index.php?page=musique">Musique</a></li>
      <li class="niveau1"><a href="index.php?page=image">Image</a></li>
      <li class="niveau1"><a href="index.php?page=litterature">Litt&eacute;rature</a></li>
      <li>				
        <a href='#' class="n1_liste">Moteur de recherche</a>
        <?php include_once("moteur_recherche.php"); ?>
      </li>
 <?php if(isset($_SESSION['id_artiste']) || isset($_SESSION['id_membre']) ){ ?>
      <li class="niveau1"><a href="index.php?page=profil_structure">Mon profil</a></li>
      <li><a href="deconnexion.php"><img src="logout.png"/>&nbsp;Se d&eacute;connecter</a></li>
  <?php } ?>
    </ul>
  </nav>
</div>
