<?php
//Placer les elements flottants en premier !!
	echo "
	<aside>
	<a href='texte\steves-story-cover.jpg'  onClick='PopupImage();return false;'>
		<img id='img_texte'	name='img_texte' src='texte\steves-story-cover.jpg' alt='Couverture de Steve''s Story' width='300px' height='400px' />
		<img src='icones\loupe.png' id='loupe' alt='icone_loupe' width='36px' height='40px'/></a>
	</aside>";

	/*BLOC ARTISTE*/
	require_once('includes/nav_artiste.php');

echo "
<div id='resume' >
	<p>&nbsp;&nbsp;<strong>Steve'Story</strong> ou l'histoire d'un jeune homme dont la rencontre avec un nouvel �l�ve mysterieux et �trange vas reveiller en lui des sentiments cach�s.<br /><br />
	<span style='text-decoration:underline;'>Tab Kimpton:</span><em> 'La premi�re bande dessin�e que j''ai r�ussi de finir d''�crire. Bas� sur ma vie et des amis que j''ai connu'</em> </p>
	<a href='javascript:extrait();' > <mark><img src='icones\puce.png' width='30px' height='30px'/>Extrait de Steve's Story</mark></a>
<div style='clear:both;'></div>  
</div>";//Pour que le bloc R�sum� recouvre les blocs Aside et Nav_droit
?>