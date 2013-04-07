<?php

// -------------------
 //  ACCESSEURS
// -------------------

//GET MOY NOTE OEUVRES
function getNote($id_oeuvre)
{
$req = "SELECT avg(note_valeur) AS moyenne FROM note WHERE note_valeur != 0 AND id_oeuvre = $id_oeuvre";
$res = mysql_query($req);
$ligne = mysql_fetch_assoc($res);
return round($ligne['moyenne'],PHP_ROUND_HALF_UP);
}


//CONVERSION GENRE
function conversion_genre($talent){
  switch($talent){
    case 'musicien': return 'musique';
    case 'dessinateur': return 'video'; break;
    case 'peintre': return 'image'; break;
    case 'ecrivain': return 'litterature'; break;
    case 'chanteur': return 'musique'; break;
    default: return null; 
  }
}

//GET PSEUDO
function getPseudo($id_membre,$type)
{
	if($type == 'm') $req = "SELECT pseudo FROM membre WHERE id_membre = $id_membre";	
	else {$req = "SELECT pseudo FROM artiste WHERE id_artiste = $id_membre";}
$res = mysql_query($req);
$ligne = mysql_fetch_assoc($res);
return $ligne['pseudo'];
}

//GET SRC AVATAR
function getSrcAvatar($id_membre,$type)
{
	if($type == 'm') $req = "SELECT avatar FROM membre WHERE id_membre = $id_membre";
	else { $req = "SELECT avatar FROM artiste WHERE id_artiste = $id_membre";}
	$res  = mysql_query($req);
	$ligne = mysql_fetch_assoc($res);
	$src = $ligne['avatar'];
	return $src;
}

//GET DESCRIPTION
function getDescription($id_artiste) //Description valable JUSTE pour les artistes
{
$req = "SELECT description FROM  ARTISTE WHERE id_artiste= $id_artiste";
$res = mysql_query($req);
$ligne = mysql_fetch_assoc($res);
return $ligne['description'];
}

//GET NOMBRE DE FAN
function getFan($id_artiste)
{
$req = "SELECT count(*) FROM fan WHERE id_artiste = $id_artiste";
$res = mysql_query($req);
$ligne = mysql_fetch_assoc($res);
if ($ligne) return $ligne['count(*)'];
else return 0;
}

//GET NOMBRE DE COMMENTAIRES
function getCom($id_artiste)
{
$req = "SELECT count(*) FROM commentaire WHERE id_artiste = $id_artiste";
$res = mysql_query($req);
$ligne = mysql_fetch_assoc($res);
return $ligne['count(*)'];
}

//GET TYPE ID Membre/Artiste ?
function getTypeId($id_membre){
$req_m = "SELECT * FROM membre WHERE id_membre = $id_membre";
$req_a = "SELECT * FROM artiste WHERE id_artiste = $id_membre";

$res_m = mysql_query($req_m);
$res_a = mysql_query($req_a);
if(mysql_num_rows($res_m) != 0) 	return 'm';
else 		return 'a';
}

// -------------------
 //  AFFICHAGE
// -------------------




function conversionToHourFacebook($date1)
{
    

    
    $date2 = date_create("now"); 
    $interval = date_diff($date1, $date2);
    $years = $interval->format('%y'); 
    $months = $interval->format('%m'); 
    $days = $interval->format('%d'); 
    $h = $interval->format('%h');
    $m = $interval->format('%i');
    $s = $interval->format('%s');
    
    
    $ago = "Il y a ";
    
    if($years!=0){ 
        $ago .= $years.' an'; 
    }else{ 
        
        if($months != 0){
            $ago .= $months.' mois'; 
        }
        else{
            
            if($days != 0){
            $ago .= $days.' jour'; 
            }
            else{

                if($h != 0){
                    $ago.= $h.' heure';
                }
                else {
                    if($m != 0){
                        $ago.= $m.' minute';
                    }
                    else  $ago.= $s.' seconde';
                }
        }
        }
         
    } 
    return $ago; 
 
}


//AFFICHAGE DE LA LISTE DES OEUVRES 
function afficheOeuvreParIdArtiste($id_artiste){

$res = "SELECT *
	FROM `oeuvre` 
	WHERE id_artiste = '".$id_artiste."'";
	

$req = mysql_query($res) OR die("Erreur selection des oeuvres de l'artiste ".mysql_error());

$i = 0;

    WHILE($ligne = mysql_fetch_assoc($req))
    {
            ?>
                <img src="<?php echo $ligne['url']; ?>" title="<?php echo $ligne['titre']; ?>" alt="<?php echo $ligne['titre']; ?>" class="contenuAjoute" />
                <br/>
            <?php
            $i++;
    }

}



//AFFICHAGE DES COMMENTAIRES D'OEUVRES PAR ID_OEUVRE
function afficheComOeuvre($id_oeuvre){
 
  if(isset($_SESSION['id_membre'])) $user =  $_SESSION['id_membre'];
  else {$user =  $_SESSION['id_artiste'];}
  
$req = "SELECT * FROM commentaire WHERE id_oeuvre = $id_oeuvre ORDER by date_updated DESC";
$res = mysql_query($req);
	
	while($ligne = mysql_fetch_assoc($res))
	{
	$heure = conversionToHourFacebook(new DateTime($ligne['date_updated']));
	$type = getTypeId($ligne['id_user']);
	$src = getSrcAvatar($ligne['id_user'],$type);
	$id_commentaire = $ligne['id_commentaire'];
	$com = html_entity_decode($ligne['txt_com']);
		echo "<div class='pane post' id='$id_commentaire'>";
                                    // Affichage croix pour supprimer un commentaire
                if($user == $ligne['id_user']) {?>
			<img src='images/effacer.png' alt='Effacer le commentaire' title='Effacer ce commentaire' class='delete' width='20px' height='20px'/>
                        <?php } ?>
                       &nbsp;<img src='.$src.' alt='avatar' id='img_mini' width='50px' height='50px'/>
       <?php
                echo "<div id='post_text'>
                            <span>".getPseudo($ligne['id_user'],$type)." :</span>
                            <div>".$com."</div>
                            <span>".$heure."</span>
                      </div></div>";
  
     } 
}


// Upload d'une image 

function upload_image($fichier){
    
    $url_upload = "avatar/" . $fichier["name"];

if( (stristr($fichier["name"], ".png")) 
        || (stristr($fichier["name"], ".jpeg")) 
            || (stristr($fichier["name"], ".jpg"))
                || (stristr($fichier["name"], ".gif"))
  )
  {
  if ($fichier["error"] > 0)
    {
    echo "Return Code: " . $fichier["error"] . "<br>";
    }
  else
    {
      /*
    echo "Upload: " . $fichier["name"] . "<br>";
    echo "Type: " . $fichier["type"] . "<br>";
    echo "Size: " . ($fichier["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $fichier["tmp_name"] . "<br>";

    */
    
    if (file_exists($url_upload))
      {
      echo $fichier["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($fichier["tmp_name"],
      $url_upload);
      echo "Stored in: " .$url_upload;
      }
    
     return $url_upload;
    }
    
  }
else
  {
  echo "Fichier de format incorrect";
  }
  
   
}



// Upload d'une musique 

function upload_musique($fichier){
    
    $url_upload = "musique/" . $fichier["name"];

if (stristr($fichier["name"], ".mp3"))
  
  {
  if ($fichier["error"] > 0)
    {
    echo "Return Code: " . $fichier["error"] . "<br>";
    }
  else
    {
      /*
    echo "Upload: " . $fichier["name"] . "<br>";
    echo "Type: " . $fichier["type"] . "<br>";
    echo "Size: " . ($fichier["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $fichier["tmp_name"] . "<br>";

    */
    
    if (file_exists($url_upload))
      {
      echo $fichier["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($fichier["tmp_name"],
      $url_upload);
      echo "Stored in: " .$url_upload;
      }
    
     return $url_upload;
    }
    
  }
else
  {
  echo "Fichier de format incorrect";
  }
  
   
}

// Upload d'un livre

function upload_livre($fichier){
    
    $url_upload = "livre/" . $fichier["name"];

if ((stristr($fichier["name"], ".png")) 
        || (stristr($fichier["name"], ".jpeg")) 
            || (stristr($fichier["name"], ".jpg"))
                || (stristr($fichier["name"], ".gif"))
        
   )
  
  {
  if ($fichier["error"] > 0)
    {
    echo "Return Code: " . $fichier["error"] . "<br>";
    }
  else
    {
      /*
    echo "Upload: " . $fichier["name"] . "<br>";
    echo "Type: " . $fichier["type"] . "<br>";
    echo "Size: " . ($fichier["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $fichier["tmp_name"] . "<br>";

    */
    
    if (file_exists($url_upload))
      {
      echo $fichier["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($fichier["tmp_name"],
      $url_upload);
      echo "Stored in: " .$url_upload;
      }
    
     return $url_upload;
    }
    
  }
else
  {
  echo "Fichier de format incorrect";
  }
  
   
}

// Upload d'une video

function upload_video($fichier){
    
    $url_upload = "video/" . $fichier["name"];

if ( (stristr($fichier["name"], ".mp4")) ||
        (stristr($fichier["name"], ".webm")) ||
             (stristr($fichier["name"], ".avi")) ||
                (stristr($fichier["name"], ".flv"))
   )
  
  {
  if ($fichier["error"] > 0)
    {
    echo "Return Code: " . $fichier["error"] . "<br>";
    }
  else
    {
      /*
    echo "Upload: " . $fichier["name"] . "<br>";
    echo "Type: " . $fichier["type"] . "<br>";
    echo "Size: " . ($fichier["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $fichier["tmp_name"] . "<br>";

    */
    
    if (file_exists($url_upload))
      {
      echo $fichier["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($fichier["tmp_name"],
      $url_upload);
      echo "Stored in: " .$url_upload;
      }
    
     return $url_upload;
    }
    
  }
else
  {
  echo "Fichier de format incorrect";
  }
  
   
}


function afficheComUtil($rq, $id){
    // Recuperation des commentaires de la personne connectee    
                       $rsInfos2 = mysql_query($rq) OR die("Erreur selection comm ".  mysql_error());
                       
                          $i = 0;
                         
                        
                          
                        WHILE( $tabInfos2 = mysql_fetch_assoc($rsInfos2) ) {
                              
                           if($tabInfos2['id_oeuvre'] != 0) { 
                            
                                 $rqOeuvre = "SELECT O.*, G.* FROM oeuvre O
                                            INNER JOIN genre G ON id_genre = id_genre1
                                            WHERE O.id_oeuvre = ".$tabInfos2['id_oeuvre']."";
                                 
                                 $rsOeuvre = mysql_query($rqOeuvre) OR die("Erreur selection info oeuvre ".$rqOeuvre." ".mysql_error());
                                 $tabOeuvre = mysql_fetch_assoc($rsOeuvre);

                                 
                                 $genre = $tabOeuvre['type'];
                                 $heure = conversionToHourFacebook(date_create($tabInfos2['date_updated']));
                                 $type = getTypeId($tabInfos2['id_user']);
                                 $src = getSrcAvatar($tabInfos2['id_user'],$type);
                                 $titre = $tabOeuvre['titre']; 
                                 $url = "index.php?page=".$genre."&id_artiste=".$tabOeuvre['id_artiste']."&id_oeuvre=".$tabOeuvre['id_oeuvre'];
                                 echo "<div class='pane post' id=".$id.">";
                                  
                                 if($_GET['page'] == 'modif_compte_artiste') {
                                    // Affichage croix pour supprimer un commentaire
                                  ?>
                                            <img src='images/effacer.png' alt='Effacer le commentaire' title='Effacer ce commentaire' class='delete' width='20px' height='20px'/>
                                           
                                <?php
                                            }
                                
                                echo "<img src='$src' alt='avatar' id='img_mini' width='50px' height='50px'>
                                 <div id='post_text'>
                                 <span>".getPseudo($tabInfos2['id_user'],$type)." :</span>
                                 <div>".$tabInfos2['txt_com']."</div>
                                 <span>$heure</span>
                                 &nbsp;<span class='lien_wall'><a href='".$url."' title='cliquez pour suivre le lien'>".html_entity_decode($titre)."</a></span>
                                  </div>";
                                 echo "</div>";
                            
                                 $i++;
                                 
                            }else echo "Vous n'avez publié aucun commentaire.";
} 


}



?>