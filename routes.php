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
    }
    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(
                       'users' => ['login', 'inscription', 'save_user'],
                       'page'=>['home']);

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
?>