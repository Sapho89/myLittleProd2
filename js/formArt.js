
function check(type)
{
    if (type == 'nom')
    {
        if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifNom').innerHTML='<img src="images/croix_rouge.png"/> Le nom ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifNom').innerHTML='<img src="images/ok.png"/>';
          }   
    }
	
	
	
	else if(type == 'prenom')
	{
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPrenom').innerHTML='<img src="images/croix_rouge.png"/> Le pr&eacute;nom ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPrenom').innerHTML='<img src="images/ok.png"/>';
          }   
	}
    
	
        else if(type == 'pseudo')
	{
		if(document.getElementById(type).value.length <= 2)
        {
            document.getElementById('verifPseudo').innerHTML='<img src="images/croix_rouge.png"/> Le pseudo ne peut pas faire moins de 2 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifPseudo').innerHTML='<img src="images/ok.png"/>';
          }   
	}
        
         else if(type == 'date_naissance')
	{
		if(document.getElementById(type).value == '')
        {
            document.getElementById('verifDate_naissance').innerHTML='<img src="images/croix_rouge.png"/> Veuillez s&eacute;lectionner votre date de naissance !';
        }
        else
          {
               document.getElementById('verifDate_naissance').innerHTML='<img src="images/ok.png"/>';
          }   
	}
    
    
         else if(type == 'talent')
	{
		if(document.getElementById(type).value == '')
        {
            document.getElementById('verifTalent').innerHTML='<img src="images/croix_rouge.png"/> Veuillez faire un choix !';
        }
        else
          {
               document.getElementById('verifTalent').innerHTML='<img src="images/ok.png"/>';
          }   
	}
    
    
    
	else if(type == 'description')
    {
     
        if(document.getElementById(type).value == "")
        {
            document.getElementById('verifDescription').innerHTML='<img src="images/croix_rouge.png"/> Veuillez remplir ce champs !';
        }
		else
          {
               document.getElementById('verifDescription').innerHTML='<img src="images/ok.png"/>';
          }
        
    }
	
	
    else if(type == 'mail')
    {
     
        if(document.getElementById(type).value.indexOf('@') == -1)
        {
            document.getElementById('verifMail').innerHTML='<img src="images/croix_rouge.png"/> L\'adresse mail n\'est pas valide !';
        }
        else
          {
               document.getElementById('verifMail').innerHTML='<img src="images/ok.png"/>';
          }
        
    }
    
    else if(type == 'mdp1')
    {
        
        if(document.getElementById(type).value.length < 5)
        {
            document.getElementById('verifMdp1').innerHTML='<img src="images/croix_rouge.png"/> Le mot de passe ne peut pas faire moins de 5 caract&egrave;res !';
        }
        else
          {
               document.getElementById('verifMdp1').innerHTML='<img src="images/ok.png"/>';
          }
    }
  
function checkFormArt()
{
    if( (document.getElementById('verifNom').innerHTML='<img src="images/ok.png"/>') && 
		(document.getElementById('verifPrenom').innerHTML='<img src="images/ok.png"/>') &&
		(document.getElementById('verifPseudo').innerHTML='<img src="images/ok.png"/>') &&
		(document.getElementById('verifDescription').innerHTML='<img src="images/ok.png"/>') &&
		(document.getElementById('verifMail').innerHTML='<img src="images/ok.png"/>')  &&
		(document.getElementById('verifMdp1').innerHTML='<img src="images/ok.png"/>')
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
               check(talent);
               check(date_naissance);
			   
            }
}

  
}


    

    