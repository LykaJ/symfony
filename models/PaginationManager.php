<?php
require_once('models/Manager.php');
/**
 *
 */
class PaginationManager extends Manager
{

    public function countArticles()
    {
        $db = $this->dbConnect();
        $articles = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id, title, content, author FROM posts LIMIT {$start} , {$perPage}");
        $articles->execute();

        $articles = $articles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pageTotal()
    {
        $db = $this->dbConnect();
        $total = $db->query("SELECT FOUND_ROWS() AS total")->fetch()['total'];
    }
}
