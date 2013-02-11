<<<<<<< Updated upstream
//Zoom sur la couverture
function PopupImage() {
w=open(document.img_texte.src,'image','width=450,height=500,toolbar=no,scrollbars=no,resizable=yes');	
//w.document.title='Steve \'s story';
}

//Affichage du PDF ou des JPGS pour l'extrait du livre
/*
function extrait(){
w=open('','image','width=700,height=812,toolbar=no,scrollbars=1,resizable=yes');	
w.document.title='Extrait de Steve \'s story';
w.document.write("<HTML><HEAD><TITLE></TITLE></HEAD>");
w.document.write("<BODY><IMG style='display:block;margin:0 auto;width:600px;'src='texte\\stevesstorypage01.gif' border=0/>"); //Il faut doubler le slash !!!
w.document.write("<br />");
w.document.write("<IMG style='display:block;margin:0 auto;width:600px;' src='texte\\stevesstorypage02.gif' border=0/>");
w.document.write("<br />");
w.document.write("<IMG style='display:block;margin:0 auto;width:600px;' src='texte\\stevesstorypage03.gif' border=0/>");
w.document.write("</BODY></HTML>");
w.document.close();
}
*/
function coverAffich(image){
    alert(image);
    //document.form_upload.img.getElementById("cover2").src =  image;//document.form_upload.input.getElementById("cover").value;
}

function checkUpload(type)
{
	var verif = 0;
	switch(type){
	case 'titre':{
		
    	console.log("checkUpload" + titre);
        if(document.getElementById(type).value.length < 1)
        {
            document.getElementById('verifTitre').innerHTML='<img src="croix.png" height="14px" width="13px"/> Votre titre doit faire au moins un caract&egrave;res !';
        	verif = 0;
        }
        else
          {
               document.getElementById('verifTitre').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
           	verif = 1;
          }   
    } break;

	case 'synopsis':{
		if((document.getElementById(type).value.length < 200) || (document.getElementById(type).value.length > 600))
        {
            document.getElementById('verifSynopsis').innerHTML='<img src="croix.png" height="14px" width="13px"/> Votre synopsis doit faire entre 200 et 600 caract&egrave;res !';
            verif = 0;
        }
        else
          {
               document.getElementById('verifSynopsis').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
               verif = 1;
          }   
	}break;
    
	
	case 'avis_auteur':{
		if((document.getElementById(type).value.length < 200) || (document.getElementById(type).value.length > 600))
        {
            document.getElementById('verifAvis_auteur').innerHTML='<img src="croix.png" height="14px" width="13px"/> Votre avis doit faire entre 200 et 600 caract&egrave;res !';
            verif = 0;
        }
        else
          {
               document.getElementById('verifAvis_auteur').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
               verif = 1;
          }   
	}break;
	
	case 'url':{
		if( /* Ecrire la condition pour le champs URL */) 
		{
			document.getElementById('verifUrl').innerHTML='<img src="croix.png" height="14px" width="13px"/> L\'age doit etre compris entre 10 et 100 !';
			verif = 0;
		}
		else
		  {
			   document.getElementById('verifUrl').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
			   verif = 1;
		  }
		}
	default: console.log("Erreur dans la verification des champs du formulaire");
	}
    return verif;
}

function check(type)
{
    switch(type){
		case 'nom'):
			if(document.getElementById(type).value.length <= 2)
			{
				document.getElementById('verifNom').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le nom ne peut pas faire moins de 2 caract&egrave;res !';
			}
			else
			  {
				   document.getElementById('verifNom').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
			  }   
		break;
	
	
	
		case 'prenom'):
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPrenom').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le pr&eacute;nom ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPrenom').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }   
		break;
    
	
		case 'pseudo'):
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPseudo').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le pseudo ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPseudo').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }   
		break;
    
    
	case 'description'):
        if(document.getElementById(type).value == "")
        {
            document.getElementById('verifDescription').innerHTML='<img src="croix.png" height="14px" width="13px"/> Veuillez remplir ce champs !';
        }
		else
          {
               document.getElementById('verifDescription').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
    break;
	
	case 'mail'): ////Pattern à faire
        if(document.getElementById(type).value == "")
        {
            document.getElementById('verifDescription').innerHTML='<img src="croix.png" height="14px" width="13px"/> Veuillez remplir ce champs !';
        }
		else
          {
               document.getElementById('verifDescription').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
    break;
	
	case 'avatar'): //Pattern à faire
        if(document.getElementById(type).value == "")
        {
            document.getElementById('verifDescription').innerHTML='<img src="croix.png" height="14px" width="13px"/> Veuillez remplir ce champs !';
        }
		else
          {
               document.getElementById('verifDescription').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
    break;
	
	
	}
}
function checkUploadForm()
{
    if( (document.getElementById('verifNom').innerHTML='') && 
		(document.getElementById('verifPrenom').innerHTML='') &&
		(document.getElementById('verifPseudo').innerHTML='') &&
		(document.getElementById('verifDescription').innerHTML='') &&
		(document.getElementById('verifMail').innerHTML='')  &&
		(document.getElementById('verifMdp1').innerHTML='') &&
		(document.getElementById('verifMdp2').innerHTML='')	
	  )
        {
         document.formUser.submit();
         alert("Le formulaire a bien été envoyé !")
        }
        else
            {
               check(nom); 
               check(prenom); 
               check(age); 
               check(mail); 
               check(mdp1); 
               check(mdp2); 
            }
}

  
}
   
