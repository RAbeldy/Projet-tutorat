<?php
require_once('models/tuteurs.php');
require_once('models/tutores.php');
require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');

/* Définition du controller */
class AdminController
{

     public function interface_admin()
       {
            if( isset($_SESSION['id_statut']))
                require_once('views/admin/interface_admin.php');
            else
                require_once('views/login.php');
       }
      public function interface_admin_tuteur()
       {
            if( isset($_SESSION['id_statut']))
                require_once('views/admin/interface_admin_tuteur.php');
            else
                require_once('views/login.php');
       }
     

       
}