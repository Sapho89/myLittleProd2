<?php

				 //Formulaire rempli avec donnees de la base
				$rqInfos = "SELECT * FROM artiste A 
                                        LEFT JOIN commentaire C ON A.id_artiste = C.id_user
                                        WHERE A.id_artiste = ".$_SESSION['id_artiste'];
				$res = mysql_query($rqInfos);
				$ligne = mysql_fetch_assoc($res); 
				?>
				
<div class="contenu_gauche">
            <div class="petit_bloc">
				<h2>mon avatar</h2> 
					<img src='<?php echo $ligne['avatar']; ?>' height='150px' width='150px' /><br /> <br /> 
            </div>   
      
 </div>



<div class="contenu_central">
    
			
    
<div class="bloc_horizontal">

<!--Affichage du formulaire Artiste -->
<h1>Modification de mon profil</h1>

<br/>
<form  method='POST' action='#' enctype="multipart/form-data" name="modif_infos"> 
	
<div><label for='nom'>Nom :</label>
    <input type='text' name='nom' id='nom' onKeyUp="check('nom')" value='<?php echo $ligne['nom'];?>' disabled/>&nbsp;
<span id='verifNom'></span></div><br/>
					
<div><label for='prenom'>Pr&eacute;nom :</label>
    <input type='text' name='prenom' id='prenom' onMouseOut="check('prenom')" value='<?php echo $ligne['prenom']; ?>' disabled/>&nbsp;
<span id='verifPrenom'></span></div><br/>					
					
<div><label for='pseudo'>Pseudo :</label>
    <input type='text' name='pseudo' id='pseudo' onMouseOut="check('pseudo')" value='<?php echo $ligne['pseudo']; ?>'/>&nbsp;
<span id='verifPseudo'></span></div><br/>

<div><label for='date_naissance'>Date de naissance :</label>
    <input type='text' name='date_naissance' id='date_naissance' onMouseOut="check('date_naissance')" value='<?php echo $ligne['date_naissance']; ?>' disabled/>&nbsp;
<span id='verifDate_naissance'></span></div><br/>

<div><label for='talent'>Talent :</label>
    <input type='text' name='talent' id='talent' onMouseOut="check('talent')" value='<?php echo $ligne['talent']; ?>' disabled/>&nbsp;
<span id='verifTalent'></span></div><br/>

<div><label for='description'>Courte description :</label><br /><br />
<textarea name='description' rows='5' cols='60'  id='description' onMouseOut="check('description')"><?php echo $ligne['description']; ?></textarea>
&nbsp;<span id='verifDescription'></span></div>

<div><label for='mail'>Adresse mail :</label> 
    <input type='text' name='mail' id='mail' onMouseOut="check('mail');" value='<?php echo $ligne['mail'];?>'/>&nbsp;
<span id='verifMail'></span></div><br/>

<div><label for='mdp'>Mot de passe :</label> 
    <input type='password' name='mdp' id='mdp' onMouseOut="check('mdp');" value='<?php echo $ligne['mdp'];?>'/>&nbsp;
<span id='verifMdp'></span></div><br/>
			

<div><label for="avatar">Avatar :</label><input type="file" name="avatar" id="avatar" />
    <br/><span  style='color:red;font-style: italic;'>* Votre image perso doit être de format .jpg, .png ou .gif</span></div><br/>
    





<div align="center">
<input type='reset' name='Annuler' value='Annuler' />
<input type='submit' name='Envoyer' value='Envoyer' /> 
</div>

</form>
    

  </div><br />


 

<!-- Affichage des commentaires publies par l utilisateur -->
                    <div class="bloc_horizontal">
                        <h1>Mes commentaires</h1>
                        
                    <div id='bloc_interaction' >
                     <div id='Comm'>
                         
                         <?php 
                         
                         $id_com = $ligne['id_commentaire'];
                         
                         
                                afficheComUtil($rqInfos , $id_com);   
                         ?>
                          </div></div>
                    </div>

</div>


<div class="contenu_droite">

    <h2>Mes oeuvres</h2> 
             <?php afficheOeuvreParIdArtiste($_SESSION['id_artiste']); ?>
				
</div>
<?php

if( isset($_POST['Envoyer']))
{					
	
    $url = '';
    
//if(isset($_POST['avatar_local'])) $avatar = $_POST['avatar_local'];
if(isset($_POST['mdp'])) $mdp = mysql_real_escape_string ($_POST['mdp']); 
if(isset($_POST['pseudo'])) $pseudo = mysql_real_escape_string ($_POST['pseudo']);
if(isset($_POST['description'])) $description = mysql_real_escape_string ($_POST['description']);
if(isset($_POST['mail'])) $mail = mysql_real_escape_string ($_POST['mail']);
if(isset($_FILES['avatar'])) $url = upload_image($_FILES['avatar']);
        
    // Requete d'update d'un artiste           
                                
$rqUpdateArt = "UPDATE `artiste` SET 
                pseudo = '".$pseudo."',
                description = '".$description."',
                mail = '".$mail."',
                avatar = '".$url."',
                mdp = '".$mdp."'
                WHERE id_artiste = '".$_SESSION['id_artiste']."'
                ";

//echo $rqUpdateArt;

if($rsUpdateArt = mysql_query($rqUpdateArt)) {

    header("location:index.php?page=profil_structure");
  
}else die("Erreur dans la modif de l'artiste ".mysql_error());




}  

?>


<script type="text/javascript">
$(document).ready(function(){
	      
	//Effacer un commentaire
	$(".delete").click(function(){
		var id = $(this).parents(".pane").attr("id");
		var val = confirm("Voulez-vous vraiment supprimer ce commentaire ?");
		if(val){
		  	$(this).parents(".pane").animate({ opacity: 'hide' }, "fast");
		 $.ajax({
			   type: "POST",
			   url: "fonction_ajax.php",
			   data: "type=suppression&id="+id,
			   success: function(msg){

			   }
			 });
		}
      });      	
});
</script>