<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'page':
        $controller = new PageController();  
        break;
      case 'users':
        $controller = new UsersController();
        break;
      case 'tuteurs':
        $controller = new TuteursController();
        break;
      case 'evenements':
       $controller = new EvenementsController();
        break;
    }
    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'users' => ['login', 'inscription', 'save_user','connexion','deconnexion','resetPassword','forgotPassword'],
                       'page'=>['home'],
                       'tuteurs'=>['interface_tuteur','tuteur_set_event','selection_tutores','tutores_list','notifications','waiting_list','link','accept_link','delete_link','working_list','wish_list','cancel_wish','update_account','modify_account'],
                       'evenements' =>['set_event','cancel_participation','display_pasts_events','display_future_events','display_subscribed_events','subscribe_to_event','subscription_list']);
  if (array_key_exists($controller, $controllers))
  {
    if (in_array($action, $controllers[$controller])) 
    {
      call($controller, $action);
    }
     else 
    {
      echo "action introuvable".$_POST['id_e'];
      $message= 'action  introuvable';
      $error_msg = "La page que vous cherchez n'existe pas !";
      require_once('views/system/error.php');
    }
  }
   else 
  {
      echo "controller introuvable".$_POST['id_e'];
      $message= 'controller introuvable';
      $error_msg = "La page que vous cherchez n'existe pas !";
      require_once('views/system/error.php');
  }

  
  
  

?>