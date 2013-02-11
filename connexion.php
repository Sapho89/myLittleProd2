<?php

if($link = mysql_connect("localhost","root","") && ($bdd = mysql_select_db("concours")))
{
}
	else 
	{
		die ("Erreur de connexion: ".mysql_error());
	}
	?>