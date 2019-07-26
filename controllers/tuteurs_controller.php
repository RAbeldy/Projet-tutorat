<?php
require_once('models/tuteurs.php');
require_once('models/evenements.php');
require_once('models/users.php');
/* Définition du controller */
class TuteursController
{

    public function interface_tuteur()
    {   
        if( isset($_SESSION['id_statut']))
            require_once('views/tuteurs/interface_tuteur.php');
        else
            require_once('views/login.php');
    }
    public function tuteur_set_event()
    {   if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
          {
            $tuteurs = new Tuteurs();
            $donnees = $tuteurs->Get_working_list($_SESSION['id_user']);
            require_once('views/tuteurs/tuteur_set_event.php'); // on charge la vue adéquate
          }
        else
            require_once('views/login.php');
    }

    public function selection_tutores()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            require_once('views/tuteurs/interface_selection_tutores_tuteurs.php'); // on charge la vue adéquate
        else
            require_once('views/login.php');
    }

    public function tutores_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            $tuteurs= new Tuteurs();
            $donnees= $tuteurs->Get_all_tutores();
            require_once('views/tuteurs/tutores_list.php');
        }
        else
            require_once('views/login.php');  
    }
    public function notifications()
    {
        if( isset($_SESSION['id_statut']))
            require_once('views/tuteurs/notifications_tuteurs.php');
        else
            require_once('views/login.php');
    }
    public function waiting_list()  // on récuprère la lsite des 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
            $tuteurs= new Tuteurs();
            $donnees= $tuteurs->Get_waiting_list($_SESSION['id_user']);
            require_once('views/tuteurs/waiting_list.php');
        }
        else
            require_once('views/login.php'); 

    }
    public function link() // action de se lier à un tuteur ou un tutoré
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
             $tuteurs= new Tuteurs();
             $tuteurs->Link_with_tutores($_SESSION['id_user'],$_POST['id_u']);
            require_once('views/tuteurs/notifications_tuteurs.php');
             
        }
        else
            require_once('views/login.php'); 
    }
    public function accept_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
            $tuteurs= new Tuteurs();
             $tuteurs->Accept_link($_SESSION['id_user'],$_POST['id_u']);
            require_once('views/tuteurs/notifications_tuteurs.php');
             
        }
        else
            require_once('views/login.php'); 
    }

    public function delete_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
            $tuteurs= new Tuteurs();
             $tuteurs->Delete_link($_POST['id_u']);
            require_once('views/tuteurs/notifications_tuteurs.php');
             
        }
        else
            require_once('views/login.php'); 
    }

    public function working_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Get_working_list($_SESSION['id_user']);
            require_once('views/tuteurs/working_list.php');
             
        }
        else
            require_once('views/login.php'); 
    }

    public function wish_list()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Get_wish_list($_SESSION['id_user']);
            require_once('views/tuteurs/wish_list.php');
             
        }
        else
            require_once('views/login.php'); 
    }
    public function cancel_wish()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Cancel_wish($_SESSION['id_user'],$_POST['id_u']);
             require_once('views/tuteurs/interface_selection_tutores_tuteurs.php');
        }
        else
            require_once('views/login.php'); 
    }

    public function update_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $donnees = Users::Get_info($_SESSION['id_user']);    // on récupère les info des user
            require_once('views/update_account.php');
        }
        else
            require_once('views/login.php');
    }
    public function modify_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $tuteurs = new Users();
            $tuteurs->setVille($_POST['ville']);
            $tuteurs->setAdress($_POST['adresse']);
            $tuteurs->setCom_adress($_POST['complement_adresse']);
            $tuteurs->setCode_postal($_POST['code_postal']);
            $tuteurs->setPassword($_POST['password']);

            $tuteurs->Modify_info($_SESSION['id_user']);    // on update les infos du user
            require_once('views/tuteurs/interface_tuteur.php');
        }
        else
            require_once('views/login.php');
    }
    public function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                require_once('views/contacter.php');
            else
                require_once('views/login.php');
        }

}
?>