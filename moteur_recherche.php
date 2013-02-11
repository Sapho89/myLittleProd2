<ul id="niveau2" class="niveau2">
<form action="index.php?page=resultats" method="POST" class="recherche">

<li><label for='oeuvre'>Titre de l'oeuvre :</label><input id='oeuvre' type="text" name="titre" value=""/> 

<label for='artiste'>Artiste :</label><input id='artiste' type="text" name="artiste" value=""/> </li>  

<li><label for='genre'>Genre :</label>
<select id='genre' name="genre">

<option value="" selected></option>
    
<?php
		
$reqType = "SELECT distinct type FROM genre";	
        
		if($resType = mysql_query($reqType))
        {
		$i = 0;
		WHILE ($tabType = mysql_fetch_assoc($resType))
			{
?>
	
	<option value="<?php echo $tabType['type']; ?>"><?php echo $tabType['type']; $i++; 
			} 		
		} 
		else die("erreur dans l'affichage des donnees: " .mysql_error());
	
	?></option>
        
        
        
    </select></li>


<li><input type="submit" name="rechercher" value="valider"/></li>

</form>
</ul>
