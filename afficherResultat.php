
<?php
			if($resultatRecherche = mysql_query($requeteRecherche))
			{
			
			$i = 0;
			$nbResultat = mysql_num_rows($resultatRecherche);
			
			if( $nbResultat != 0)
				{
					if($nbResultat > 1) { echo "<h1>".$nbResultat." r&eacute;sultats trouv&eacute;s</h1>"; } else { echo "<h1>".$nbResultat." r&eacute;sultat trouv&eacute;</h1>"; } 
					
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
					
				}else echo "";
	
 
			}else die("erreur resultat pour les titres :".mysql_error()); 