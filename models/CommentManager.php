<?php
require_once('models/Manager.php');

class CommentManager extends Manager
{
  public function getComments($postId)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
  }

  public function postComment($postId, $author, $comment)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
  }

  public function getComment($id)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, post_id, author, comment, comment_date FROM comments WHERE id = ?');
    $req->execute(array($id));
    $comment = $req->fetch();

    return $comment;
  }

  public function updateComment($id, $comment)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
    $newComment = $req->execute(array($comment, $id));

    return $newComment;
  }
}
