<?php
// Artistes 

$rqDerniersInscritsA = "SELECT pseudo, avatar,  `date_inscription` , nom, prenom
                        FROM  `artiste` 
                        ORDER BY  `date_inscription` DESC 
                        LIMIT 5";


$rsDerniersInscritsA = mysql_query($rqDerniersInscritsA) OR die("Impossible d'afficher les derniers inscrits ".mysql_error());

$x= 1;
								
						
WHILE($tabDerniersInscritsA = mysql_fetch_assoc($rsDerniersInscritsA))
	{
            echo "<img src='".$tabDerniersInscritsA['avatar']."' alt='".$tabDerniersInscritsA['pseudo']."' title='".$tabDerniersInscritsA['nom']." ".$tabDerniersInscritsA['prenom']."' width='50px' height='50px'/>";
	$x++;
}	


// Membres 

$rqDerniersInscritsM = "SELECT pseudo, avatar, `date_inscription`, nom, prenom 
                        FROM  membre 
                        ORDER BY  `date_inscription` DESC 
                        LIMIT 5";


$rsDerniersInscritsM = mysql_query($rqDerniersInscritsM) OR die("Impossible d'afficher les derniers inscrits ".mysql_error());

$i=0;
								
						
WHILE($tabDerniersInscritsM =mysql_fetch_assoc($rsDerniersInscritsM))
	{
            echo "<img src='".$tabDerniersInscritsM['avatar']."' alt='".$tabDerniersInscritsM['pseudo']."' title='".$tabDerniersInscritsM['nom']." ".$tabDerniersInscritsM['prenom']."' width='50px' height='50px'/>";
	$i++;
}	




?>