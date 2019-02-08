<?php
namespace Blog\models;

class User
{
    private $_errors = [];
    private $_pseudo;
    private $_password;
    private $_signUpDate;
    private $_loginDate;

    //doit-on utiliser une variable profile ici ? ou créer une nouvelle classe?

    const PSEUDO_INVALIDE = 1;
    const PASSWORD_INVALIDE = 2;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //SETTERS

    public function setPseudo($pseudo)
    {
        if (!is_string($pseudo) || empty($pseudo)) {
            $this->_errors[] = self::PSEUDO_INVALIDE;
        } else {
            $this->_pseudo = $pseudo;
        }
    }

    public function setPass($password)
    {
        if (!is_string($password) || empty($password)) {
            $this->_errors[] = self::PASSWORD_INVALIDE;
        } else {
            $this->_password = $password;
        }
    }

    public function setsignUpDate(Datetime $signUpDate)
    {
        $this->_signUpDate = $signUpDate;
    }

    public function setloginDate(DateTime $loginDate)
    {
        $this->_loginDate = $loginDate;
    }

    //GETTERS

    public function errors()
    {
        return $this->_errors;
    }

    public function pseudo()
    {
        return $this->_pseudo;
    }

    public function password()
    {
        return $this->_password;
    }

    public function datesignUpDate()
    {
        return $this->_dateloginDate;
    }

    public function dateloginDate()
    {
        return $this->_dateEdition;
    }
}
