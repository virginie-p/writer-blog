<?php
namespace App\entity;

class Chapter extends Entity {
    protected   $errors = [],
                $id,
                $book_id,
                $title,
                $content,
                $image,
                $creation_date,
                $modification_date;
    
    /**
     * Constants for errors management during the execution of the method
     */
    const INCORRECT_IMAGE_LINK = 1;
    const INCORRECT_TITLE = 2;

    /**
     * GETTERS
     */
    public function errors() {
        return $this->errors;
    }

    public function id() {
        return $this->id;
    }

    public function bookId() {
        return $this->book_id;
    }

    public function title() {
        return $this->title;
    }

    public function content() {
        return $this->content;
    }

    public function image() {
        return $this->image;
    }

    public function creationDate() {
        return $this->creation_date;
    }

    public function modificationDate() {
        return $this->modification_date;
    }

    /**
     * SETTERS
     */
    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setBookId($book_id) {
        $this->book_id = (int) $book_id;
    }

    public function setTitle($title) {
        if(!is_string($title) || empty($title)) {
            $this->errors[] = self::INCORRECT_TITLE;
        }
        else {
            $this->title = $title;
        }
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setImage($image_link) {
        if (!is_string($image_link) || empty($image_link)) {
            $this->errors[] = self::INCORRECT_IMAGE_LINK;
        }
        else {
            $this->image = $image_link;
        }
    }

    public function setCreationDate($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function setModificationDate($modification_date) {
        $this->modification_date = $modification_date;
    }
}