<?php

class Router
{
    private $_url = [];
    private $_method = [];


    public function add($url, $method = NULL)
    {
        $this->_url[] = trim($url);

        if($method != null)
        {
            $this->_method = $method;
        }
    }

    public function submit()
    {
        echo $urlGetParam = isset($_GET['url']);

        foreach($this->_url as $key => $value)
        {

            if(preg_match("#^$value$#", $urlGetParam))
            {

                if(is_string($this->_method[$key]))
                {
                    $useMethod = $this->_method[$key];
                    return $useMethod;

                } else {
                    call_user_func($this->_method[$key]);
                }

            }

        }
    }
}
