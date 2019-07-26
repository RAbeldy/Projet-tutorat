<?php
require_once('models/tuteurs.php');
require_once('models/tutores.php');
require_once('models/evenements.php');
require_once('models/users.php');
/* Définition du controller */
class TutoresController
{

     public function interface_tutore()
       {
            if( isset($_SESSION['id_statut']))
                require_once('views/tutores/interface_tutore.php');
            else
                require_once('views/login.php');
       }
     public function selection_tuteurs()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                require_once('views/tutores/interface_selection_tuteurs_tutores.php'); // on charge la vue adéquate
            else
                require_once('views/login.php');
        }
     public function tuteurs_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {
                $tuteurs= new Tutores();
                $donnees= $tuteurs->Get_all_tuteurs();
                require_once('views/tutores/tuteurs_list.php');
            }
            else
                require_once('views/login.php');  
        }
     public function notifications()
        {
            if( isset($_SESSION['id_statut']))
                require_once('views/tutores/notifications_tutores.php');
            else
                require_once('views/login.php');
        }
     public function waiting_list()  // on récuprère la lsite des 
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {   
                $tuteurs= new Tutores();
                $donnees= $tuteurs->Get_waiting_list($_SESSION['id_user']);
                require_once('views/tutores/waiting_list.php');
            }
            else
                require_once('views/login.php'); 

        }
     public function link() // action de se lier à un tuteur ou un tutoré
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {   
                 $tuteurs= new Tutores();
                 $tuteurs->Link_with_tuteurs($_SESSION['id_user'],$_POST['id_u']);
                require_once('views/tutores/notifications_tutores.php');   
            }
            else
                require_once('views/login.php'); 
        }
     public function accept_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tuteurs= new Tutores();
                 $tuteurs->Accept_link($_SESSION['id_user'],$_POST['id_u']);
                require_once('views/tutores/notifications_tutores.php');  
            }
            else
                require_once('views/login.php'); 
        }
        
        /*
        public function delete_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tuteurs= new Tutores();
                 $tuteurs->Delete_link($_POST['id_u']);
                require_once('views/tutores/notifications_tuteurs.php');
                 
            }
            else
                require_once('views/login.php'); 
        }
        */
     public function working_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 $donnees=$tuteurs->Get_working_list($_SESSION['id_user']);

                 $controller_report='tutores';
                 $fonction_back='selection_tuteurs';
            
                require_once('views/tutores/working_list.php');
            }
            else
                require_once('views/login.php'); 
        }

     public function wish_list()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 $donnees=$tuteurs->Get_wish_list($_SESSION['id_user']);
                 require_once('views/tutores/wish_list.php');  
            }
            else
                require_once('views/login.php'); 
        }
     public function cancel_wish()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 $donnees=$tuteurs->Cancel_wish($_SESSION['id_user'],$_POST['id_u']);
                 require_once('views/tutores/interface_selection_tuteurs_tutores.php');
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
                require_once('views/tutores/interface_tutore.php');
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