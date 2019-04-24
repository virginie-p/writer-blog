<?php 
namespace App\model;
use App\entity\Book;
use \PDO;

class BookManager extends Manager {

    public function getBooks() {
        $db = $this->MySQLConnect();
        $req = $db->query(
            'SELECT books.id, 
            author_id, 
            firstname, 
            lastname, 
            title,
            DATE_FORMAT(books.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
            DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date
            FROM projet_4_books AS books
            INNER JOIN projet_4_users 
            ON books.author_id = projet_4_users.id
            ORDER BY books.id'
        );

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Book');

        $books = $req->fetchAll();

        return $books;
    }

    public function getBook($book_id) {
        $db = $this->MySQLConnect(); 
        $req = $db->prepare(
            'SELECT books.id,
            author_id,
            firstname, 
            lastname, 
            profile_picture, 
            birthdate, 
            description,  
            title, 
            subtitle, 
            book_cover_image, 
            DATE_FORMAT(books.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, 
            DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date
            FROM projet_4_books AS books
            INNER JOIN projet_4_users 
            ON books.author_id = projet_4_users.id 
            WHERE books.id = ?');
        
        $req->execute(array($book_id));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Book');

        $book = $req->fetch();

        return $book;
    }

    public function createBook(Book $book) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('INSERT INTO projet_4_books(author_id, title, subtitle, book_cover_image, creation_date, modification_date)
        VALUES (:author_id, :title, :subtitle, :book_cover_image, NOW(), NOW())');

        $affected_lines = $req->execute(array(
            'author_id' => $book->authorId(),
            'title' => $book->title(),
            'subtitle' => $book->subtitle(),
            'book_cover_image' => $book->bookCoverImage()
        ));

        return $affected_lines;
    }

    public function editBook(Book $book) {
        $db = $this->MySQLConnect();

        if (empty($book->bookCoverImage())) {
            $req= $db->prepare(
                'UPDATE projet_4_books
                SET author_id = :author_id,
                title = :title,
                subtitle = :subtitle,
                modification_date = NOW()
                WHERE id = :id');

            $affected_lines =  $req->execute(array(
                'author_id' => $book->authorId(),
                'title' => $book->title(),
                'subtitle' => $book->subtitle(),
                'id' => $book->id()
            ));
        } else {
            $req= $db->prepare(
                'UPDATE projet_4_books
                SET author_id = :author_id,
                title = :title,
                subtitle = :subtitle,
                book_cover_image = :book_cover_image,
                modification_date = NOW()
                WHERE id = :id');

            $affected_lines =  $req->execute(array(
                'author_id' => $book->authorId(),
                'title' => $book->title(),
                'subtitle' => $book->subtitle(),
                'book_cover_image' => $book->bookCoverImage(),
                'id' => $book->id()
            ));
        }
        
        return $affected_lines;
    }

    public function deleteBook($book_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('DELETE FROM projet_4_books WHERE id = ?');
        
        $affected_lines = $req->execute(array($book_id));

        return $affected_lines;
    }
    

}