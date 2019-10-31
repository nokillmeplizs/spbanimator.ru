<?php
/**
 * Created by PhpStorm.
 * User: popkaEshy
 * Date: 02.02.2019
 * Time: 13:16
 */

namespace Alexandr\Animator\Controllers;


use Alexandr\Animator\Base\Controller;
use Alexandr\Animator\Base\Request;
use Alexandr\Animator\Models\CharactersModel;
use Alexandr\Animator\Base\UploadBra;

class CharactersController extends Controller
{
    private $charactersModel;
    private $request;
    private $upload;
    public function __construct()
    {
        $this->charactersModel = new CharactersModel();
        $this->request = new Request();
        $this->upload = new UploadBra();
    }
// страница добавление персонажа
    public function showCharacterAction(){
        $view = 'add_character_view.php';
        $title =  "Аккаунт";
        $data = [
            'tittle'=>$title
        ];

        return parent::generateResponse($view, $data);
    }

    public  function showSingleCharacterAction($request){
        $id = $request->params();
        $id = $id['id'];
        $view = 'single_character_view.php';
        $character = $this->charactersModel->getCharacter($id);
        $characterPhotoNames = $this->charactersModel->getPhotoNameCharacter($id);
        $price = $this->charactersModel->getPrice($id);
        $data = [
            'character' => $character,
            'photos' =>$characterPhotoNames,
            'title'=>$character[0]['title_page'],
            'description' => $character[0]['description'],
            'keywords' => $character[0]['keywords'],
            'price' => $price
        ];

        return parent::generateResponse($view, $data);


    }

// добавление фото и данных в бд
    public function addCharacterAction($request){
        $character = $request->post();
        $path = '../public_html/images/characters';
        $names = $this->upload->upload_image($path);
        $namesMultiPhotos = $this->upload->upload_images($path,$character['title']);
        $names =$names[0];
        $characterData = [
            'title'=>$character['title'],
            'pic'=> $names,
            'pics'=>$namesMultiPhotos,
            'text'=>$character['character_text'],
            'title_page'=>$character['title_page'],
            'description'=>$character['description'],
            'keywords'=>$character['keywords'],
            'price'=>$character['price']
        ];
         $answer = $this->charactersModel->addCharacter($characterData);
         return parent::generateAjaxResponse($answer);
    }

    public function editCharacterAction($request){
        $id = $request->params();
        $id = $id['id'];
        $title =  "Редактирование персонажа";
        $character = $this->charactersModel->getCharacter($id);
        $price = $this->charactersModel->getPrice($id);
        $characterPhotoNames = $this->charactersModel->getPhotoNameCharacter($id);
        $data = [
            'photos'=>$characterPhotoNames,
            'title'=>$title,
            'character' => $character,
            'id'=>$id,
            'price'=>$price
        ];
        $view = 'edit_character_view.php';
        return parent::generateResponse($view, $data);
    }

     public  function saveEditCharacterAction($request){
         $character = $request->post();
         $id = $request->params();
         $id = $id['id'];
         $path = '../public_html/images/characters';
         $countMultiPhotosInDB = $this->charactersModel->count_check($id);
         $names = $this->upload->upload_image($path);
         $namesMultiPhotos = $this->upload->upload_images($path,$character['title'],$countMultiPhotosInDB);
         //$price = $this->charactersModel->getPrice($id);
         if($names=="toobig"){
             $answer="toobig";
             return parent::generateAjaxResponse($answer);
         }
         if ($names !== false){
             $names =$names[0];
         }
         $characterData = [
             'title'=>$character['title'],
             'pic'=> $names,
             'pics'=>$namesMultiPhotos,
             'text'=>$character['character_text'],
             'title_page'=>$character['title_page'],
             'description'=>$character['description'],
             'keywords'=>$character['keywords'],
             'id'=>$id,
             'price'=>$character['price']
         ];

         $answer = $this->charactersModel->updateCharacter($characterData);
         return parent::generateAjaxResponse($answer);
     }


     public function deleteCharacterAction($request){
         $id = $request->params();
         $id = $id['id'];
         $characterData = [
             'id'=>$id
         ];
         $answer = $this->charactersModel->deleteCharacter($characterData);
         return parent::generateAjaxResponse($answer);

     }
    public function deleteCharacterPhotoAction($request){
        $photoNameForDelete = $request->post();
        $photoNameForDelete = $photoNameForDelete['DeletePhoto'];
        $Data = [
            'pic'=>$photoNameForDelete
        ];
        $answer = $this->charactersModel->deleteCharacterPhoto($Data);
        return parent::generateAjaxResponse($answer);

    }

// показать всех персонажей
    public function charactersAction(){
        $view = 'characters_view.php';
        //$title =  "Наши персонажи";
        $characters = $this->charactersModel->getCharacters();
       // $characters['title']=$title;
        return parent::generateResponse($view,$characters);
    }

}