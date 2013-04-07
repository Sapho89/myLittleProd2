

<?php
if(!isset($_SESSION['type']))
	{
?>
<?php
		if( isset($_POST["bouton"]) && isset($_POST["pseudo"]) && isset($_POST["mdp"]) ) // Le bouton est appuy� et on verifie si le contenu du champs est vide
			{
				$pseudo = $_POST["pseudo"];
				$mdp = $_POST["mdp"];
			
			//require_once("connexion.php");
			$req = "select * from artiste where pseudo='$pseudo' and mdp='$mdp'";
			$res = mysql_query($req);
			$ligne = mysql_fetch_assoc($res);
			
			if(mysql_num_rows($res)<=0) 
			{
			$req = "select * from membre where pseudo='$pseudo' and mdp='$mdp'";
			$res = mysql_query($req);
			$ligne = mysql_fetch_assoc($res);
			}
			
			
		if( ($ligne['mdp'] != $mdp) || ($ligne['pseudo'] != $pseudo) )	
			{
                    
                    ?>
                <div class='connexionArt'>

                    <div id="bulle">
                        <br/><br/>
                        <img src='images/croix.png' height='14px' width='13px'/>&nbsp;Vos identifiants sont incorrects !
                        <br/><br/><a href='index.php'> Revenir au formulaire </a>

                    </div>

                </div>

                    <?php
                        }
			else 
				{
						/*Variables de Session*/
					
				$_SESSION["pseudo"] = $pseudo; //pseudo du membre connecte
				if (!isset($ligne['id_artiste']))
				{
				$_SESSION["id_membre"]= $ligne['id_membre'];
				$_SESSION['type'] = 'm';
				}
				else
				{
				$_SESSION["id_artiste"] = $ligne['id_artiste']; //Id du membre qui surfe sur cette page
				$_SESSION['type'] = 'a'; //Type du membre qui est connect� [Artiste ou membre simple];
				$_SESSION['genre'] = conversion_genre($ligne['talent']);
				}
				
                                //echo 'Bienvenue '.$_SESSION["pseudo"].', vous &ecirc;tes bien connect&eacute;.';
                                
                                header("location:index.php?page=profil_structure");
                                
				}
				
			}
			else 
			{		
			?>
<div class='connexionArt'>

<div id="bulle">
		<form action="#" method="POST">   <!-- on affiche le formulaire tant qu'on a pas cliqu� sur le bouton -->
		<input id="pseudo" type="text" name="pseudo" value="Votre pseudo" size="13" 
		onBlur="if(this.value == '') { this.value = 'Votre pseudo'}" 
		onFocus="if(this.value == 'Votre pseudo') { this.value = ''}"/><br /><br />
		<input id="mdp" type="password" name="mdp" size="13" value="password"
		onBlur="if(this.value == '') { this.value = 'password'}" 
		onFocus="if(this.value == 'password') { this.value = ''}"/>
		<div>
			<input class="bouton" type="submit" value="Connexion" name="bouton"/>
		</div>
		<input type='hidden' name='form' value='form_art'/>
                
                

		</form>

		
		Cr&eacute;er un compte <a href="index.php?page=inscription_artiste">artiste</a> OU <a href="index.php?page=inscription_membre" target="_self">membre</a>
                
</div>
</div>
		<?php
		}
        }
	?>

	