<script type="text/javascript">
// Lorsque le DOM est charg� on applique le Javascript 
$(document).ready(function() {
	// On ajoute la classe "js" � la liste pour mettre en place par la suite du code CSS uniquement dans le cas o� le Javascript est activ�
	$("ul.notes-echelle").addClass("js");
	// On passe chaque note � l'�tat gris� par d�faut
	$("ul.notes-echelle li").addClass("note-off");
	// Au survol de chaque note � la souris
	$("ul.notes-echelle li").mouseover(function() {
		// On passe les notes sup�rieures � l'�tat inactif (par d�faut)
		$(this).nextAll("li").addClass("note-off");
		// On passe les notes inf�rieures � l'�tat actif
		$(this).prevAll("li").removeClass("note-off");
		// On passe la note survol�e � l'�tat actif (par d�faut)
		$(this).removeClass("note-off");
	});
	// Lorsque l'on sort du syt�me de notation � la souris
	$("ul.notes-echelle").mouseout(function() {
		// On passe toutes les notes � l'�tat inactif
		$(this).children("li").addClass("note-off");
		// On simule (trigger) un mouseover sur la note coch�e s'il y a lieu
		$(this).find("li input:checked").parent("li").trigger("mouseover");
	});
	// On simule un survol souris des boutons coch�s par d�faut
	$("ul.notes-echelle input:checked").parent("li").trigger("mouseover");
	// On simule un click souris des boutons coch�s
	$("ul.notes-echelle input:checked").trigger("click");
});
</script>

<?php
if( isset($_POST['notesA']) ) {
	if($_SESSION['type'] == 'a') {
		$id_membre = $_SESSION['id_artiste'];
		$req_a = "SELECT * FROM note as n,oeuvre as o WHERE n.id_membre = ".$_SESSION['id_artiste']." AND n.id_oeuvre = ".$_GET['id_oeuvre'];
		$res = mysql_query($req_a);
		$ligne = mysql_fetch_assoc($res);}
	else { 
		$id_membre = $_SESSION['id_membre'];
		$req_m = "SELECT n.* FROM note as n,oeuvre as o WHERE n.id_membre = ".$_SESSION['id_membre']." AND n.id_oeuvre = ".$_GET['id_oeuvre'];
		$res = mysql_query($req_m);
		$ligne = mysql_fetch_assoc($res);
		}
		if(mysql_num_rows($res) != 0 ){ ?> <p class="note">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous avez deja vote (<?php echo $_POST['notesA']."/5";;?>) !</p> <?php }
		else {
			$valeurNote = $_POST['notesA'];
			$id_oeuvre = $_GET['id_oeuvre'];
			$req = "INSERT INTO `note` (`note_valeur`, `id_oeuvre`, `id_membre`) VALUES
			(".$valeurNote.", ".$_GET['id_oeuvre'].", ".$id_membre.")";
			mysql_query($req); ?>
			<p class="note">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Votre vote as bien ete pris en compte !</p> 
			<?php
		}
} else { 
	if($_SESSION['type'] == 'a') {
			$id_membre = $_SESSION['id_artiste'];
			$req_a = "SELECT * FROM note as n,oeuvre as o WHERE n.id_membre = ".$_SESSION['id_artiste']." AND n.id_oeuvre = ".$_GET['id_oeuvre'];
			$res = mysql_query($req_a);
			$ligne = mysql_fetch_assoc($res);}
	else {
			$id_membre = $_SESSION['id_membre'];
			$req_m = "SELECT * FROM note as n,oeuvre as o WHERE n.id_membre = ".$_SESSION['id_membre']." AND n.id_oeuvre = ".$_GET['id_oeuvre'];
			$res = mysql_query($req_m);
			$ligne = mysql_fetch_assoc($res);
	}
	
if(mysql_num_rows($res) != 0 ){ ?> <p class="note">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous avez deja vote (<?php echo $ligne['note_valeur']."/5"; ?>) !</p> <?php }
else {
?>
<form method="post" action="#">
	<!-- Syst�me de notes -->
	<ul class="notes-echelle">
		<li>
			<label for="note01" title="Note&nbsp;: 1 sur 5">1</label>
			<input type="radio" name="notesA" id="note01" value="1" />
		</li>
		<li>
			<label for="note02" title="Note&nbsp;: 2 sur 5">2</label>
			<input type="radio" name="notesA" id="note02" value="2" />
		</li>
		<li>
			<label for="note03" title="Note&nbsp;: 3 sur 5">3</label>
			<input type="radio" name="notesA" id="note03" value="3"/>
		</li>
		<li>
			<label for="note04" title="Note&nbsp;: 4 sur 5">4</label>
			<input type="radio" name="notesA" id="note04" value="4" />
		</li>
		<li>
			<label for="note05" title="Note&nbsp;: 5 sur 5">5</label>
			<input type="radio" name="notesA" id="note05" value="5"checked />
		</li>
	</ul>
	<p><input type="submit" value="Voter&nbsp;!" /></p>
</form>

<?php } } ?>