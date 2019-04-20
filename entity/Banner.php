<?php
namespace App\entity;
/**
 * This class represents a banner that will be displayed on the homepage of the FrontEnd
 */
class Banner extends Entity
{
    protected   $errors=[],
                $id,
                $display_order,
                $title,
                $caption,
                $image,
                $button_title,
                $button_link,
                $creation_date,
                $modification_date;

    /**
     * Constants for errors management during the execution of the method
     */
    const INCORRECT_IMAGE_LINK = 1;
    const INCORRECT_TITLE = 2;
    const INCORRECT_CAPTION = 3;


    /**
     * GETTERS
     */
    public function erreurs()
    {
        return $this->erreurs;
    }
    
    public function id()
    {
        return $this->id;
    }

    public function displayOrder()
    {
        return $this->display_order;
    }

    public function title()
    {
        return $this->title;
    }

    public function caption()
    {
        return $this->caption;
    }

    public function image() 
    {
        return $this->image;
    }

    public function buttonTitle()
    {
        return $this->button_title;
    }

    public function buttonLink()
    {
        return $this->button_link;
    }

    public function creationDate() 
    {
        return $this->creation_date;
    }

    public function modificationDate()
    {
        return $this->modification_date;
    }

    /**
     * SETTERS
     */
    public function setId($id) 
    {
        $this->id = (int) $id;
    }

    public function setDisplayOrder($order)
    {
        $this->display_order = (int) $order;
    }

    public function setTitle($title)
    {
        if(!is_string($title) || empty($title))
        {
            $this->errors[] = self::INCORRECT_CAPTION;
        }
        else
        {
            $this->title = $title;
        }
    }

    public function setCaption($caption) 
    {
        if(!is_string($caption) || empty($caption))
        {
            $this->errors[] = self::INCORRECT_TITLE;
        }
        else
        {
            $this->caption = $caption;
        }
    }

    public function setImage($image_link)
    {
        if (!is_string($image_link) || empty($image_link))
        {
            $this->errors[] = self::INCORRECT_IMAGE_LINK;
        }
        else
        {
            $this->image = $image_link;
        }
    }

    public function setButtonTitle($button_title)
    {
        $this->button_title = $button_title;
    }

    public function setButtonLink($button_link)
    {
        $this->button_link = $button_link;
    }
    
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function setModificationDate($modification_date)
    {
        $this->modification_date = $modification_date;
    }

}