<?php
		//ARTISTE
			//GESTION DU COMPTE 
			if( isset($_GET['gestion'])) {  
				
				//TRAITEMENT DES DONNEES MODIFIES				
				if( isset($_POST['Envoyer']))
					{
						
/*if(!empty($_POST['nom'])) $nom = mysql_real_escape_string ($_POST['nom']);
if(!empty($_POST['prenom'])) $prenom = mysql_real_escape_string ($_POST['prenom']); */
if(!empty($_POST['pseudo'])) $pseudo = mysql_real_escape_string ($_POST['pseudo']);
if(!empty($_POST['description'])) $description = mysql_real_escape_string ($_POST['description']);
if(!empty($_POST['mail'])) $mail = mysql_real_escape_string ($_POST['mail']);
					
		
					print_r($_FILES['avatar_local']);
		
					if(isset($_FILES['avatar_local']))
					$url = upload_image($_FILES['avatar_local'],150,150,'avatar','');
				
				 //Dimension/Format/Poids  modifiables
				$first=1;
				$addArt = "UPDATE `artiste` SET";
				
				if(isset($nom)){
					if($first) {$addArt .="`nom`= '".html_entity_decode($nom)."'";$first = 0;}
					else 	$addArt .=",`nom`= '".html_entity_decode($nom)."'"; }

				if(isset($prenom)){
					if($first) {$addArt .="`prenom`= '".html_entity_decode($prenom)."'";$first = 0;}
					else 	$addArt .=",`prenom`= '".html_entity_decode($prenom)."'"; }
				
				if(isset($pseudo)){
					if($first) {$addArt .="`pseudo`= '".$pseudo."'";$first = 0;}
					else 	$addArt .=",`pseudo`= '".$pseudo."'"; }
				
				if(isset($mail)){
					if($first) {$addArt .="`mail`= '".$mail."'";$first = 0;}
					else 	$addArt .=",`mail`= '".$mail."'"; }
				
				if(isset($description)){
					if($first) {$addArt .="`description`= '".html_entity_decode($description)."'";$first = 0;}
					else 	$addArt .=",`description`= '".html_entity_decode($description)."'"; }
					
				if(isset($url)){
					if($first) {$addArt .="`avatar`= '".$url."'";$first = 0;}
					else 	$addArt .=",`avatar`= '".$url."'"; }
				
				$addArt .= "WHERE id_artiste = ".$_SESSION['id_artiste'];
				//echo $addArt;
				mysql_query($addArt);
				
				header("location: index.php?page=profil_structure&onglet=profil");
				}
				
				if($_GET['gestion'] == 'modification'){  //Modification 
				
				 //Formulaire rempli avec donnees de la base
				$req = "SELECT * FROM `artiste` WHERE `id_artiste` = ".$_SESSION['id_artiste'];
				$res = mysql_query($req);
				$ligne = mysql_fetch_assoc($res); 
				?>

				
				<!--Affichage du formulaire Artiste -->
				<form name='formArt' id='inscriptionArt' method='POST' action='index.php?page=profil_structure&gestion=modification' enctype="multipart/form-data" > <!-- onSubmit='checkForm()'-->
			
				<div class='champs'>
				<h3>Modification de votre profil</h3>
		<!--  		<div><label for='nom'>Nom :</label><input type='text' name='nom' id='nom' onKeyUp="check('nom')" value='<?php echo $ligne['nom'];?>'/>&nbsp;
					<span id='verifNom'></span></div><br/>
					
					<div><label for='prenom'>Pr&eacute;nom :</label><input type='text' name='prenom' id='prenom' onMouseOut="check('prenom')" value='<?php echo $ligne['prenom']; ?>'/>&nbsp;
						<span id='verifPrenom'></span>
					</div><br/> -->
					
					<div><label for='pseudo'>Nickname :</label><input type='text' name='pseudo' id='pseudo' onMouseOut="check('pseudo')" value='<?php echo $ligne['pseudo']; ?>'/>&nbsp;
					<span id='verifPseudo'></span></div><br/>
				<div><label for='description'>Pr&eacute;sentez-vous (vos hobbies, vos ambitions, etc...) :</label><br /><br />
				  <textarea name='description' rows='8' cols='75' maxlength='600' id='description' onMouseOut="check('description')"><?php echo $ligne['description']; ?></textarea>
				&nbsp;<span id='verifDescription'></span>
				</div>
				
				<div><label for='mail'>Adresse mail :</label> 
				<input type='text' name='mail' id='mail' onMouseOut="check('mail');" value='<?php echo $ligne['mail'];?>'/>&nbsp;
				<span id='verifMail'></span></div>			
				
				<h4>Avatar</h4> 
					<img id='avatar_photo' src='<?php echo $ligne['avatar']; ?>' width='100px' height='100px' /><br /> 
					<br /><label for='cover'>Telecharger un fichier</label>&nbsp;&nbsp;
					<input type='hidden' name='MAX_FILE_SIZE' value='10240000' /> <!-- Max données transporté par le formulaire -->
					<input type='file' id='avatar_local' name='avatar_local' />
					<br /><span  style='color:red;font-weight:bold;'>*</span>
					<span id='verifUrl'> L'url de votre photo de couverture doit finir  en .jpg, .png ou .gif</span>
					<br />
				
				<input type='reset' name='Annuler' value='Annuler' />
				<input type='submit' name='Envoyer' value='Envoyer' /> 
				</div>
				</form> <?php
				}
				else{ //Suppression du profil Artiste
				$req_commentaires = "DELETE  FROM `commentaire` WHERE `id_artiste` = ".$_SESSION['id_artiste']." OR `id_membre` = ".$_SESSION['id_artiste'];
				
				$req_oeuvres1 = "SELECT url,extrait_url FROM `oeuvre` WHERE `id_artiste` = ".$_SESSION['id_artiste'];
				$req_oeuvres2 = "DELETE FROM `oeuvre` WHERE `id_artiste` = ".$_SESSION['id_artiste'];
				
				$req_fiche1 = "SELECT avatar FROM `artiste` WHERE `id_artiste` = ".$_SESSION['id_artiste'];
				$req_fiche2 = "DELETE FROM `artiste` WHERE `id_artiste` = ".$_SESSION['id_artiste'];
				
				$res_commentaires = mysql_query($req_commentaires);
				$res_oeuvres1 = mysql_query($req_oeuvres1);
				$res_fiche1 = mysql_query($req_fiche1);
					
					while ($ligne_oeuvres = mysql_fetch_assoc($res_oeuvres1)){
						if( preg_match('#^texte\/#',$ligne_oeuvres1['url']) ) unlink("".$ligne_oeuvres1['url'].""); 
					}
					mysql_query($req_oeuvres2);
					
					echo $req_commentaires;
					echo "<br />";
					
					echo $req_oeuvres1;
					echo $req_oeuvres2;
					echo "<br />";
					
					echo $req_fiche1;
					echo $req_fiche2;
					echo "<br />"; 
					
			$ligne_fiche1 = mysql_fetch_assoc($res_fiche1);
				if(preg_match('#^avatar\/#',$ligne_fiche1['avatar'])) unlink("".$ligne_fiche1['avatar']."");
			mysql_query($req_fiche2);
					
					header('location:index.php?page=index');
				} 
			} //FIN de Modification/Suppression du compte
			
			else{  //Affichage du compte Artiste
			$req_fiche = "SELECT `id_artiste`, `talent`, `nom`, `prenom`, `pseudo`, `mdp`, 
			`mail`, `date_naissance`, `avatar`, `date_updated`, `description` 
			FROM `artiste` 
			WHERE id_artiste = ".$_SESSION['id_artiste'];

			$res_fiche = mysql_query($req_fiche);
			$ligne_fiche = mysql_fetch_assoc($res_fiche);
			?>
			<div id='fiche'> 
			<h1 class='titre_fiche'>VOTRE PROFIL</h1>
			<img id='avatar' class="avatar" style="float:left" src='<?php echo $ligne_fiche['avatar'];?>' width='200' height='200'>
			<table> <?php
				echo "<tr>	
					  <td><b>Nickname: </b></td> <td>".$ligne_fiche['pseudo']."</td>";
				echo "<td><b>Mail: </b></td> <td>".$ligne_fiche['mail']."</td>	
					</tr>";
					
				echo "<tr>	
					  <td><b>Date De Naissance: </b></td> <td>".$ligne_fiche['date_naissance']."</td>";
				echo "<td><b>Talent: </b></td> <td>".$ligne_fiche['talent']."</td>	
					 </tr>";
				echo "<tr>	
					  <td><b>Date d'inscription: </b></td> <td>".$ligne_fiche['date_updated']."</td>	
					 </tr>";
				echo "<tr>	
					  <td colspan='4'><b>Description: </b><i>".html_entity_decode($ligne_fiche['description'])."</i></td>
					</tr>"; ?>
			</table><br /><br />
			<span><a title="Modifier son profil" href='index.php?page=profil_structure&onglet=profil&gestion=modification'><img src='icones\cle_a_molette3.jpg' width='25px' height='25px'/></a>&nbsp;&nbsp;&nbsp;
			<a title="Supprimer son compte" href='index.php?page=profil_structure&onglet=profil&gestion=supprimer'><img src='icones\poubelle.jpg' width='25px' height='25px'/></a></span>
			</div>
			<hr class="delimitation"></hr> 
			
			<div id='bloc_interaction'>   
			 
			  <h1 class='section_titre' align='center'>Vos Commentaires</h1>
			  <br />
		     <?php 
			affichComOeuvreFromId($_SESSION["id_artiste"]); ?>
			</div>
			<?php 
			} //Fin de affichage compte Artiste