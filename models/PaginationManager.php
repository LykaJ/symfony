<?php
require_once('models/Manager.php');
/**
 *
 */
class PaginationManager extends Manager
{


    public function countPosts($posts)
    {
        $start = ($page > 1) ? ($page * $perPage) : $perPage : 0;

        $db = $this->dbConnect();
        $posts = $db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM posts LIMIT :start, :perPage');
        $posts->execute();

        $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPages($total)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT FOUND_ROWS AS total');
        $total = $req->fetch()['total'];
    }

}
