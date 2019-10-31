<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.01.2019
 * Time: 8:33
 */

namespace Alexandr\Animator\Models;


use Alexandr\Animator\Base\DBConnection;


class AccountModel
{
    const USER_ADDED = "USER_ADDED";
    const USER_EXISTS = "USER_EXISTS";
    const LOGIN_ERROR = "LOGIN_ERROR";
    const PWD_ERROR = "PWD_ERROR";
    const USER_AUTH = "USER_AUTH";
    const DB_ERROR = "DB_ERROR";
    const COMMENT_ADD = "COMMENT_ADD";

    private $db;
    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function loginExists($userData){
        $sql = 'SELECT login FROM users WHERE login =:login';
        $params = ['login'=>$userData['login']];

        $answer = $this->db->execute($sql, $params, false);
        return $answer;
    }

    public function addUser($userData){

        if ($this->loginExists($userData)){
            return self::USER_EXISTS;
        }

        $sql = "INSERT INTO `users` (login, password, username,phone)
              VALUES (:login, :password, :username, :phone)";
        $params = [
            'login'=>$userData['email'],
            'password'=>password_hash($userData['password'], PASSWORD_DEFAULT),
            'username'=>$userData['username'],
            'phone'=>$userData['phone'],
        ];

        $result = $this->db->execute($sql, $params);
        $id=$this->db->getLastId();
        if($result === false) {
            return self::DB_ERROR;
        }
        $_SESSION['auth'] = true;
        $_SESSION['name'] = $userData['username'];
        $_SESSION['id'] = $id;
        return self::USER_ADDED;
    }

    public function authUser($userData){
        $sql = "SELECT id,login, password, username, role FROM users 
      WHERE login=:login";
        $params = [
            'login'=> $userData['email']
        ];

        $result = $this->db->execute($sql, $params);

        if (!$result){
            return self::LOGIN_ERROR;
        }

        $hash = $result[0]['password'];

        if (!password_verify($userData['password'], $hash)){
            return self::PWD_ERROR;
        }
        $_SESSION['auth'] = true;
        if($result[0]['role']!=1){
            $_SESSION['name'] = $result[0]['username'];
            $_SESSION['id'] = $result[0]['id'];
        }
        else{
            $_SESSION['admin'] = true;
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['name'] = 'Администратор';
        }
        return self::USER_AUTH;
    }

    public function addComment($data){
            if (isset($data)){
            $sql = "INSERT INTO `comment` (comment_text,users_id) VALUES (:comment_text, :users_id) ";
            $params = [
                'comment_text'=>strip_tags($data['comment']),
                'users_id'=>$_SESSION['id']
            ];
            $result = $this->db->execute($sql, $params);
            if($result === false) {
                return self::DB_ERROR;
            }
           return self::COMMENT_ADD;
        }
    }

}