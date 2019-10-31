<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.01.2019
 * Time: 8:33
 */

namespace Alexandr\Animator\Models;


use Alexandr\Animator\Base\DBConnection;


class IndexModel
{
    const VIDEO_ADDED = "VIDEO_ADDED";
    const VIDEO_DELETE = "VIDEO_DELETE";
    const DB_ERROR = "DB_ERROR";
    const ABOUT_UPDATE = "ABOUT_UPDATE";
    private $db;
    public function __construct()
    {
        $this->db = new DBConnection();

    }
    public function getLast3Comments(){
        $sql ="SELECT comment.id,comment.comment_text,users.username FROM comment,users WHERE comment.users_id = users.id ORDER BY comment.id DESC LIMIT 3";

        $comments =  $this->db->queryAll($sql);
        return $comments;
    }

    public function getMoreComments(){
        $sql ="SELECT comment.id,comment.comment_text,users.username FROM comment,users WHERE comment.users_id = users.id ORDER BY comment.id DESC LIMIT 3,3";

        $comments =  $this->db->queryAll($sql);
        return $comments;
    }

    public function addVideo($data){
        $sql = "INSERT INTO video (videoname,videolink) VALUES (:videoname,:videolink)";
        $params = [
            'videoname'=>strip_tags($data['videoName']),
            'videolink' => strip_tags($data['videoLink'], '<iframe>')
        ];
        $result = $this->db->execute($sql, $params);
        if($result === false) {
            return self::DB_ERROR;
        }
        return self::VIDEO_ADDED;
    }
    public function showVideoAction(){
        $view = 'add_video_view.php';
        $title =  "добавление видео";
        $data = [
            'tittle'=>$title
        ];

        return parent::generateResponse($view, $data);
    }
    public function getVideo(){
        $sql ="SELECT * FROM video ORDER BY id DESC";
        $result = $this->db->queryAll($sql);
        return $result;

    }
    public function deleteVideo($id){
        $sql ="DELETE FROM video WHERE id =:id";
        $params = [
            'id'=>$id['id']
        ];
        $result = $this->db->execute($sql,$params);
        if($result === false ) {
            return self::DB_ERROR;
        }
        return self::VIDEO_DELETE;
    }
    public function getAboutInfo(){
        $sql ="SELECT * FROM about_us_info";
        $result = $this->db->queryAll($sql);
        return $result;

    }


    public function updateAboutUsInfo($data){

            try {
                $sql = "UPDATE about_us_info SET title =:title, text=:text,title_page=:title_page,description=:description,keywords=:keywords WHERE id = 1";
                $params = [
                    'title' => $data['title'],
                    'text' => $data['text'],
                    'title_page'=>$data['title_page'],
                    'description'=>$data['description'],
                    'keywords'=>$data['keywords']
                ];

                $result = $this->db->execute($sql, $params);
            }
            catch (PDOException $e){
                $error =  'Ошибка показа объявления: ' . $e->getMessage();
            }

        if($result === false) {
            return self::DB_ERROR;
        }
        return self::ABOUT_UPDATE;
    }
}