
<?php

$tableau = array();

			if($resultatRecherche = mysql_query($requeteRecherche))
			{
			
			$i = 0;
			$nbResultat = mysql_num_rows($resultatRecherche);
			
			if( $nbResultat != 0)
				{
					if($nbResultat > 1) { echo "<h1>".$nbResultat." r&eacute;sultats trouv&eacute;s</h1>"; } else { echo "<h1>".$nbResultat." r&eacute;sultat trouv&eacute;</h1>"; } 
				/*	
					WHILE($tabRecherche = mysql_fetch_assoc($resultatRecherche))
					{
				?>
				<table>
																   
					<tr>
																   
							<td>
							<a href="index.php?page=<?php echo $tabRecherche['type']; ?>&id_artiste=<?php echo $tabRecherche['id_artiste']; ?>&id_oeuvre=<?php echo $tabRecherche['id_oeuvre'];?>" target="_self">
																	  
							<img src="<?php echo $tabRecherche['url']; ?>" class="miniature" title="<?php echo $tabRecherche['titre']; ?>" alt="<?php echo $tabRecherche['titre']; ?>"/></a>
																	 
							</td>
																	   
						<td>
							<h3><?php echo htmlentities($tabRecherche['titre']); ?></h3>
							Realise par <?php echo htmlentities($tabRecherche['prenom'])."&nbsp;".htmlentities($tabRecherche['nom']); ?>
						<br/>
							Genre : <?php if($tabRecherche['genre1'] == $tabRecherche['genre2']) { echo $tabRecherche['genre1']; } else { echo $tabRecherche['genre1'].",&nbsp;".$tabRecherche['genre2']; } ?>
						</td>
																   
					</tr>
																   
				 </table>
				
				<?php
					$i++;
					}
				*/	
                                        
  //met les données dans un tableau
  while($tabRecherche  = mysql_fetch_assoc($resultatRecherche))
  {
  $tableau[]= $tabRecherche ;
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
                            Publié par <?php echo $prenom." ".$nom; ?>
                            <br/>
                            Genre : <?php if($genre1 == $genre2) { echo html_entity_decode($genre1); } else { echo html_entity_decode($genre1).",&nbsp;".html_entity_decode($genre2); } ?>
                            </td>
  <?php
  if($i%$nbcol==($nbcol-1))
  echo '</tr>';

  }



?>

</table>                                        
                                        
                                        
                                        
                                        
                                        
         <?php                               
                                        
                                        
                                        
                                        
                                        
                                        
				}else echo "<h1 style='margin-top:50px;'>Désolé, aucun résultat n'a été trouvé.</h1>";
	
 
			}else die("erreur resultat pour les titres :".mysql_error()); 