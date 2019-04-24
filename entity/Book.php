<?php
namespace App\entity;

class Book extends Entity {

    protected   $errors=[],
                $id,
                $author_id,
                $title,
                $subtitle,
                $book_cover_image,
                $creation_date,
                $modification_date;
    
    /**
     * Constants for errors management during the execution of the method
     */
    const INCORRECT_IMAGE_LINK = 1;
    const INCORRECT_TITLE = 2;
    const INCORRECT_SUBTITLE = 3;

    /**
     * GETTERS
     */
    public function errors() {
        return $this->errors;
    }

    public function id() {
        return $this->id;
    }

    public function authorId() {
        return $this->author_id;
    }

    public function title() {
        return $this->title;
    }

    public function subtitle() {
        return $this->subtitle;
    }

    public function bookCoverImage() {
        return $this->book_cover_image;
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

    public function setAuthorId($author_id) {
        $this->author_id = (int) $author_id;
    }

    public function setTitle($title) {
        if(!is_string($title) || empty($title)) {
            $this->errors[] = self::INCORRECT_TITLE;
        }
        else {
            $this->title = $title;
        }
    }

    public function setSubtitle($subtitle) {
        if(!is_string($subtitle) || empty($subtitle)) {
            $this->errors[] = self::INCORRECT_SUBTITLE;
        }
        else {
            $this->subtitle = $subtitle;
        }
    }

    public function setBookCoverImage($image_link) {
        if (!is_string($image_link) || empty($image_link)) {
            $this->errors[] = self::INCORRECT_IMAGE_LINK;
        }
        else {
            $this->book_cover_image = $image_link;
        }
    }

    public function setCreationDate($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function setModificationDate($modification_date) {
        $this->modification_date = $modification_date;
    }
    
}