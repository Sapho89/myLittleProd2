<?php
if(!isset($_POST['submit'])){ //Affiche Formulaire
	echo "Affichage d'une oeuvre";
$onglet = $_GET['onglet'];
$num = $_GET['onglet'];
$req = 	"SELECT * FROM `oeuvre` 
		WHERE id_artiste = ".$_SESSION['id_artiste'];
$res = mysql_query($req);
$cpt = 0;
$i = 0;
if($res) {
$i = mysql_num_rows($res);  
$_SESSION['fiche_artiste'] = array();
	while($ligne = mysql_fetch_assoc($res)){
		$_SESSION['fiche_artiste'][$cpt] = $ligne;
		$cpt++;
	}
} ?>
<form name='form_upload' method='POST' action='<?php echo "index.php?page=profil_structure&onglet=$num";?>' enctype='multipart/form-data' >
<fieldset>
<?php 
echo "<legend> Oeuvre N".$_GET['onglet']."</legend>";
echo "<span  style='color:red;font-weight:bold;font-size:0.7em;'>(Tous les champs suivis de * sont obligatoires)</span><br /><br />";

/*Titre de Votre Oeuvre*/ ?>
<label for='titre'>Titre de votre Oeuvre</label>&nbsp;&nbsp;
<input type='text' id='titre' onChange="checkUpload('titre');" name='titre' value='<?php if($num <= $i) echo html_entity_decode($_SESSION['fiche_artiste'][$_GET["num"]-1]['titre']);?>'/>
<span id='verifTitre'></span>
<br /><br />
<?php 
/*Champ cach� pour garder num_oeuvre si modification d'une oeuvre au lieu de creation*/
	if($num <= $i){ $id_oeuvre = $_SESSION['fiche_artiste'][$_GET["num"]-1]['id_oeuvre'];} else{ $id_oeuvre = 0;}
echo "<input type='hidden' name='id_oeuvre' value='".$id_oeuvre."' />"; 
echo "<input type='hidden' name='num' value='$num'/>";

/*Synopsis*/

echo "<label for='synopsis'>Synopsis</label><br />";
echo "<textarea  onChange='checkUpload(('synopsis')' maxlength='600' rows='10'cols='60' name='synopsis'>";if($num <= $i){echo html_entity_decode($_SESSION['fiche_artiste'][$_GET["num"]-1]['synopsis']);} echo "</textarea>";
echo "<br /><span id='verifSynopsis'></span>";

/*Genre*/
	echo "<h3>GENRE ".strtoupper($_SESSION['genre'])." </h3>";
	$reqGenre = "SELECT * FROM genre WHERE type = '".$_SESSION['genre']."'"; 
	$resGenre = mysql_query($reqGenre);

	if( $num <= $i )
		$g1 = $_SESSION['fiche_artiste'][$_GET["num"]-1]['id_genre1'];

	echo "<label for='genre1'>Genre 1:</label>&nbsp;&nbsp;";
	echo "<select name='genre1'>";
		while($ligneGenre = mysql_fetch_assoc($resGenre)){
			echo "<option value='".$ligneGenre['id_genre']."'"; if(isset($g1) && $g1 == $ligneGenre['id_genre']) echo "selected"; echo "/>".$ligneGenre['genre']."</option>";
			}
	echo "</select>&nbsp;&nbsp;";
	if( $num <= $i )
		$g2 = $_SESSION['fiche_artiste'][$_GET["num"]-1]['id_genre2'];
	$resGenre = mysql_query($reqGenre);
	echo "<br /><label for='genre2'>Genre 2:</label>&nbsp;&nbsp;";
	echo "<select name='genre2'>";
	while($ligneGenre = mysql_fetch_assoc($resGenre)){
		echo "<option value='".$ligneGenre['id_genre']."'"; if(isset($g2) && $g2 == $ligneGenre['id_genre']) echo "selected"; echo "/>".$ligneGenre['genre']."</option>";
		}
	echo "</select><br /><br />";


switch($_SESSION['genre']){
	case 'musique': $taille = '31457280';break; //30mb
	case 'video': $taille = '52428800';break; //50kb
	case 'image': $taille = '102400';break; //100kb
}

/*Photo de Couverture [Obligatoire]*/
if($num <= $i)
{$url =  $_SESSION['fiche_artiste'][$_GET["num"]-1]['url'];
$url_son =  $_SESSION['fiche_artiste'][$_GET["num"]-1]['url_son'];} ?>

<br /><label for='avatar_local'>Couverture</label> <br /> 
<div class="photo_thumbnail">
<img id='cover_photo' src='<?php if(isset($url)) echo $url;?>' width='250px' height='350px' /><br />
</div> 
<input type='hidden' name='MAX_FILE_SIZE' value='<?php echo $taille;?>' /> 

<input type='file' name='avatar_local' class="cover_fiche" onchange="readURL(this);"  id="avatar_local" value='<?php if(isset($url)) echo $url; ?>'/> <br />
<label for='oeuvre_file'>Oeuvre</label>

<?php if(isset($url_son)) echo $url_son; ?>
<input type='file' name='oeuvre_file'  value='<?php if(isset($url_son)) echo $url_son; ?>'/> <br />
<span  style='color:red;font-weight:bold;'>*</span>
<span id='verifUrl'>Votre photo de couverture doit être un .jpg, .png ou .gif</span>
<br />

</fieldset>
<input type='reset' name="reset" value='annuler' />
<input type='submit' name="submit" value='envoyer' />
</form>
<?php 
//Quand on cliques sur envoyer, le js vérifies tous les champs. Ils sont TOUS obligatoires sauf upload extrait
}
else {
 //"Compiler" le formulaire puis renvoyer le texte.
 //Formulaire envoy�
	if ($_POST['id_oeuvre'] == 0) //CREATION d'une oeuvre
	{ 
		if(	isset($_POST['titre']) && isset($_POST['synopsis']) && 
		isset($_POST['genre1']) && isset($_POST['genre2'])
		&& isset($_FILES['avatar_local'])) {

	print_r($_FILES['avatar_local']['name']);
	echo "Creation d'une oeuvre";
	switch($_SESSION['genre']){
		case 'musique';{$forme = $_SESSION['genre']; $url_son = upload_musique($_FILES['oeuvre_file']['name'],$_POST['id_oeuvre']);} break;
		case 'video';{$forme = $_SESSION['genre']; $cover = upload_video($_FILES['oeuvre_file']['name'],500,500,$forme,$_POST['id_oeuvre']);} break;
	}
	
	$cover = upload_image($_FILES['avatar_local']['name'],500,500,'cover',$_POST['id_oeuvre']);
	
	print_r($cover);
		echo "TAILLE MAXIMUM DU FORMULAIRE POUR ".strtoupper($forme)." <br />"; ?>
		<table border="1"> 
			<tr>	<td>o</td> 	<td><?php echo $_POST['MAX_FILE_SIZE'];?></td>				</tr>
			<tr>	<td>ko</td>	<td><?php echo $_POST['MAX_FILE_SIZE']/1024;?></td>			</tr>
			<tr>	<td>mo</td>	<td><?php echo $_POST['MAX_FILE_SIZE']/1024/1024;?></td>	</tr>
		</table> <?php 
		echo "<br />TAILLE DU FICHIER<br />";
		echo $_FILES["avatar_local"]['size']." o <br />";
		echo $_FILES["avatar_local"]['size']/1024," ko <br />";
		print_r($_FILES["avatar_local"]);
	
	$extension = "";
	
	$titre =  mysql_real_escape_string($_POST['titre']);
	$synopsis =  mysql_real_escape_string($_POST['synopsis']);
	
	$id_artiste = $_SESSION['id_artiste'];
	
	$id_genre1 = $_POST['genre1'];
	$id_genre2 = $_POST['genre2'];
   
	$req_modif3 = "INSERT INTO oeuvre (id_artiste,titre,url,url_son,extension,date_updated,synopsis,id_genre1, id_genre2)
				VALUES ('$id_artiste','$titre','$cover','$url_son','$extension',now(),'$synopsis',$id_genre1,$id_genre2)";						
	echo $req_modif3;
	mysql_query($req_modif3);
	
		//header("location:index.php?page=profil_structure&onglet=".$_POST['num']);
		}
		else { // Une des données est manquante
		echo "Une des données est manquante <br /> Vous allez être redirigé dans 3 secondes vers la page principale";
		echo "<meta http-equiv='refresh' content='3; url=index.php?page=profil_structure'>";
		}
	}
	else{//MODIFICATION d'un oeuvre existante
	if(	isset($_POST['titre']) && isset($_POST['synopsis']) && isset($_POST['genre1']) && isset($_POST['genre2'])) {
	
	echo "Modification d'une oeuvre existante <br />";
	/*
	echo "TAILLE MAXIMUM DU FORMULAIRE POUR ".strtoupper($forme)." <br />"; ?>
	<table border="1"> 
		<tr>	<td>o</td> 	<td><?php echo $_POST['MAX_FILE_SIZE'];?></td>				</tr>
		<tr>	<td>ko</td>	<td><?php echo $_POST['MAX_FILE_SIZE']/1024;?></td>			</tr>
		<tr>	<td>mo</td>	<td><?php echo $_POST['MAX_FILE_SIZE']/1024/1024;?></td>	</tr>
	</table> <?php 
	echo "<br />TAILLE DU FICHIER<br />";
	echo $_FILES["avatar_local"]['size']." o <br />";
	echo $_FILES["avatar_local"]['size']/1024," ko <br />";
	print_r($_FILES["avatar_local"]); */
	
	$titre 		= mysql_real_escape_string(html_entity_decode($_POST['titre']));
	$synopsis 	= mysql_real_escape_string(html_entity_decode($_POST['synopsis']));
	$id_genre1 	= $_POST['genre1'];
	$id_genre2 	= $_POST['genre2'];
	
	switch($_SESSION['genre']){
		case 'musique':{ 
			if(isset($_FILES['oeuvre_file']['name']) && !empty($_FILES['oeuvre_file']['name'])) 
		$url = upload_musique($_FILES['oeuvre_file']['name'],$_POST['id_oeuvre']);} break;
		case 'video':{ 	
			if(isset($_FILES['oeuvre_file']['name']) && !empty($_FILES['oeuvre_file']['name']))
		$url = upload_video($_FILES['oeuvre_file']['name'],$_POST['id_oeuvre']);} break;
	}
	
	if(isset($_FILES['avatar_local']['name']) && !empty($_FILES['avatar_local']['name'])){
	$cover = upload_image($_FILES['avatar_local']['name'],500,500,'cover',$_POST['id_oeuvre']);}
	
	$id_oeuvre = $_POST['id_oeuvre'];
	$first = 1;
	
	$req_modif3 = "UPDATE oeuvre SET ";
	
	if(!empty($titre)){
		if($first){
		 $req_modif3 .= " titre = '$titre'";$first=0;}
	}
	if(!empty($cover)){
		if($first){
			$req_modif3 .= " url = '".$cover."'";$first=0;}
		else {$req_modif3 .= ", url = '".$cover."'";$first=0;}
	}
	if(!empty($url)){
		if($first){
			$req_modif3 .= " url_son = '".$url."'";$first=0;}
			else {$req_modif3 .= ", url_son = '".$url."'";$first=0;}
	}
	if(!empty($synopsis)){
		if($first){
			$req_modif3 .= " synopsis = '".$synopsis."'";$first=0;}
			else {$req_modif3 .= ", synopsis = '".$synopsis."'";$first=0;}
	}
	if($id_genre1){
		if($first){
			$req_modif3 .= " id_genre1 = '".$id_genre1."'";$first=0;}
			else {$req_modif3 .= ", id_genre1 = '".$id_genre1."'";$first=0;}
	}
	if($id_genre2){
		if($first){
			$req_modif3 .= " id_genre2 = '".$id_genre2."'";$first=0;}
			else {$req_modif3 .= ", id_genre2 = '".$id_genre2."'";$first=0;}
	}
	$req_modif3 .= " , date_updated = now() WHERE id_oeuvre = ".$id_oeuvre;	
	echo $req_modif3;
	mysql_query($req_modif3) or die ($req_modif3);
	
		//header("location: index.php?page=profil_structure&onglet=".$_POST['num']);
		}
		else { // Une des données est manquante
		echo "Une des données est manquante <br /> Vous allez être redirig�e dans 3 secondes vers la page principale";
		echo "<meta http-equiv='refresh' content='3; url=index.php?page=profil_structure'>";}
	}
} //Fin du Else du formulaire de saisie/mise � jour DataBase
?>
<script type="text/javascript">
function readURL(input) {
	apercu=document.getElementById('avatar_local').value;
	inImg= 'file:///'+apercu;
	document.getElementById('thumbnail').innerHTML='<img src="'+inImg+'" width="'+dW+'" height="'+dH+'" border="0">';
        }
</script>	