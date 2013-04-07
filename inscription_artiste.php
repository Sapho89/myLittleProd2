
  <script>
  $(function() {
        $.noConflict();
    $( "#date_naissance" ).datepicker({
      changeMonth: true,
      changeYear: true,
      minDate: new Date(1950, 1 - 1, 1),
      maxDate: new Date(1996, 1 - 1, 1),
      dateFormat: "yy-mm-dd"
    
    });
  });
  </script>
  
  <div class="inscription">
<div class="bloc_horizontal">
       <h1 >INSCRIPTION ARTISTE</h1><br/>

 <form name="formArt" id="inscriptionArt" method="POST" action="#" enctype="multipart/form-data" >
     
     
    <div><label for="nom">Nom :</label><input type="text" name="nom" id="nom" onMouseOut="check('nom')"/>&nbsp;<span id="verifNom"></span></div><br/>
	
    <div><label for="prenom">Pr&eacute;nom :</label><input type="text" name="prenom" id="prenom" onMouseOut="check('prenom')"/>&nbsp;<span id="verifPrenom"></span></div><br/>
	
    <div><label for="pseudo">Pseudo :</label><input type="text" name="pseudo" id="pseudo" onMouseOut="check('pseudo')"/>&nbsp;<span id="verifPseudo"></span></div><br/>
		
    <div><label for="date_naissance">Date de naissance :</label> <input type="text" name="date_naissance" id="date_naissance"  onMouseOut="check('date_naissance')" >&nbsp;<span id="verifDate_naissance"></span></div><br/>
	
<?php
        // Affichage des talents d'artistes dans une liste déroulante

$rqTalent = "SELECT distinct type FROM genre";        
        
$rsTalent = mysql_query($rqTalent) OR die("Impossible d'afficher les talents ".mysql_error());
        
?>
        
    <div><label for="talent">Talent :</label> 
	<select name="talent" size="1" id="talent" onMouseOut="check('talent')">
            <option value="">Choisissez</option>
		<?php
            
                    $i = 0;

                    WHILE($tabTalent = mysql_fetch_assoc($rsTalent)){

                            echo "<option value=".$tabTalent['type'].">".$tabTalent['type']."</option>";
                            $i++;
                    }
            
                ?>
	</select>
        &nbsp;<span id="verifTalent"></span>
    </div>
<br/>
	
	<div><label for="description">Pr&eacute;sentez-vous :</label>
      <textarea name="description" rows="4" cols="40" id="description" onMouseOut="check('description')"/></textarea>
	&nbsp;<span id="verifDescription"></span>
	</div>
	
	<div><label for="mail">Adresse mail :</label> <input type="text" name="mail" id="mail" onMouseOut="check('mail')"/>&nbsp;<span id="verifMail"></span></div><br/>
	
    <div><label for="mdp1">Mot de passe :</label><input type="password" name="mdp1" id="mdp1" onMouseOut="check('mdp1')"/>&nbsp;<span id="verifMdp1"></span></div><br/>

    <div><label for="avatar">Avatar :</label><input type="file" name="avatar" id="avatar" onMouseOut="check('avatar')"/>&nbsp;<span id="verifAvatar"></span></div><br/>
    
    <div align="center">
	<input type="reset" name="Annuler" value="Annuler" />
        <input type="submit" name="Envoyer" value="Envoyer" onSubmit="return checkFormArt()"/> 
    </div>    
        
</form>

</div>
</div>


<?php

$url = '';

	if(isset($_POST['Envoyer'])){

if( isset($_POST['nom']) && !empty($_POST['nom']) &&
	isset($_POST['prenom']) && !empty($_POST['prenom']) &&
	isset($_POST['pseudo']) && !empty($_POST['pseudo']) &&
        isset($_POST['date_naissance']) && !empty($_POST['date_naissance']) &&
	isset($_POST['talent']) && !empty($_POST['talent']) && 
	isset($_POST['description']) && !empty($_POST['description']) && 
	isset($_POST['mail']) && !empty($_POST['mail']) && 
	isset($_POST['mdp1']) && !empty($_POST['mdp1']) &&
        isset($_FILES['avatar'])
  )
        {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $talent = $_POST['talent'];
        $date_naissance = $_POST['date_naissance']; 
        $description = mysql_real_escape_string ($_POST['description']);
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp1'];
        $avatar = $_FILES['avatar'];
        
        $url = upload_image($avatar);

        $addArt = "INSERT INTO artiste 
                        (nom, prenom, pseudo, talent, mail, date_naissance, mdp, avatar, date_updated, description) 
                        VALUES ('$nom', '$prenom', '$pseudo', '$talent', '$mail', '$date_naissance', '$mdp', '$url', now(), '$description')";
        

            if($result = mysql_query($addArt))
            {

                header("location:index.php");

                
            }else die("erreur dans l'inscription de l'artiste ".mysql_error());
        }

        }
?>