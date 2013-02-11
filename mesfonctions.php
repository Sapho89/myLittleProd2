<?php

function select_same_author()
{

	$req = "SELECT * FROM oeuvre as O, artiste as A WHERE O.id_oeuvre!='".$_GET['id_oeuvre']."' AND O.id_artiste = A.id_artiste AND A.id_artiste = '".$_GET['id_artiste']."'";
	if($res = mysql_query($req))
	{
	 echo "<div id='more_same_auteur' >
			<h1 class='soustitre'> Autres du m&ecirc;me artiste </h1> <br/>
			<div style='clear:both;'></div> "; 
			
	 $i=0;
		WHILE($tab=mysql_fetch_assoc($res))
			{ 

		?>
		<a href="description_litterature.php?id_artiste=<?php echo $tab['id_artiste']; ?>&id_oeuvre=<?php echo $tab['id_oeuvre'];?>" target="_self">
		<img src="<?php echo $tab['url']; ?>" class="miniature" title="<?php echo $tab['titre']; ?>" alt="<?php echo $tab['titre']; ?>"/></a>
		<?php
		$i++;
			}
			echo "</div>";
	}
	}
	
	?>