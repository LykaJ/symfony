<?php

class Router
{
  public function routerReq()
  {
    try {
      spl_autoload_register(function($class)
      {
        require_once('models/' .$class. '.php');
      });

  /*    //LE CONTROLLER EST INCLUS SELON L'ACTION DE L'UTILISATEUR
      if(isset($_GET['uril']))
      {
        $url = explode('/', filter_var($_GET['url'], FILTER_SANTITIZE_URL));

        $controller = ucfirst(strtolower($url[0]));
        $controllerClass = "Controller" .$controller;
        $controllerFile = "controllers/" .$controllerClass. ".php";

        if(file_exists($controllerFile))
        {
          require_once($controllerFile);
          $this->_ctrl = new $controllerClass($url);
        }
        else {
          throw new Exception('Page introuvable');
        }
      }
      else
      {
        require_once('controllers/ControllerHome.php');
        $this->_ctrl = new ControllerHome($url);
      } */


      //GESTION ERREURS
    } catch (\Exception $e) {
      $errorMsg = $e->getMessage();
      require_once('view/viewError.php');
    }

  }
}
