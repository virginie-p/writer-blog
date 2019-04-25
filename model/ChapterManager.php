<?php 
namespace App\model;
use App\entity\Chapter;
use \PDO;

class ChapterManager extends Manager {

    public function getChapters($book_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare(
            'SELECT chapters.id,
            book_id,
            chapters.title,
            content,
            image,
            DATE_FORMAT(chapters.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
            DATE_FORMAT(chapters.modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date
            FROM projet_4_chapters AS chapters
            INNER JOIN projet_4_books
            ON chapters.book_id = projet_4_books.id
            WHERE book_id = ?
            ORDER BY chapters.id'
        );
        
        $req->execute(array($book_id));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Chapter');

        $chapters = $req->fetchAll();

        return $chapters;    
    }

    public function getLatestChapters() {
        $db = $this->MySQLConnect();
        $req = $db->query(
            'SELECT chapters.id,
            book_id,
            books.title AS book_title,
            chapters.title,
            content,
            image,
            DATE_FORMAT(chapters.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
            DATE_FORMAT(chapters.modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date
            FROM projet_4_chapters AS chapters
            INNER JOIN projet_4_books AS books
            ON chapters.book_id = books.id
            ORDER BY chapters.id DESC
            LIMIT 6'
        );

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Chapter');

        $chapters = $req->fetchAll();

        return $chapters;    
    }

    public function getChapter($chapter_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare(
            'SELECT chapters.id,
            book_id,
            chapters.title,
            content,
            image,
            DATE_FORMAT(chapters.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
            DATE_FORMAT(chapters.modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date
            FROM projet_4_chapters AS chapters
            INNER JOIN projet_4_books
            ON chapters.book_id = projet_4_books.id
            WHERE chapters.id = ?
            ORDER BY chapters.id'
        );

        $req->execute(array($chapter_id));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Chapter');

        $chapter = $req->fetch();

        return $chapter;  
    }

    public function editChapter(Chapter $chapter) {
        $db= $this->MySQLConnect();

        if(empty($chapter->image())) {
            $req = $db->prepare(
                'UPDATE projet_4_chapters
                SET title = :title,
                content = :content,
                modification_date = NOW()
                WHERE id = :id'
            );

            $affected_lines = $req->execute(array(
                'title' => $chapter->title(),
                'content' => $chapter->content(),
                'id' => $chapter->id()
            ));
        } else {
            $req = $db->prepare(
                'UPDATE projet_4_chapters
                SET title = :title,
                content = :content,
                image = :image,
                modification_date = NOW()
                WHERE id = :id'
            );

            $affected_lines = $req->execute(array(
                'title' => $chapter->title(),
                'content' => $chapter->content(),
                'image' => $chapter->image(),
                'id' => $chapter->id()
            ));
        }

        return $affected_lines;
    }

    public function createChapter(Chapter $chapter) {
        $db = $this->MySQLConnect();
        $req = $db->prepare(
            'INSERT INTO projet_4_chapters
                (book_id,
                title,
                content,
                image,
                creation_date,
                modification_date)
            VALUES (:book_id,
                    :title,
                    :content,
                    :image,
                    NOW(),
                    NOW())'
        );

        $affected_lines = $req->execute(array(
            'book_id' => $chapter->bookId(),
            'title' => $chapter->title(),
            'content' => $chapter->content(),
            'image' => $chapter->image()
        ));

        return $affected_lines;
    }

    public function deleteChapter($chapter_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('DELETE FROM projet_4_chapters WHERE id = ?');

        $affected_lines = $req->execute(array($chapter_id));

        return $affected_lines;
    }
}