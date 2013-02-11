


<div id="tableau" >


<?php

$reqGenre = "SELECT *, g.type as type1, g.genre AS genre1, g2.genre AS genre2 from oeuvre o 
		   INNER JOIN genre g on g.id_genre = id_genre1
                   INNER JOIN genre g2 on g2.id_genre = id_genre2                   
                   ORDER BY type1,date_updated";


if($resGenre = mysql_query($reqGenre))   
{

    $i = 0;
    $type = "";
    
    while($tabGenre = mysql_fetch_assoc($resGenre))
    {
        
        if($type!=$tabGenre['type1'])
        {
            $i=0;
         ?>
            
         <div style="float:left">
   
            <?php
                $type=$tabGenre['type1'];
            ?>
            <h2><?php echo $tabGenre['type1'];?></h2>
     

        <?php    
            
        }
      
        if($i<4)
        {
            ?>

        <div class="colonne">
        <a href="description.php?id_artiste=<?php echo $tabGenre['id_artiste']; ?>&id_oeuvre=<?php echo $tabGenre['id_oeuvre'];?>&type=<?php echo  $tabGenre['type1']; ?>" target="_self">
        <img class="miniature" src="<?php echo $tabGenre['url']; ?>"/></a> 
        </div>


<?php
        }
        
        if($i==3)
        {
          ?>
            
        </div>

        <?php    
        }
     $i++;   
    }

}
else die('erreur sql'.mysql_error()); 
?>
</div>
