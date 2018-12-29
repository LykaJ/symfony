<?php

require_once('Manager.php');

class UserRightManager extends Manager
{
  public function can($action)
  {
      if (isset($_SESSION['current_user'])) {
          $db = $this->dbConnect();
          $req = $db->prepare('SELECT COUNT(*) FROM rights INNER JOIN profiles_rights ON rights.id = profiles_rights.right_id WHERE profiles_rights.profile_id = ? AND description = ?');
          $req->execute(array($_SESSION['current_user']['profile_id'], $action));
          $res = $req->fetchColumn();

          $req->closeCursor();

          return $res > 0;
      } else {
        return false;
      }
  }
}
