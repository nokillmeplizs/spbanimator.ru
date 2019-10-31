<?php
namespace Alexandr\Animator\Models;

use Alexandr\Animator\Base\DBConnection;


class ShowModel
{

    const SHOW_ADDED = "SHOW_ADDED";
    const DB_ERROR = "DB_ERROR";
    const SHOW_UPDATE ="SHOW_UPDATE";
    const SHOW_DELETE ="SHOW_DELETE";
    const PHOTO_SHOW_DELETE ="PHOTO_SHOW_DELETE";

    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();

    }

    // вывод фоток для карточки шоу
    public function getPhotoNameCharacter($id){
        $sql ="SELECT showName FROM show_photos WHERE show_id =:id";
        $params = ['id'=>$id];
        $characterPhotoNames =  $this->db->execute($sql, $params);
        $justPhotoName=[];
        foreach ($characterPhotoNames as $photo){
            $justPhotoName[]=($photo["showName"]);
        }
        return $justPhotoName;

    }
    // получение стоимости заказа шоу
    public function getPrice($id)
    {
        $sql ="SELECT * FROM prices WHERE show_id =:id";
        $params = ['id'=>$id];
        $result = $this->db->execute($sql, $params);
        if($result != null){
            return $result;
        }else{
            $sql2 = "INSERT INTO prices (price,show_id) VALUES (:price,:show_id)";
            $paramsForPrice= [
                'price'=>"",
                'show_id'=>$id
            ];
            return $this->db->execute($sql2, $paramsForPrice);
        }

    }

// добавить новое шоу
    public function addShow($data){
        $sql = "INSERT INTO shows (title,picname,show_info,title_page,description,keywords) VALUES (:title,:picname,:show_text,:title_page,:description,:keywords)";
        $params = [
            'title'=>$data['title'],
            'picname' => $data['pic'],
            'show_text' => $data['text'],
            'title_page'=>$data['title_page'],
            'description'=>$data['description'],
            'keywords'=>$data['keywords']
        ];
        $result = $this->db->execute($sql, $params);
        if($result === false) {
            return self::DB_ERROR;
        }
        $id=$this->db->getLastId();

        $sql2 = "INSERT INTO prices (price,show_id) VALUES (:price,:show_id)";
        $paramsForPrice= [
            'price'=>$data['price'],
            'show_id'=>$id
        ];
        $result2 = $this->db->execute($sql2, $paramsForPrice);
        //вставка в бд дополнитеьных  фоток персонажа
        foreach($data['pics'] as $onepic) {
            $sql3 = "INSERT INTO show_photos (showName,show_id) VALUES (:showName,:show_id)";
            $paramsForPhotoname = [
                'showName' => $onepic,
                'show_id' => $id
            ];
            $this->db->execute($sql3, $paramsForPhotoname);
        }

        if($result2 === false) {
            return self::DB_ERROR;
        }

        return self::SHOW_ADDED;
    }

    public function getShows(){
        $sql ="SELECT * FROM shows  ORDER BY id DESC";
        $result = $this->db->queryAll($sql);
        return $result;

    }

    public function getShow($id){
        $sql ="SELECT * FROM shows WHERE id =:id";
        $params = ['id'=>$id];
        return $this->db->execute($sql, $params);

    }
    public function deleteShow($id){
        $sql2 ="SELECT `picname` FROM shows WHERE id =:id";
        $params = ['id'=>$id['id']];
        $result = $this->db->execute($sql2,$params);
        $pic_name_for_delete=$result[0][picname];
        $path = '../public_html/images/shows/';
        $sql ="DELETE FROM shows WHERE id =:id";
        $params = ['id'=>$id['id']];
        $result = $this->db->execute($sql,$params);
        $sql3 ="DELETE FROM prices WHERE show_id =:id";
        $result2 = $this->db->execute($sql3,$params);
        //получаем имена фоток для удаления
        $sql5 ="SELECT `showName` FROM show_photos WHERE show_id =:id";
        $params = [
            'id'=>$id['id']
        ];
        $names = $this->db->execute($sql5,$params);
        $justPhotosName=[];
        foreach($names as $name){
            $justPhotosName[]=$name['showName'];
        }
        foreach ($justPhotosName as $name){
            unlink($path.$name);
        }
        //удалит дополнительные фото из бд
        $sql4 ="DELETE FROM show_photos WHERE show_id =:id";
        $this->db->execute($sql4,$params);
        //
        if($result === false || $result2 === false) {
            return self::DB_ERROR;
        }
        unlink($path.$pic_name_for_delete);
        return self::SHOW_DELETE;
    }

    public function deleteShowPhoto($photoName){
        $path = '../public_html/images/shows/';
        $name=$photoName['pic'];
        unlink($path.$name);
        $sql ="DELETE FROM show_photos WHERE showName =:sname";
        $params = [
            'sname'=>$name
        ];
        $this->db->execute($sql,$params);
        return self::PHOTO_SHOW_DELETE;
    }

    public function updateShow($data){
        if ($data['pic'] !== false){
        //Удаляю старую фотку
        $sql2 ="SELECT `picname` FROM shows WHERE id =:id";
        $params = ['id'=>$data['id']];
        $result = $this->db->execute($sql2,$params);
        $pic_name_for_delete=$result[0][picname];
        $path = '../public_html/images/shows/';
        unlink($path.$pic_name_for_delete);
        try {
            $sql = "UPDATE shows SET title =:title,picname =:picname,show_info =:show_text,title_page=:title_page,description=:description,keywords=:keywords WHERE id =:id";
            $sql3 = "UPDATE prices SET price =:price WHERE show_id =:id";
            $params = [
                'title' => $data['title'],
                'picname' => $data['pic'],
                'show_text' => $data['text'],
                'title_page'=>$data['title_page'],
                'description'=>$data['description'],
                'keywords'=>$data['keywords'],
                'id'=>$data['id']
            ];
            $paramsForPrice =[
                'price'=>$data['price'],
                'id'=>$data['id']
            ];

            $result = $this->db->execute($sql, $params);
            $result2 = $this->db->execute($sql3, $paramsForPrice);
        }
        catch (PDOException $e){
            $error =  'Ошибка показа объявления: ' . $e->getMessage();
        }}
        else{
            try {
                $sql = "UPDATE shows SET title =:title,show_info =:show_text,title_page=:title_page,description=:description,keywords=:keywords WHERE id =:id";
                $sql3 = "UPDATE prices SET price =:price WHERE character_id =:id";
                $params = [

                    'title' => $data['title'],
                    'show_text' => $data['text'],
                    'title_page'=>$data['title_page'],
                    'description'=>$data['description'],
                    'keywords'=>$data['keywords'],
                    'id'=>$data['id']
                ];
                $paramsForPrice =[
                    'price'=>$data['price'],
                    'id'=>$data['id']
                ];
                $result = $this->db->execute($sql, $params);
                $result2 = $this->db->execute($sql3, $paramsForPrice);
            }
            catch (PDOException $e){
                $error =  'Ошибка показа объявления: ' . $e->getMessage();
            }}


        if($result === false || $result2 === false) {
            return self::DB_ERROR;
        }
        if ($data['pics'] !== false){
            foreach($data['pics'] as $onepic) {
                $sql3 = "INSERT INTO show_photos (showName,show_id) VALUES (:showName,:show_id)";
                $paramsForPhotoname = [
                    'showName' => $onepic,
                    'show_id' => $data['id']
                ];
                $this->db->execute($sql3, $paramsForPhotoname);
            }
        }

        return self::SHOW_UPDATE;
    }

    public  function count_check($id){
        $sql ="SELECT COUNT(id) FROM show_photos WHERE show_id =:id";
        $params = ['id'=>$id];
        $result= $this->db->execute($sql, $params);
        return (int)$result[0]['COUNT(id)'];
    }

}