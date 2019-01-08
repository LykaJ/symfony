<?php

$db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'admin', 'admin32');

//USER input

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per_page']) && $_GET['per_page'] <= 50 ? (int)$_GET['per_page'] : 5;

//Positionning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

//query

$articles = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id, title, content, author FROM posts LIMIT {$start} , {$perPage}");
$articles->execute();

$articles = $articles->fetchAll(PDO::FETCH_ASSOC);

//Pages
$total = $db->query("SELECT FOUND_ROWS() AS total")->fetch()['total'];
$pages = ceil($total/$perPage);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Articles</title>
    </head>
    <body>
        <?php foreach($articles as $article): ?>
            <div class="article">
                <p><?php echo $article['title']; ?></p>
            </div>
        <?php endforeach; ?>

        <div class="pagination">
            <?php for($x = 1; $x <= $pages; $x++): ?>
                <a href="?page=<?php echo $x; ?>&amp;perPage=<?php echo $perPage; ?>"<?php if($page === $x) {echo "class:'selected'";} ?>> <?php echo $x; ?> </a>
            <?php endfor; ?>
        </div>
    </body>
</html>
