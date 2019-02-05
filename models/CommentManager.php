<?php
namespace Blog\models;

require_once('models/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $comments = $this->db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $userId, $comment)
    {
        $comments = $this->db->prepare('INSERT INTO comments(post_id, author, user_id, comment, comment_date, status) VALUES(?, ?, ?, ?, NOW(), NULL)');
        $affectedLines = $comments->execute(array($postId, $author, $userId, $comment));

        return $affectedLines;
    }

    public function getComment($id)
    {
        $req = $this->db->prepare('SELECT * FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();

        return $comment;
    }

    public function updateComment($id, $comment)
    {
        $req = $this->db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $newComment = $req->execute(array($comment, $id));

        return $newComment;
    }

    public function updateCommentStatus($id)
    {
        $req = $this->db->prepare('UPDATE comments SET status = 1 WHERE id = ?');
        $newStatus = $req->execute(array($id));

        return $newStatus;
    }

    public function deleteComment($id)
    {
        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $req->execute(array($id));
        return $deletedComment;
    }
}
