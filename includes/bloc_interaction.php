<div id='bloc_interaction' >
<div id='Comm'>
<h1 class='soustitre'>Commentaires</h1>

	
<?php
if(isset($_SESSION['id_membre'])) $user =  $_SESSION['id_membre'];
else {$user =  $_SESSION['id_artiste'];}

if(isset($_POST['commentaire'])) {
	$commentaire = htmlentities(mysql_real_escape_string($_POST['commentaire']));
	$oeuvre = $_POST['oeuvre'];
	$artiste = $_POST['artiste'];

	$req_insert = "INSERT INTO commentaire (id_oeuvre,txt_com,id_artiste,id_membre,date_updated)
	values('$oeuvre','$commentaire','$artiste','$user',now())";
	mysql_query($req_insert) or die($req_insert);
	}	
	/*Ajout d'un commentaire*/
	//onglet permet de différencier l'endroit où est affiché le message. Page de l'oeuvre ou page d'admin de l'artiste
//	if ( (isset($_GET['onglet']) && is_numeric($_GET['onglet']) && isset($_SESSION['fiche_artiste'][$num-1])) || isset($_GET['id_oeuvre'] ) )
	if(isset($_SESSION['id_artiste']) & isset($_GET['id_oeuvre']))
	{
	  ?>
	<div class='pane post'> <?php 
	$src = getSrcAvatar($user,$_SESSION['type']);
/*	if (isset($_SESSION['fiche_artiste'][$num-1]))
			$id_oe = $_SESSION['fiche_artiste'][$num-1]['id_oeuvre']; */
	if(isset($_GET['id_oeuvre']))
			$id_oe = $_GET['id_oeuvre']; ?>
		<img src='<?php echo $src; ?>'	alt='avatar' id='img_mini' width='50px' height='50px'>
		<div  id='post_text'>
				<form method='post'  action="#">
					<textarea  id='com_area' maxlength='600' rows='5'cols='40' name='commentaire'></textarea>
					<input type='hidden' name='oeuvre' value='<?php echo $id_oe; ?>' />
					<input type='hidden' name='artiste' value='<?php echo $_GET['id_artiste']; ?>' />
			        <input type="submit" />
				</form>
			<span><a href='#'><?php echo getPseudo($user,$_SESSION['type']); ?></a></span>
		</div>

	<?php } ?>
	</div>
	<?php 
	/*Affich commentaires*/ /*
	if(is_numeric($_GET['onglet']) && isset($_SESSION['fiche_artiste'][$num-1]) ){ //Si affiché sur la page d'une oeuvre dans le profil d'un artiste
		$id_oeuvre = $_SESSION['fiche_artiste'][$_GET["num"]-1]['id_oeuvre'];
		affichComOeuvreById_O($id_oeuvre);}
	else { */
	if(isset($_GET['id_oeuvre'])) { 
		affichComOeuvreById_O($_GET['id_oeuvre']); //Sur un description_...
		} 
	else {
		if ( !(isset($_GET['num'])) OR $_GET['num'] == 'profil' OR $_GET['num'] == 'recap' OR ($id_oeuvre == 0) ) 
			affichComOeuvreById_A($_SESSION["id_membre"]); //Dans le profil d'un membre
	}
	/*}*/
	?>
	</div> <!--  FIN DU BLOC COMMENTAIRE -->
	
</div> <!--   FIN DU BLOC INTERACTION -->

<script type="text/javascript">
$(document).ready(function(){
	//Ajouter un commentaire
	/* $(".ajouter").click(function(){
			alert("Kikoo");
		 $.ajax({
			   type: "POST",
			   url: "fonction_ajax.php",
			   data: "type=ajout",
			   success: function(msg){
			     console.log( "Nouveau message d'id:" + msg);
			   }
			 }); 		
		 //alert(msg);	     
		 //$('#com').append(msg);
      });  */
	      
	//Effacer un commentaire
	$(".delete").click(function(){
		var id = $(this).parents(".pane").attr("id");
		var val = confirm("Voulez vous supprimer ce message ?");
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
