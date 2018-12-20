<?php

require_once('models/Manager.php');


class UserManager extends Manager
{
    public function getUser($pseudo, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, password FROM users WHERE id = ?');
        $userCredentials = $req->execute(array($pseudo, $password));

        return $userCredentials;
    }

    public function addUser($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(pseudo, password, email, signup_date) VALUES (?, ?, ?, NOW())');
        $newUser = $req->execute(array($pseudo, $password, $email));

        return $newUser;
    }

    public function updateUser($password, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET password = ?, email = ?, login_date = NOW() WHERE id = ?');
        $updatedUser = $req->execute(array($password, $email));

        return $updatedUser;
    }
}
