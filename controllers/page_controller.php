<?php
/* Définition du controller */
class PageController
{

	// page d'authentification
	public function home()  
	{
	   require_once('views/page_pres.php');
	}
    
    public function contact()
    {
    	require_once('views/contact.php');
    }
}
?>