<?php

require_once('models/Manager.php');

class CommentManager extends Manager
{
  public function getComments($postId)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;

  }

  public function postComment($postId, $author, $userId, $comment)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, user_id, comment, comment_date, status) VALUES(?, ?, ?, ?, NOW(), NULL)');
    $affectedLines = $comments->execute(array($postId, $author, $userId, $comment));

    return $affectedLines;
  }

  public function getComment($id)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM comments WHERE id = ?');
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

  public function updateCommentStatus($id)
  {
      $db = $this->dbConnect();
      $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = ?');
      $newStatus = $req->execute(array($id));

      return $newStatus;
  }

  public function deleteComment($id)
  {
      $db = $this->dbConnect();
      $req = $db->prepare('DELETE FROM comments WHERE id = ?');
      $deletedComment = $req->execute(array($id));
      return $deletedComment;
  }
}
