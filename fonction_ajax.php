<?php
include_once("connexion.php");
include_once("fonction.php");

//Controlleur_ajax
switch($_POST['type']){
  case 'suppression': effacer_commentaire(); break;
  default: echo "Demande non reconnu";
}