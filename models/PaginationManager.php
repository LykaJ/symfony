<?php
namespace Blog\models;

require_once('models/Manager.php');
/**
 *
 */
class PaginationManager extends Manager
{
    public function countArticles($totalPages)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id, title, content, author FROM posts LIMIT :start , :perPage");
        $articles = $req->execute();

        $articles->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }

    public function pageTotal()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT FOUND_ROWS() AS total")->fetch()['total'];
        $total = $req->execute();

        return $req;
    }
}
