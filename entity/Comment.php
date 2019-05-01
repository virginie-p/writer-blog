<?php
namespace App\entity;

class Comment extends Entity {
    protected   $errors = [],
                $id,
                $chapter_id,
                $user_id,
                $title,
                $content,
                $creation_date, 
                $moderation_status;

    /**
     * Constants for errors management during the execution of the method
     */
    const INCORRECT_TITLE = 1;

    /**GETTERS */

    public function errors() {
        return $this->errors;
    }

    public function id() {
        return $this->id;
    }

    public function chapterId() {
        return $this->chapter_id;
    }

    public function userId() {
        return $this->user_id;
    }

    public function title() {
        return $this->title;
    }

    public function content() {
        return $this->content;
    }

    public function creationDate() {
        return $this->creation_date;
    }

    public function moderationStatus() {
        return $this->moderation_status;
    }

    /**SETTERS */
    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setChapterId($chapter_id) {
        $this->chapter_id = (int) $chapter_id;
    }

    public function setUserId($user_id) {
        $this->user_id = (int) $user_id;
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

    public function setCreationDate($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function setModerationStatus($moderation_status) {
        $this->moderation_status = (int) $moderation_status;
    }

}