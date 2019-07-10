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
    }
    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'users' => ['login', 'inscription', 'save_user','connexion'],
                       'page'=>['home'],
                       'tuteurs'=>['Set_event','Display_pasts_events', 'Display_future_events','Display_validated_events']);
//try
//{
  if(isset($_GET['action']) )
  {
    if($_GET['action'] == 'save_user' )
    { 
        call('users','save_user');
    }
    elseif ($_GET['action'] == 'connexion')
    {
       call('users','connexion');  
    }
    else // on le laisse sur la page d'accueil
    {
      require_once('index.php'); 
    }
   }
  
  else
  {
    require_once('index.php');
  }
  /*
}
catch(Exception $e) { 
     // S'il y a eu une erreur, alors...
     $errorMessage = $e->getMessage();
    require('views/system/error.php');
}
  

  if (array_key_exists($controller, $controllers))
  {
    if (in_array($action, $controllers[$controller])) 
    {
      call($controller, $action);
    }
     else 
    {
      $error_msg = "La page que vous cherchez n'existe pas !";
      //require_once('views/system/error.php');
    }
  }
   else 
  {
    $error_msg = "La page que vous cherchez n'existe pas !";
    //require_once('views/system/error.php');
  }
  */

?>