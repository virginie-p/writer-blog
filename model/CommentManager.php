<?php 
namespace App\model;
use App\entity\Comment;
use \PDO;

class CommentManager extends Manager {

    public function getComments($chapter_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT 
                                comments.id, 
                                user_id,
                                users.username,
                                users.profile_picture,
                                comments.title, 
                                comments.content, 
                                DATE_FORMAT(comments.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
                                moderation_status
                            FROM projet_4_comments AS comments
                            INNER JOIN 
                                projet_4_users AS users ON users.id = comments.user_id
                            INNER JOIN 
                                projet_4_chapters AS chapters ON chapters.id = comments.chapter_id
                            WHERE chapter_id = ?
                            ORDER BY moderation_status = 1 DESC, id ASC'
                            );

        $req->execute(array($chapter_id));
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Comment');
        $comments = $req->fetchAll();

        return $comments;    
    }

    public function getChapterComments($chapter_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT 
                                comments.id, 
                                user_id,
                                users.username,
                                users.profile_picture,
                                comments.title, 
                                comments.content, 
                                DATE_FORMAT(comments.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
                                moderation_status
                            FROM projet_4_comments AS comments
                            INNER JOIN 
                                projet_4_users AS users ON users.id = comments.user_id
                            INNER JOIN 
                                projet_4_chapters AS chapters ON chapters.id = comments.chapter_id
                            WHERE chapter_id = ?
                            ORDER BY id DESC'
                            );

        $req->execute(array($chapter_id));
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Comment');
        $comments = $req->fetchAll();

        return $comments;    
    }

    public function getComment($comment_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT 
                                comments.id, 
                                user_id,
                                chapter_id,
                                users.username,
                                chapters.title,
                                comments.title, 
                                comments.content, 
                                comments.creation_date, 
                                moderation_status 
                            FROM projet_4_comments AS comments
                            INNER JOIN 
                                projet_4_users AS users ON users.id = comments.user_id
                            INNER JOIN 
                                projet_4_chapters AS chapters ON chapters.id = comments.chapter_id
                            WHERE comments.id = ?');

        $req->execute(array($comment_id));
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Comment');
        $comment = $req->fetch();

        return $comment;
    }

    public function createComment(Comment $comment) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('INSERT INTO projet_4_comments
                                        (chapter_id, 
                                        user_id, 
                                        title, 
                                        content, 
                                        creation_date, 
                                        moderation_status) 
                            VALUES (:chapter_id,
                                    :user_id,
                                    :title,
                                    :content,
                                    NOW(),
                                    0)'
                            );

        $affected_lines = $req->execute(array(
            'chapter_id' => $comment->chapterId(),
            'user_id' => $comment->userId(),
            'title' => $comment->title(),
            'content' => $comment->content()
        ));

        return $affected_lines;
    }

    public function changeModerationStatus($moderation_status, $id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('UPDATE projet_4_comments SET moderation_status = :moderation_status WHERE id = :id');

        $affected_line = $req->execute(array(
            'moderation_status' => $moderation_status,
            'id' => $id
        ));
        
        return $affected_line;
    }

    public function deleteComment($comment_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('DELETE FROM projet_4_comments WHERE id = ?');

        $affected_lines = $req->execute(array($comment_id));

        return $affected_lines;
    }

}