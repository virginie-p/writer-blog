<?php
namespace App\entity;
/**
 * This class represents a user (super-admin, admin or member)
 */
class User extends Entity
{

    protected   $errors=[],
                $id,
                $username,
                $password,
                $firstname,
                $lastname,
                $user_type,
                $profile_picture,
                $birthdate,
                $description,
                $creation_date;

    const EMPTY_USERNAME = 1;
          
    /** GETTERS */
    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

    public function firstname()
    {
        return $this->firstname;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function userType()
    {
        return $this->user_type;
    }

    public function profilePicture()
    {
        return $this->profile_picture;
    }

    public function birthdate()
    {
        return $this->birthdate;
    }
    
    public function description()
    {
        return $this->description;
    }

    public function creationDate()
    {
        return $this->creation_date;
    }

    /** SETTERS */
    public function setId($id) 
    {
        $this->id = (int) $id;
    }

    public function setUsername($username)
    {
        
        if (empty($username)) {
            $this->$errors[] = self::EMPTY_USERNAME;
        }
        else {
            $this->username = $username;
        }
    }
    
    public function setPassword($password)
    {
        if(empty($password)) {
            $this->$errors[] = self::EMPTY_PASSWORD;
        }
        else {
            $this->password = $password;
        }
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setUserType($user_type) {
        $this->user_type = $user_type;
    }

    public function setProfilePicture($profile_picture) {
        $this->profile_picture = $profile_picture;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function setDescription($description) {
        $this->setDescription = $description;
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
}