<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="styleNew.css" rel="stylesheet" type="text/css" media="screen" />	
    </head>

<body>

<div id="EspaceSon">

<audio id="lecteur" controls="controls" autoplay loop>
  <source src="<?php echo $tab['url_son'];?>" type="audio/mp3" /></source>
</audio>
  Votre navigateur n'est pas compatible
<br/>

Lecture en cours :  <?php echo $tab['titre']; ?>
</div>

</body>


</html>