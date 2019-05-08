<?php
namespace App\model;
use App\entity\User;
use \PDO;

class UserManager extends Manager {
    
    public function getSuperAdmin() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT username, password, firstname, lastname, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
        FROM projet_4_users WHERE user_type = 1');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $super_admin = $req->fetch();

        return $super_admin;
    }

    public function getAdmins() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT id, username, password, firstname, lastname, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date
        FROM projet_4_users WHERE user_type = 2');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $admins = $req->fetchAll();

        return $admins;
    }

    public function getMembers() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT id, username, password, firstname, lastname, email, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin%ss\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date
        FROM projet_4_users WHERE user_type = 3');

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $members = $req->fetchAll();

        return $members;
    }

    public function getMember($id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT id, username, password, firstname, lastname, email, profile_picture, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date
        FROM projet_4_users WHERE id = ?');
        $req->execute(array($id));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $user = $req->fetch();

        return $user;
    }

    public function getUser($username) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT id, username, password, firstname, lastname,user_type, profile_picture, DATE_FORMAT(birthdate, \'%d/%m/%Y à %Hh%imin\') AS birthdate, description, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date
        FROM projet_4_users WHERE username = ?');
        $req->execute(array($username));

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\User');

        $user = $req->fetch();

        return $user;
    }

    public function createUser(User $user) {
        $db = $this->MySQLConnect();

        if ($user->userType() == 3) {
            $req = $db->prepare('INSERT INTO projet_4_users(
                username, 
                password, 
                email, 
                firstname,
                lastname,
                user_type,
                profile_picture,
                creation_date
            ) 
            VALUES (
                :username, 
                :password, 
                :email, 
                :firstname, 
                :lastname, 
                :user_type, 
                :profile_picture,
                NOW()
            )');
    
            $affected_lines = $req->execute(array(
                'username' => $user->username(),
                'password' => $user->password(),
                'email' => $user->email(),
                'firstname' => $user->firstname(),
                'lastname' => $user->lastname(),
                'user_type' => $user->userType(),
                'profile_picture' => $user->profilePicture(),
            ));
    
        }
        elseif ($user->userType() == 2) {
            $req = $db->prepare('INSERT INTO projet_4_users(
                username, 
                password,
                email,
                firstname, 
                lastname, 
                user_type, 
                profile_picture, 
                birthdate, 
                description, 
                creation_date
            ) 
            VALUES (
                :username, 
                :password,
                :email, 
                :firstname, 
                :lastname, 
                :user_type, 
                :profile_picture, 
                :birthdate, 
                :description, 
                NOW())');
    
            $affected_lines = $req->execute(array(
                'username' => $user->username(),
                'password' => $user->password(),
                'email' => $user->email(),
                'firstname' => $user->firstname(),
                'lastname' => $user->lastname(),
                'user_type' => $user->userType(),
                'profile_picture' => $user->profilePicture(),
                'birthdate' => $user->birthdate(),
                'description' => $user->description()
            ));
        }
        return $affected_lines;
    }

    public function editUser(User $user) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('UPDATE projet_4_users SET password = :password, firstname = :firstname, lastname = :lastname, profile_picture = :profile_picture, birthdate = :birthdate, description = :description
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
        $req = $db->prepare('DELETE FROM projet_4_users WHERE id = ?');
        
        $affected_lines = $req->execute(array($user_id));

        return $affected_lines;
    }
}