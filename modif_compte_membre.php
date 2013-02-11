<?php				if( isset($_GET['gestion'])) {  //GESTION DU COMPTE 
				//TRAITEMENT DES DONNEES MODIFIES				
				if( isset($_POST['nom']) && isset($_POST['prenom']))
					{
					$nom = mysql_real_escape_string ($_POST['nom']);
					$prenom = mysql_real_escape_string ($_POST['prenom']);
					$pseudo = mysql_real_escape_string ($_POST['pseudo']);
					$mail = $_POST['mail'];
				
				$url = upload_image($_FILES['avatar_local']['name'],250,250,1000 * 1024); //Dimension/Format/Poids  modifiables
				
				$addArt = "UPDATE `membre` SET
							`nom`= '$nom',`prenom`='$prenom',`pseudo`='$pseudo',`mail`= '$mail'";	
				if( $url != NULL ) $addArt .= ",`avatar`= '$url'";
				$addArt .= "WHERE id_membre = ".$_SESSION['id_membre'];
				//echo $addArt;
				//echo "test1";
				mysql_query($addArt);
				} 
				if($_GET['gestion'] == 'modification'){  //Modification 
				
				 //Formulaire rempli avec donnees de la base
				$req = "SELECT * FROM `membre` WHERE `id_membre` = ".$_SESSION['id_membre'];
				$res = mysql_query($req);
				$ligne = mysql_fetch_assoc($res); 
				
				echo "<form name='formArt' id='inscriptionArt' method='POST' action='index.php?page=profil_structure&gestion=modification' enctype='multipart/form-data' >"; //onSubmit='checkForm()'
				
				echo "<div class='champs' align='middle'>";
				echo "<h3>Modification de votre profil</h3>";	
				echo "<div><label for='nom'>Nom :</label><input type='text' name='nom' id='nom' onMouseOut='check('nom')' value='";echo $ligne['nom']; echo "'/>&nbsp;
				<span id='verifNom'></span></div><br/>";
				
				echo "<div><label for='prenom'>Pr&eacute;nom :</label><input type='text' name='prenom' id='prenom' onMouseOut='check('prenom')' value='";echo $ligne['prenom']; echo "'/>&nbsp;
				<span id='verifPrenom'></span></div><br/>";
				
				echo "<div><label for='pseudo'>Nickname1 :</label><input type='text' name='pseudo' id='pseudo' onMouseOut='check('pseudo')' value='"; echo $ligne['pseudo']; echo "'/>&nbsp;
				<span id='verifPseudo'></span></div><br/>";

				echo "<div><label for='mail'>Adresse mail :</label> <input type='text' name='mail' id='mail' onMouseOut='check('mail')' value='";echo $ligne['mail']; echo "'/>&nbsp;
				<span id='verifMail'></span></div><br/>";
				?>
				<h4>Avatar</h4> 
				<img id='avatar_photo' src='<?php echo $ligne['avatar']; ?> ' width='100px' height='100px' /><br /> 
				<?php //";echo $ligne['avatar'];echo"'
				echo "<br /><label for='cover'>Telecharger un fichier</label>&nbsp;&nbsp;";
				echo "<input type='hidden' name='MAX_FILE_SIZE' value='10240000' />"; //Max données transporté par le formulaire
				echo "<input type='file' onKeyUp=\"avatar_mini('')\" id='avatar_local' name='avatar_local' />
				<br /><span  style='color:red;font-weight:bold;'>*</span>
				<span id='verifUrl'> L'url de votre photo de couverture doit finir  en .jpg, .png ou .gif</span>
				<br />";

				echo "<input type='reset' name='Annuler' value='Annuler' />
				<input type='submit' name='Envoyer' value='Envoyer' /> 
				</div>
				</form>";
				}
				
				else{ //Suppression Membre
				$req_commentaires = "DELETE  FROM `commentaire` WHERE `id_membre` = ".$_SESSION['id_membre'];
				
				$req_fiche1 = "SELECT avatar FROM `membre` WHERE `id_membre` = ".$_SESSION['id_membre'];
				$req_fiche2 = "DELETE FROM `membre` WHERE `id_membre` = ".$_SESSION['id_membre'];
				
				$res_commentaires = mysql_query($req_commentaires);
				$res_fiche1 = mysql_query($req_fiche1);
					
					$ligne_fiche1 = mysql_fetch_assoc($res_fiche1);
						if(preg_match('#^avatar\/#',$ligne_fiche1['avatar'])) unlink("".$ligne_fiche1['avatar']."");
					mysql_query($req_fiche2);
					
					header('location:index.php');
				} 
			} //FIN DE GESTION DU COMPTE
			else{  //Affichage du compte 
			
			$req_fiche = "SELECT `id_membre`, `nom`, `prenom`, `pseudo`, `mdp`, 
			`mail`, `date_naissance`, `avatar`
			FROM `membre` 
			WHERE id_membre = ".$_SESSION['id_membre'];

			$res_fiche = mysql_query($req_fiche);
			$ligne_fiche = mysql_fetch_assoc($res_fiche);
			
			echo "<div id='fiche'><div style='border-bottom:7px black ridge;margin-bottom: 10px;'>
			<div class='section_titre'>Votre Profil</div></div>";
			echo "<img id='avatar' src='".$ligne_fiche['avatar']."' width='200' height='200'>";
			echo "<table border='none'>";
				echo "<tr>	
					  <td><b>Nom: </b></td> <td>".$ligne_fiche['nom']."</td>";
				echo "<td><b>Prenom: </b></td> <td>".$ligne_fiche['prenom']."</td>	
					 </tr>";
					 
				echo "<tr>	
					  <td><b>Nickname4: </b></td> <td>".$ligne_fiche['pseudo']."</td>";
				echo "<td><b>Mail: </b></td> <td>".$ligne_fiche['mail']."</td>	
					</tr>";
					
				echo "<tr>	
					  <td><b>Date De Naissance: </b></td> <td>".$ligne_fiche['date_naissance']."</td>";
				echo "<td><b>Mot De Passe: </b></td> <td>".$ligne_fiche['mdp']."</td>	
					 </tr>";
			echo "</table><br /><br />";
			echo "<span align='right'><img src='icones\cle_a_molette3.jpg' width='25px' height='25px'/><a href='index.php?page=profil_structure&onglet=profil&gestion=modification'> Modfier votre compte </a>&nbsp;</span>";
			echo "<span align='right'><img src='icones\poubelle.jpg' width='25px' height='25px'/><a href='index.php?page=profil_structure&onglet=profil&gestion=supprimer'> Supprimer votre compte </a></span>";
			echo '</div>';
			
			echo "<div id='bloc_interaction'><div style='border-bottom:7px black ridge;margin-bottom: 10px;'>
			<div class='section_titre' align='center'>Vos Commentaires</div></div>";
			affichComOeuvreFromId($_SESSION["id_membre"]);
			echo '</div>';
			} //FIN DE AFFICHAGE COMPTE MEMBRE 
	?>		