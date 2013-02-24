
function check(type)
{
    if (type == 'nom')
    {
        if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifNom').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le nom ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifNom').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }   
    }
	
	
	
	else if(type == 'prenom')
	{
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPrenom').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le pr&eacute;nom ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPrenom').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }   
	}
    
	
		else if(type == 'pseudo')
	{
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPseudo').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le pseudo ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPseudo').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }   
	}
    
    
	else if(type == 'description')
    {
     
        if(document.getElementById(type).value == "")
        {
            document.getElementById('verifDescription').innerHTML='<img src="croix.png" height="14px" width="13px"/> Veuillez remplir ce champs !';
        }
		else
          {
               document.getElementById('verifDescription').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
        
    }
	
	
    else if(type == 'mail')
    {
     
        if(document.getElementById(type).value.indexOf('@') == -1)
        {
            document.getElementById('verifMail').innerHTML='<img src="croix.png" height="14px" width="13px"/> L\'adresse mail n\'est pas valide !';
        }
        else
          {
               document.getElementById('verifMail').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
        
    }
    
    else if(type == 'mdp1')
    {
        
        if(document.getElementById(type).value.length < 5)
        {
            document.getElementById('verifMdp1').innerHTML='<img src="croix.png" height="14px" width="13px"/> Le mot de passe ne peut pas faire moins de 5 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifMdp1').innerHTML='<img src="ok.png" height="14px" width="13px"/>';
          }
    }
  
function checkForm()
{
    if( (document.getElementById('verifNom').innerHTML='<img src="ok.png" height="14px" width="13px"/>') && 
		(document.getElementById('verifPrenom').innerHTML='<img src="ok.png" height="14px" width="13px"/>') &&
		(document.getElementById('verifPseudo').innerHTML='<img src="ok.png" height="14px" width="13px"/>') &&
		(document.getElementById('verifDescription').innerHTML='<img src="ok.png" height="14px" width="13px"/>') &&
		(document.getElementById('verifMail').innerHTML='<img src="ok.png" height="14px" width="13px"/>')  &&
		(document.getElementById('verifMdp1').innerHTML='<img src="ok.png" height="14px" width="13px"/>')
	  )
        {
         document.formArt.submit();
        }
        else
            {
               check(nom); 
               check(prenom); 
               check(mail); 
               check(mdp1);
			   check(description);			   
			   check(pseudo);
			   
			}
}

  
}


    

    