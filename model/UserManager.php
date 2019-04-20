<?php
namespace App\model;
use \PDO;

class UserManager extends Manager {
    
    public function getSuperAdmin() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT username, password, firstname, lastname, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
        FROM users WHERE user_type = 1');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $super_admin = $req->fetch();

        return $super_admin;
    }

    public function getAdmins() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT username, password, firstname, lastname, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
        FROM users WHERE user_type = 2');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $admin = $req->fetchAll();

        return $admins;
    }

    public function getMembers() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT username, password, firstname, lastname, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
        FROM users WHERE user_type = 3');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $member = $req->fetchAll();

        return $members;
    }

    public function getUser($username) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT username, password, firstname, lastname,user_type, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
        FROM users WHERE username = ?');
        $req->execute(array($username));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $user = $req->fetch();

        return $user;
    }

    public function createUser(User $user) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('INSERT INTO users(username, password, firstname, lastname, user_type, profile_picture, birthdate, description, creation_date) 
        VALUES (:username, :password, :firstname, :lastname, :user_type, :profile_picture, :birthdate, :description, NOW())');

        $affected_lines = $req->execute(array(
            'username' => $user->username(),
            'password' => $user->password(),
            'firstname' => $user->firstname(),
            'lastname' => $user->lastname(),
            'user_type' => $user->userType(),
            'profile_picture' => $user->profilePicture(),
            'birthdate' => $user->birthdate(),
            'description' => $user->description()
        ));

        return $affected_lines;
    }

    public function editUser(User $user) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('UPDATE users SET password = :password, firstname = :firstname, lastname = :lastname, profile_picture = :profile_picture, birthdate = :birthdate, description = :description
        WHERE id = :id');

        $affected_lines = $req->execute(array(
            'password' => $user->password(),
            'firsname' => $user->firstname(),
            'lastname' => $user->lastname(),
            'profile_picture' => $user->profilePicture(),
            'birthdate' => $user->birthdate(),
            'id' => $user->id()
        ));

        return $affected_lines;
    }

    public function deleteUser($user_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('DELETE * FROM users WHERE id = ?');
        
        $affectedLines = $req->execute(array($user_id));

        return $affected_lines;
    }
}