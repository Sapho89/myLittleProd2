
<?php
	echo "<div id='nav_artiste' > 
	<h1 class='soustitre'>&Agrave; propos de l'artiste</h1>
	<img src='".getSrcAvatar($_SESSION["id_membre"],$_SESSION['type'])."' alt='avatar' width='150px' height='150px'/>
	<p>".getDescription($_SESSION["id_membre"],$_SESSION['type'])."</p>
	<p id='reseaux'><img src='icones/facebook.png' alt='Facebook' /><img src='icones/twitter.png' alt='Twitter' /></p>
</div>";
?>
