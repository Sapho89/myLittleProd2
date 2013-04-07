
						
							
							<div class="bloc_horizontal">
                                                            <h1 >TOP NOTE</h1><br/> <?php 
							$req = "SELECT COUNT( * ) AS nb, o.*,
							AVG( n.note_valeur ) AS note_val ,
							g.*
							FROM  `note` AS n, 
							oeuvre AS o,
							genre AS g							
							WHERE n.id_oeuvre = o.id_oeuvre 
							AND o.id_genre1 = g.id_genre
							GROUP BY n.id_oeuvre 
							ORDER BY AVG( n.note_valeur )
							DESC LIMIT 0,5"; 
							
							$res = mysql_query($req) or die($req);
							$i = 1;
							
							while($ligne = mysql_fetch_assoc($res)){
							
							$genre = $ligne['type'];
							$url = "index.php?page=".$genre."&id_artiste=".$ligne['id_artiste']."&id_oeuvre=".$ligne['id_oeuvre'];
							echo "<div class='note_top'><a href='".$url."'><span style='color:#FFFFFF;font-family:Helvetica;'>".$i."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".strtoupper($ligne['titre'])." : ".number_format($ligne['note_val'],1)."</a><br /></div>";
							$i++;
							} ?>
							</div>
                                                        
                                                        
                                                        
                                                        
							
							<div class="bloc_horizontal"> 
                                                            <h1>DERNIERS COMMENTAIRES</h1>
							<div id='bloc_interaction' >
							<div id='Comm'><?php 
							$req = "SELECT * FROM commentaire ORDER BY date_updated DESC LIMIT 7";
							$resInfos2 = mysql_query($req) OR die("Erreur selection comm ".  mysql_error());
							
                                                        
                                                        $i = 0;
                                                        $titre = "";
							WHILE($tabInfos2 = mysql_fetch_assoc($resInfos2))
							{

                                                        $rqOeuvre = "SELECT O.*, G.* FROM oeuvre O
                                                                   INNER JOIN genre G ON id_genre = id_genre1
                                                                   WHERE O.id_oeuvre = ".$tabInfos2['id_oeuvre'];

                                                        $rsOeuvre = mysql_query($rqOeuvre) OR die("Erreur selection info oeuvre ".  mysql_error());
                                                        $tabOeuvre = mysql_fetch_assoc($rsOeuvre);


                                                        $genre = $tabOeuvre['type'];
                                                        $heure = conversionToHourFacebook(date_create($tabInfos2['date_updated']));
                                                        $type = getTypeId($tabInfos2['id_user']);
                                                        $src = getSrcAvatar($tabInfos2['id_user'],$type);
                                                        $titre = $tabOeuvre['titre']; 
                                                        $url = "index.php?page=".$genre."&id_artiste=".$tabOeuvre['id_artiste']."&id_oeuvre=".$tabOeuvre['id_oeuvre'];
                                                        echo "<div class='pane post' >
                                                        &nbsp;<img src='$src' alt='avatar' id='img_mini' width='50px' height='50px'>
                                                        <div id='post_text'>
                                                        <span>".getPseudo($tabInfos2['id_user'],$type)." :</span>
                                                        <div>".$tabInfos2['txt_com']."</div>
                                                        <span>$heure</span>
                                                        &nbsp;<span class='lien_wall'><a href='".$url."' title='cliquez pour suivre le lien'>".html_entity_decode($titre)."</a></span>
                                                         </div>";
                                                        echo "</div>";
                                                        $i++;
							} ?>
							</div></div>
							<!-- <img src="icones/Twitter.bmp" width="480px" height="614px"/> -->
							<!--   Qui as comment� ? qui as not� quoi ? Qui vient de s'inscrire ? Qui vient de se connecter ? -->
							</div> 
							
