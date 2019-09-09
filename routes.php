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
      case 'superadmin':
        $controller = new SuperadminController();
        break;
      case 'evenements':
       $controller = new EvenementsController();
        break;
    }
    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'users' => ['login','inscription','save_user','connexion','deconnexion','resetPassword','forgotPassword', 'choixStatut','update_account','modify_account','profil','claim_hours','create_account','redirection'],
                       'page'=>['home','contact'],

                       'tuteurs'=>['interface_tuteur','tuteur_set_event','events_creation','selection_tutores','tutores_list','notifications','waiting_list','link','accept_link','delete_link','working_list','wish_list','cancel_wish','contact','message','show_proposal','accept_proposal'],

                       'tutores'=>['interface_tutore','selection_tuteurs','tuteurs_list','notifications','waiting_list','link','accept_link','working_list','wish_list','cancel_wish','validate_hours','contact','message'],

                       'admin'=>['interface_admin','interface_admin_tuteur','admin_set_event','tuteurs_list','tutores_list','interface_tutores_mef','sign_up','choose_tuteur','interface_tutorat','create_center','tutorat_center_list','validate_hours','declare_hours','declared_hours','interface_hours','show_informations','link','events','pasts_events_list','future_events_list','modify_event','interface_selection','Sfuture_events_list','selected_tuteurs','Schoose_tuteur','show_all_proposal','cancel_proposal','end_contract','export','state_tuteurs','state_tutores','contact','message'],
                       'tutorat'=>['create_center','create_type_center','delete_tutorat','delete_typeTutorat','remove_tutorat','account_affectation'],

                       'superadmin'=>['interface_superadmin','interface_tuteur','interface_tutore','interface_hours','interface_tutorat','interface_account_creation','interface_hours','tutores_list','tutores_belonging_list','tutores_participation_list','tuteurs_list','tuteurs_belonging_list','tuteurs_participation_list','interface_set_event','set_event','events','future_events_list','pasts_events_list','future_subscription_list','pasts_subscription_list','modify_event','show_informations','create_center','create_type_center','create_account','tutorat_center_list','typeTutorat_center_list','admin_tutorat_list','account_affectation','static_account','working_account','show_associated_tutorat','validated_hours','validatedHours_history','paidHours_history','paid_hours','message','contact'],

                       'evenements'=>['admin_set_event','tuteur_set_event','superadmin_set_event','declare_hours','cancel_participation','display_pasts_events','display_future_events','display_subscribed_events','subscribe_to_event','modify_event','subscription_list','Ssubscription_list','global_research']);
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