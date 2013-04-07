


                    <!-- Commentaires -->
                    <div class="bloc_horizontal">
                        <h1>Mes commentaires</h1>
                        
                    <div id='bloc_interaction' >
                     <div id='Comm'>
	
<?php

// Ajout d'un commentaire

if(isset($_SESSION['id_membre'])) $user =  $_SESSION['id_membre'];
else {$user =  $_SESSION['id_artiste'];}

if( (isset($_POST['commenter'])) && (isset($_POST['commentaire']))) {
	$commentaire = htmlentities(mysql_real_escape_string($_POST['commentaire']));
	$oeuvre = $_POST['oeuvre'];
	$artiste = $_POST['artiste'];

	$req_insert = "INSERT INTO commentaire (id_oeuvre,txt_com,id_user,date_updated)
	values('$oeuvre','$commentaire','$user',now())";
	if(mysql_query($req_insert)){
            ?>
                 <script type="text/javascript">alert("Votre commentaire a bien été ajouté !");</script>
            <?php
        }else die("Commentaire non ajoute ".$req_insert." ".mysql_error());
	}	
	
        
        if(isset($user) && isset($_GET['id_oeuvre']))
	{
	  ?>
	<div class='pane post'> <?php 
	$src = getSrcAvatar($user,$_SESSION['type']);

	if(isset($_GET['id_oeuvre'])) $id_oe = $_GET['id_oeuvre']; ?>
            
		&nbsp;<img src='<?php echo $src; ?>'	alt='avatar' id='img_mini' width='50px' height='50px'>
		<div  id='post_text'>
                    <span><?php echo getPseudo($user,$_SESSION['type'])." :"; ?></span>
				<form method='post'  action="#">
					<textarea  rows='3'cols='35' name='commentaire'></textarea>
					<input type='hidden' name='oeuvre' value='<?php echo $id_oe; ?>' />
					<input type='hidden' name='artiste' value='<?php echo $_GET['id_artiste']; ?>' />
			        <input type="submit" name="commenter" value="Commenter" />
				</form>
			
		</div>

	<?php } ?>
	</div>
                 
                         
                         
                         
                         
	<?php 
	/*Affiche les  commentaires*/ 

	if(isset($_GET['id_oeuvre'])) { 
		afficheComOeuvre($_GET['id_oeuvre']); 
		} 

	/*}*/
	?>
	</div> <!--  FIN DU BLOC COMMENTAIRE -->
	
</div></div> <!--   FIN DU BLOC INTERACTION -->

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
