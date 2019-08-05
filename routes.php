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
      case 'tutores':
        $controller = new TutoresController();
        break;
      case 'tutorat':
        $controller = new TutoratController();
        break;
      case 'admin':
        $controller = new AdminController();
        break;
      case 'evenements':
       $controller = new EvenementsController();
        break;
    }
    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'users' => ['login','inscription','save_user','connexion','deconnexion','resetPassword','forgotPassword', 'choixStatut','update_account','modify_account','redirection'],
                       'page'=>['home','contact'],

                       'tuteurs'=>['interface_tuteur','tuteur_set_event','selection_tutores','tutores_list','notifications','waiting_list','link','accept_link','delete_link','working_list','wish_list','cancel_wish','contact','message'],

                       'tutores'=>['interface_tutore','selection_tuteurs','tuteurs_list','notifications','waiting_list','link','accept_link','working_list','wish_list','cancel_wish','validate_hours','contact','message'],

                       'admin'=>['interface_admin','interface_admin_tuteur','admin_set_event','tuteurs_list','tutores_list','interface_tutores_mef','sign_up','choose_tuteur','interface_tutorat_mef','create_center','tutorat_center_list','validate_hours','show_informations','link','pasts_events_list','future_events_list'],
                       'tutorat'=>['create_center'],

                       'evenements' =>['admin_set_event','tuteur_set_event','cancel_participation','display_pasts_events','display_future_events','display_subscribed_events','subscribe_to_event','pasts_events','subscription_list']);
  if (array_key_exists($controller, $controllers))
  {
    if (in_array($action, $controllers[$controller])) 
    {
      call($controller, $action);
    }
     else 
    {
      session_destroy();
      
      $message= 'action  introuvable';
      $error_msg = "La page que vous cherchez n'existe pas !";
      require_once('views/system/error.php');
    }
  }
   else 
  {   
      session_destroy();
      
      $message= 'controller introuvable';
      $error_msg = "La page que vous cherchez n'existe pas !";
      require_once('views/system/error.php');
  }

  
  
  

?>