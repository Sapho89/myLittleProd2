<script type="text/javascript" src="formArt.js"></script>



<?php
error_reporting(E_ALL ^ E_NOTICE); //Enlève les notices

?>


<h1>Nouvel Artiste</h1>

<br/>

			
<div style="margin-left:200px;">



 <form name="formArt" id="inscriptionArt" method="POST" action="inscriptionArt.php" onSubmit="checkForm()">
         
    <div><label for="nom">Nom :</label><input type="text" name="nom" id="nom" onMouseOut="check('nom')"/>&nbsp;<span id="verifNom"></span></div><br/>
	
    <div><label for="prenom">Pr&eacute;nom :</label><input type="text" name="prenom" id="prenom" onMouseOut="check('prenom')"/>&nbsp;<span id="verifPrenom"></span></div><br/>
	
	<div><label for="pseudo">Pseudo :</label><input type="text" name="pseudo" id="pseudo" onMouseOut="check('pseudo')"/>&nbsp;<span id="verifPseudo"></span></div><br/>
		
    <!--<div><label for="naissance">Date de naissance :</label> <input type="date" name="naissance"></div><br/>-->
		
    <div><label for="talent">Talent :</label> 
	<select name="talent" size="1">
		<option value="Chanteur">Chanteur</option>
		<option value="Musicien">Musicien</option>
		<option value="videaste">Vid&eacute;aste</option>
		<option value="Dessinateur">Dessinateur</option>
		<option value="Photographe">Photographe</option>
		<option value="Peintre">Peintre</option>
		<option value="écrivain">&Eacute;crivain</option>
		</select>
	</div>
<br/>
	
	<div><label for="description">Pr&eacute;sentez-vous :</label>
      <textarea name="description" rows="4" cols="40" id="description" onMouseOut="check('description')"/></textarea>
	&nbsp;<span id="verifDescription"></span>
	</div>
	
	<div><label for="mail">Adresse mail :</label> <input type="text" name="mail" id="mail" onMouseOut="check('mail')"/>&nbsp;<span id="verifMail"></span></div><br/>
	
    <div><label for="mdp1">Mot de passe :</label><input type="password" name="mdp1" id="mdp1" onMouseOut="check('mdp1')"/>&nbsp;<span id="verifMdp1"></span></div><br/>

	<input type="reset" name="Annuler" value="Annuler" />
    <input type="submit" name="Envoyer" value="Envoyer" onSubmit="return checkForm()"/> 
</form>
</div>





<?php

require_once("connexion.php");

if( isset($_POST['nom']) && !empty($_POST['nom']) &&
	isset($_POST['prenom']) && !empty($_POST['prenom']) &&
	isset($_POST['pseudo']) && !empty($_POST['pseudo']) &&
	isset($_POST['talent']) && !empty($_POST['talent']) && 
	isset($_POST['description']) && !empty($_POST['description']) && 
	isset($_POST['mail']) && !empty($_POST['mail']) && 
	isset($_POST['mdp1']) && !empty($_POST['mdp1']) &&
	isset($_POST['Envoyer']))
{
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$updated = $_POST['date_updated'];
$talent = $_POST['talent'];
$description = $_POST['description'];
$mail = $_POST['mail'];
$mdp = $_POST['mdp1'];


$addArt = "INSERT INTO artiste 
		(nom, prenom, pseudo, talent, mail, mdp, avatar, date_updated, description) 
		VALUES ('$nom', '$prenom', '$pseudo', '$talent', '$mail', '$mdp', '', now(), '$description')";
//echo $addArt;
if($result = mysql_query($addArt))
{
	echo "Vous etes bien inscrit !";
	
}else {die("erreur dans l'inscription de l'artiste ".mysql_error());}
}
?>