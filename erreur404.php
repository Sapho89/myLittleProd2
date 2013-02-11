<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
    <head>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js?ver=3.3.1'></script>
<script type="text/javascript" src="jquery.color.js"></script>
<script type='text/javascript' src='mesFonctions.js'></script>
<script type="text/javascript" src="formUser.js"></script>
<script type="text/javascript" src="formArt.js"></script> 
<title>My Little Prod</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if lt IE 9]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> <!-- Pour que IE comprenne balises HTML-->

<!--[if lte IE 7]>
<link rel="stylesheet" href="style_ie.css" />
<![endif]-->	
		
    </head>

<body >
<?php
include_once("connexion.php");
include("mesfonctions.php");
include("fonction.php");

require_once("menu.php");

?>
		
<div class="main-content">
			<h1>La page que vous recherchez n'as pas ete trouve.
			Vous pouvez en informer le webmaster à  cette adresse: </h1>
</div>			
		
</body>

</html>
