<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/superadmin.php');
require_once('models/tutorat.php');





/* Définition du controller */
class SuperadminController
{

     public function interface_superadmin()
       {
            if( isset($_SESSION['id_statut']))
            {
                require_once('views/superadmin/interface_superadmin.php');
            }
            else
                require_once('views/login.php');
       }
     public function interface_tutore()
     {
           if( isset($_SESSION['id_statut']))
            {
                require_once('views/superadmin/interface_tutore.php');
            }
            else
                require_once('views/login.php');
     }
     public function interface_tuteur()
     {
           if( isset($_SESSION['id_statut']))
            {
                require_once('views/superadmin/interface_tuteur.php');
            }
            else
                require_once('views/login.php');
     } 
      
public static function export()
{
  $donnees = Evenements::Future_events_list($_SESSION['id_user']);
  
  require_once('controllers/PHPExcel-1.8/exportTutorat/exportData-xlsx.php');
}
    
 public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_contact_admin($_SESSION['id_user']);
                    require_once('views/contacter.php');
                }
            else
                require_once('views/login.php');
        }
  public function message() // à completer lors de la création de la table de suivi des admin
      {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    

                require ('PHPMailer/PHPMailerAutoload.php');
                require ('connectToMail.php');

                $contacter= true;
                $nom= $_SESSION['nom']; 
                $prenom= $_SESSION['prenom'];
                
                $login_mail=  $_POST['email']; // adresse réceptrice( l'administrateur )
                //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
                $message_txt = $_POST['message'];
                
                
                $message_html = $_POST['message'];
                //Sujet
                $sujet = "[Yncrea tutorat] Message plateforme Yncrea tutorat de: ".$nom." ".$prenom." ";
                // on envoie un email de confirmation
                include('send_mail.php');
                TutoresController::contact();
        }
        else
                require_once('views/login.php');
      }   


}