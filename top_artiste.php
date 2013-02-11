 

<?php 
						
						
						$req= "SELECT COUNT( * ) AS  'nombres de commentaires', c.id_artiste, a.pseudo, a.avatar
								FROM commentaire AS c, artiste AS a
								WHERE c.id_artiste = a.id_artiste
								GROUP BY c.id_artiste
								ORDER BY COUNT( * ) DESC 
								LIMIT 0 , 30";

						
								if($res=mysql_query($req))
								{
								$i=1;
								
						
										
									WHILE($tab=mysql_fetch_assoc($res))
									{

										echo "<img src='".$tab['avatar']."' alt='".$tab['pseudo']."' title='".$tab['pseudo']."' width='50px' height='50px'/>";

									$i++;
									}	


								
								}	
						
						
?>