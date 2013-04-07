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
       <h1 >INSCRIPTION MEMBRE</h1><br/>

			

<form name="formUser" id="inscriptionUser" method="POST" action="#" enctype="multipart/form-data" >


        
    <div><label for="nom">Nom :</label><input type="text" name="nom" id="nom" onMouseOut="check('nom')"/>&nbsp;<span id="verifNom"></span></div><br/>
	
    <div><label for="prenom">Pr&eacute;nom :</label><input type="text" name="prenom" id="prenom" onMouseOut="check('prenom')"/>&nbsp;<span id="verifPrenom"></span></div><br/>
	
    <div><label for="pseudo">Pseudo :</label><input type="text" name="pseudo" id="pseudo" onMouseOut="check('pseudo')"/>&nbsp;<span id="verifPseudo"></span></div><br/>

    <div><label for="date_naissance">Date de naissance :</label> <input type="text" name="date_naissance" id="date_naissance"  onMouseOut="check('date_naissance')" >&nbsp;<span id="verifDate_naissance"></span></div><br/>
        
    <div><label for="mail">Adresse mail :</label> <input type="text" name="mail" id="mail" onMouseOut="check('mail')"/>&nbsp;<span id="verifMail"></span></div><br/>
	
    <div><label for="mdp1">Mot de passe :</label><input type="password" name="mdp1" id="mdp1" onMouseOut="check('mdp1')"/>&nbsp;<span id="verifMdp1"></span></div><br/>

    <div><label for="avatar">Avatar :</label><input type="file" name="avatar" id="avatar" onMouseOut="check('avatar')"/>&nbsp;<span id=""></span></div><br/>
 
    
    <div align="center">
	<input type="reset" name="Annuler" value="Annuler" />
        <input type="submit" name="Envoyer" value="Envoyer" onSubmit="return checkFormUser()"/> 
    </div>  
    
</form>


<?php
$url = '';

if(isset($_POST['Envoyer'])){


if( isset($_POST['nom']) && 
	isset($_POST['prenom']) && 
	isset($_POST['pseudo']) && 
        isset($_POST['date_naissance']) &&
	isset($_POST['mail']) && 
	isset($_POST['mdp1']) &&
        isset($_FILES['avatar'])
	
	)
    {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $date_naissance = $_POST['date_naissance'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp1'];
    
    $url = upload_image($_FILES['avatar']);

    $addUser = "INSERT INTO membre
                    (id_membre, nom, prenom, pseudo, date_naissance, mail, mdp, avatar, date_inscription) 
                    VALUES ('', '$nom', '$prenom', '$pseudo', '$date_naissance', '$mail', '$mdp' , '$url', now())";

    if($result = mysql_query($addUser)){

       header("location:index.php");

    }else die("erreur dans l'inscription du membre ".mysql_error());

    }
}

?>

</div></div>