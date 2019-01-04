<?php
require_once('models/Manager.php');
/**
 *
 */
class PaginationManager extends Manager
{


    public function countPosts($allPosts)
    {
        $db = $this->dbConnect();
        $allPosts = $db->prepare('SELECT COUNT(*) FROM posts');
        $allPosts->execute();

        $allPosts = $allPosts->fetchAll(PDO::FETCH_ASSOC);
    }



}
