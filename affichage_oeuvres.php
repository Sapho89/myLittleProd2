<?php

$tableau = array();


$req = "SELECT o.*,
            a.*,
            g1.id_genre,
            g1.genre as genre1, 
            g1.type,g2.id_genre, 
            g2.genre as genre2, 
            g2.type FROM oeuvre as O,
            genre as g1,
            genre as g2,
            artiste as A 
            WHERE g1.type='".$_SESSION['page']."'
            AND O.id_genre1 = g1.id_genre 
            AND O.id_genre2 = g2.id_genre 
            AND O.id_artiste = A.id_artiste";
   
  //--- Résultat ---//
  $res = mysql_query($req);
  //met les données dans un tableau
  while($data = mysql_fetch_assoc($res))
  {
  $tableau[]=$data;
  }
  //détermine le nombre de colonnes
  $nbcol=2;

  ?>

<table class="tabOeuvres">
    
<?php
  $nb=count($tableau);
  for($i=0;$i<$nb;$i++){
   
  //les valeurs à afficher
  $titre = $tableau[$i]['titre'];
  $prenom = $tableau[$i]['prenom'];
  $nom = $tableau[$i]['nom'];
  $url = $tableau[$i]['url'];
  $type = $tableau[$i]['type'];
  $id_artiste = $tableau[$i]['id_artiste'];
  $id_oeuvre = $tableau[$i]['id_oeuvre'];
  $genre1 = $tableau[$i]['genre1'];
  $genre2 = $tableau[$i]['genre2'];
  

  if($i%$nbcol==0)
      ?>
<td>
<a href="index.php?page=<?php echo $type; ?>&id_artiste=<?php echo $id_artiste; ?>&id_oeuvre=<?php echo $id_oeuvre;?>" target="_self">
<img src="<?php echo $url; ?>" class="miniature" title="<?php echo $titre; ?>" alt="<?php echo $titre; ?>"/></a>
</td>
  
                            <td class="margeDroite">
                                <h3><?php echo $titre; ?></h3>
                            Publié par <?php echo htmlentities($prenom)." ".htmlentities($nom); ?>
                            <br/>
                            Genre : <?php if($genre1 == $genre2) { echo htmlentities($genre1); } else { echo htmlentities($genre1).",&nbsp;".htmlentities($genre2); } ?>
                            </td>
  <?php
  if($i%$nbcol==($nbcol-1))
  echo '</tr>';

  }



?>

</table>