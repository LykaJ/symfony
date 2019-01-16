<?php
require_once('models/Manager.php');
class UserManager extends Manager
{
    public function getUser($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ? LIMIT 1');
        $userCredentials = $req->execute(array($pseudo));
        $res = $req->fetch();
        $req->closeCursor();
        return $res;
    }

    public function getNewUsers()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE profile_id = 4');
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addUser($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(pseudo, password, email, signup_date, login_date, profile_id) VALUES (?, ?, ?, NOW(), NOW(), ?)');
        $newUser = $req->execute(array($pseudo, $password, $email, 4));
        return $newUser;
    }

    public function updateUser($password, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET password = ?, email = ?, login_date = NOW() WHERE id = ?');
        $updatedUser = $req->execute(array($password, $email));
        return $updatedUser;
    }

    public function deleteUser($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM users WHERE id = ?');
        $deletedUser = $req->execute(array($id));
        return $deleteUser;
    }

    public function profileUser($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET profile_id = ? WHERE id = ?');
        $profileUser = $req->execute(array($id));
        return $profileUser;
    }
}
