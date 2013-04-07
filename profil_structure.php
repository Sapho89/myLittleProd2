<?php


// identification du profil



	if($_SESSION['type'] == 'a') {
            $rqInfos =  "SELECT * FROM artiste A 
                        LEFT JOIN commentaire C ON A.id_artiste = C.id_user
                        WHERE A.id_artiste = '".$_SESSION['id_artiste']."'"; 
        }
        else {
            $rqInfos =  "SELECT * FROM membre M
                        LEFT JOIN commentaire C ON M.id_membre = C.id_user
                        WHERE M.id_membre = ".$_SESSION['id_membre']; 
        }    
        
	$rsInfos = mysql_query($rqInfos) or die("Impossible de recuperer les infos du profil ".mysql_error());
        
       
	
        $tabInfos = mysql_fetch_assoc($rsInfos);


?>

<!-- Affichage avatar + icones suppression/modification de compte -->


<div class="contenu_gauche">
            <div class="petit_bloc">
                <h2>Mon profil</h2>
                <img src='<?php echo $tabInfos['avatar']; ?>' height='150px' width='150px' />
                <br/><br/>
                <?php if($_SESSION['type'] == 'a') {?>
                <a href="index.php?page=modif_compte_artiste"><img src='images/cle_a_molette3.jpg' width='25px' height='25px' title="Modifier mon compte"/></a>
                <?php }else { ?>
                <a href="index.php?page=modif_compte_membre"><img src='images/cle_a_molette3.jpg' width='25px' height='25px' title="Modifier mon compte"/></a>
                <?php } ?>
                <a href=""><img src='images/poubelle.jpg' width='25px' height='25px' title="Supprimer mon compte" /></a>
            </div>           
 </div>


<!-- affichage infos utilisateur-->

		<div class="contenu_central">
                    <div class="bloc_horizontal">
                        <h1>Mes informations personnelles</h1>
                        <br/>
                    <span>Nom :<?php echo $tabInfos['nom']; ?> </span><br/>
                    <span>Prénom :<?php echo $tabInfos['prenom']; ?></span><br/>
                    <span>Pseudo :<?php echo $tabInfos['pseudo']; ?></span><br/>
                    <span>Date de naissance :<?php echo $tabInfos['date_naissance']; ?></span><br/>
                    <span>Adresse e-mail :<?php echo $tabInfos['mail']; ?></span><br/>
                    
                    </div>
                    
                    
                 <!-- Affichage des commentaires publies par l utilisateur -->
                    <div class="bloc_horizontal">
                        <h1>Mes commentaires</h1>
                        
                    <div id='bloc_interaction' >
                     <div id='Comm'>
                         
                         <?php 
                     
                     // Recuperation des commentaires de la personne connectee
                         afficheComUtil($rqInfos, $tabInfos['id_commentaire']);   
                         
                         
                       ?>
                          </div></div>
                </div>
                 

                </div>

 <!-- Ajout d'oeuvres -->


                    <?php if($_SESSION['type'] == 'a') {
                        
                       $talent = conversion_genre($tabInfos['talent']);
                       
                       
                       if($talent == 'musique'){
                           ?>
                           
                                               
                      <div class="upload">
                                <h1 style="vertical-align:top;"> <img src="images/icone_mp3.png" width="32px" height="32px"/>&nbsp;Ajouter une musique</h1>
                                <br/>
                         <form  method='POST' action='#' enctype="multipart/form-data" name="upload_oeuvre"> 
                                 
                              <input type="file" name="musique" id="musique" />
                              
                              <br/><br/>
                              <div align="center" ><input type="submit" name="valider" value="valider" /></div>
                        
                         </form>			
                     </div>
                           
                           
                           <?php
                       }else if($talent == 'video'){
                           ?>
                           
                                               
                      <div class="upload">
                                <h1 style="vertical-align:top;"> <img src="images/icone_video.png" width="32px" height="32px"/>&nbsp;Ajouter une vidéo</h1>
                                <br/>
                         <form  method='POST' action='#' enctype="multipart/form-data" name="upload_oeuvre"> 
                                 
                                                     
                              <input type="file" name="video" id="video" />
                              
                              <br/><br/>
                              <div align="center" ><input type="submit" name="valider" value="valider" /></div>
                         </form>			
                     </div>
                           
                           <?php
                       }else if($talent == 'litterature'){
                      ?>     
                      <div class="upload">
                                <h1 style="vertical-align:top;"> <img src="images/icone_video.png" width="32px" height="32px"/>&nbsp;Ajouter un livre</h1>
                                <br/>
                         <form  method='POST' action='#' enctype="multipart/form-data" name="upload_oeuvre"> 
                                 
                                                     
                              <input type="file" name="litterature" id="litterature" />
                              
                              <br/><br/>
                              <div align="center" ><input type="submit" name="valider" value="valider" /></div>            
                         </form>			
                     </div>
                           
                           
                         <?php  
                       }else if($talent == 'image'){
                           ?>
 
                       <div class="upload">
                                <h1 style="vertical-align:top;"> <img src="images/icone_image.png" width="32px" height="32px"/>&nbsp;Ajouter une image</h1>
                                <br/>
                         <form  method='POST' action='#' enctype="multipart/form-data" name="upload_oeuvre"> 
                                 
                                                     
                              <input type="file" name="image" id="image" />
                                                           
                              <br/><br/>
                              <div align="center" ><input type="submit" name="valider" value="valider" /></div>
                  
                              
                         </form>			
                     </div>
 
                            <?php
                           
                       }else echo "";
                        ?>
                                       


 
                     <?php }?>

 
 <?php
 
 // Upload d'une oeuvre
 
 
 if(isset($_POST['valider'])){
     
     
   if(isset($_FILES['musique'])) {
       $url = upload_musique($_FILES['musique']);
      
   }
   else if(isset($_FILES['video'])) {
       $url = upload_musique($_FILES['video']);
   }
   else if(isset($_FILES['image'])) {
       $url = upload_musique($_FILES['image']);
   }  
   else if(isset($_FILES['livre'])) {
       $url = upload_musique($_FILES['livre']);
   } 
   
   
   
   
   // echo $url;
   
   
     
 }
 
 
 ?>