<?php
//namespace Blog;

require_once('controllers/HomeController.php');
require_once('controllers/PostsController.php');
require_once('controllers/UsersController.php');
require_once('controllers/CommentsController.php');
require_once('controllers/AdminController.php');
require_once('controllers/SessionController.php');

class Route {

    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct($path, $callable){
        $this->path = $path;  // On retire les / inutils
        $this->callable = $callable;
    }

    /**
    * Permettra de capturer l'url avec les paramètre
    * get('/posts/:slug-:id') par exemple
    **/
    public function match($url)
    {
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    private function paramMatch($match)
     {
         if(isset($this->params[$match[1]]))
         {
             return '(' . $this->params[$match[1]] . ')';
         }
         return '([^/]+)';
     }

    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this; // On retourne tjrs l'objet pour enchainer les arguments
    }


    public function getUrl($params)
    {
        $path = $this->path;

        foreach($params as $k => $v)
        {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }

    public function call(){

        if(is_string($this->callable))
        {
            $params = explode('#', $this->callable);
            $controller = $params[0] . "Controller";
            $action = $params[1];
            $controller = new $controller();

            return call_user_func_array([$controller, $params[1]], $this->matches);

        } else {

            return call_user_func_array($this->callable, $this->matches);
        }

    }
}
