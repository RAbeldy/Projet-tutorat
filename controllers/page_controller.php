<?php
/* Définition du controller */
class PageController
{

	// page d'authentification
	public function home()  
	{
	   set_route('views/page_pres.php');
	}
    
    public function contact()
    {
    	set_route('views/contactAdmin.php');
    }
}
?>	