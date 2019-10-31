<?php
namespace Alexandr\Animator\Models;

use Alexandr\Animator\Base\DBConnection;


class CharactersModel
{

    const CHAR_ADDED = "CHAR_ADDED";
    const DB_ERROR = "DB_ERROR";
    const CHAR_UPDATE ="CHAR_UPDATE";
    const CHAR_DELETE ="CHAR_DELETE";
    const PHOTO_DELETE ="PHOTO_DELETE";
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();

    }

    public function addCharacter($data){
        $sql = "INSERT INTO characters (title,picname,character_info,title_page,description,keywords) VALUES (:title,:picname,:character_text,:title_page,:description,:keywords)";
        $params = [
            'title'=>$data['title'],
            'picname' => $data['pic'],
            'character_text' => $data['text'],
            'title_page'=>$data['title_page'],
            'description'=>$data['description'],
            'keywords'=>$data['keywords']
        ];
        $result = $this->db->execute($sql, $params);
        if($result === false) {
            return self::DB_ERROR;
        }
        $id=$this->db->getLastId();

        $sql2 = "INSERT INTO prices (price,character_id) VALUES (:price,:character_id)";
        $paramsForPrice= [
            'price'=>$data['price'],
            'character_id'=>$id
        ];
        $result2 = $this->db->execute($sql2, $paramsForPrice);
        //вставка в бд дополнитеьных  фоток персонажа
        foreach($data['pics'] as $onepic) {
            $sql3 = "INSERT INTO character_photos (photoName,character_id) VALUES (:photoName,:character_id)";
            $paramsForPhotoname = [
                'photoName' => $onepic,
                'character_id' => $id
            ];
            $this->db->execute($sql3, $paramsForPhotoname);
        }

        if($result2 === false) {
            return self::DB_ERROR;
        }
        return self::CHAR_ADDED;
    }

    public function getCharacters(){
        $sql ="SELECT * FROM characters  ORDER BY id DESC";
        $result = $this->db->queryAll($sql);
        return $result;

    }
    // вывод данных для карточки товара
    public function getCharacter($id){
        $sql ="SELECT * FROM characters WHERE id =:id";
        $params = ['id'=>$id];
        return $this->db->execute($sql, $params);

    }
    // вывод фоток для карточки товара
    public function getPhotoNameCharacter($id){
        $sql ="SELECT photoName FROM character_photos WHERE character_id =:id";
        $params = ['id'=>$id];
        $characterPhotoNames =  $this->db->execute($sql, $params);
        $justPhotoName=[];
        foreach ($characterPhotoNames as $photo){
            $justPhotoName[]=($photo["photoName"]);
        }
        return $justPhotoName;

    }
    // получение стоимости заказа персонажа
    public function getPrice($id)
    {
        $sql ="SELECT * FROM prices WHERE character_id =:id";
        $params = ['id'=>$id];
        $result = $this->db->execute($sql, $params);
        if($result != null){
            return $result;
        }else{
            $sql2 = "INSERT INTO prices (price,character_id) VALUES (:price,:character_id)";
            $paramsForPrice= [
                'price'=>"",
                'character_id'=>$id
            ];
            return $this->db->execute($sql2, $paramsForPrice);
        }

    }

    public function deleteCharacter($id){
        $sql2 ="SELECT `picname` FROM characters WHERE id =:id";
        $params = ['id'=>$id['id']];
        $result = $this->db->execute($sql2,$params);
        $pic_name_for_delete=$result[0][picname];
        $path = '../public_html/images/characters/';
        $sql ="DELETE FROM characters WHERE id =:id";
        $params = ['id'=>$id['id']];
        $result = $this->db->execute($sql,$params);
        $sql3 ="DELETE FROM prices WHERE character_id =:id";
        $result2 = $this->db->execute($sql3,$params);
        //получаем имена фоток для удаления
        $sql5 ="SELECT `photoName` FROM character_photos WHERE character_id =:id";
        $params = ['id'=>$id['id']];
        $names = $this->db->execute($sql5,$params);
        $justPhotosName=[];
        foreach($names as $name){
            $justPhotosName[]=$name['photoName'];
        }
        foreach ($justPhotosName as $name){
            unlink($path.$name);
        }
        //удалит дополнительные фото из бд
        $sql4 ="DELETE FROM character_photos WHERE character_id =:id";
        $this->db->execute($sql4,$params);
        //
        if($result === false || $result2 === false) {
            return self::DB_ERROR;
        }
        unlink($path.$pic_name_for_delete);
        return self::CHAR_DELETE;
    }

    public function deleteCharacterPhoto($photoName){
        $path = '../public_html/images/characters/';
        $name=$photoName['pic'];
        unlink($path.$name);
        $sql ="DELETE FROM character_photos WHERE photoName =:pname";
        $params = [
            'pname'=>$name
        ];
        $this->db->execute($sql,$params);
        return self::PHOTO_DELETE;
    }

    public function updateCharacter($data){

        if ($data['pic'] !== false){
            //Удаляю старую фотку
            $sql2 ="SELECT `picname` FROM characters WHERE id =:id";
            $params = [
                'id'=>$data['id']
            ];
            $result = $this->db->execute($sql2,$params);
            $pic_name_for_delete=$result[0][picname];
            $path = '../public_html/images/characters/';
            unlink($path.$pic_name_for_delete);
        try {
            $sql = "UPDATE characters SET title =:title,picname =:picname,character_info =:character_text,title_page=:title_page,description=:description,keywords=:keywords WHERE id =:id";
            $sql3 = "UPDATE prices SET price =:price WHERE character_id =:id";
            $params = [
                'title' => $data['title'],
                'picname' => $data['pic'],
                'character_text' => $data['text'],
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
                $sql = "UPDATE characters SET title =:title,character_info =:character_text,title_page=:title_page,description=:description,keywords=:keywords WHERE id =:id";
                $sql3 = "UPDATE prices SET price =:price WHERE character_id =:id";
                $params = [

                    'title' => $data['title'],
                    'character_text' => $data['text'],
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
                $sql3 = "INSERT INTO character_photos (photoName,character_id) VALUES (:photoName,:character_id)";
                $paramsForPhotoname = [
                    'photoName' => $onepic,
                    'character_id' => $data['id']
                ];
                $this->db->execute($sql3, $paramsForPhotoname);
            }
        }

        return self::CHAR_UPDATE;
    }

    public  function count_check($id){
        $sql ="SELECT COUNT(id) FROM character_photos WHERE character_id =:id";
        $params = ['id'=>$id];
        $result= $this->db->execute($sql, $params);
        return (int)$result[0]['COUNT(id)'];
    }

}