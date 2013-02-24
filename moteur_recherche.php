
<script>
$(document).ready(function() {
       $("#cadre-menu").hover(function() {
            $("#cadre-menu").animate({ marginLeft: "0"  }, 400 );
         $(this).toggleClass("activate");
         $(".activate").animate({marginLeft:"170px"}, 400);
    });
 
  });
</script>

<div id="cadre-menu">
	<div id="bordure-menu">
            <form action="index.php?page=resultats" method="POST" >
		Titre de l'oeuvre :<input id='oeuvre' type="text" name="titre" value=""/> 
                Artiste :<input id='artiste' type="text" name="artiste" value=""/>
                Genre :
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
                </select>
            
                <input type="submit" class="rechercher" name="rechercher" value="valider"/>
            </form>
	</div>
	<div id="bouton-menu">
 
	</div>
</div>



<!--
<form action="index.php?page=resultats" method="POST" >


    <li><span><label for='oeuvre'>Titre de l'oeuvre :</label><input id='oeuvre' type="text" name="titre" value=""/> </span></li>

    <li><span><label for='artiste'>Artiste :</label><input id='artiste' type="text" name="artiste" value=""/> </span></li>  

<li><span><label for='genre'>Genre :</label>
<select id='genre' name="genre">

<option value="" selected></option>
    
<?php
/*
		
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
	*/
	?></option>
        
        
        
    </select></span></li>


<li><span><input type="submit" name="rechercher" value="valider"/></span></li>


 </form>
        -->