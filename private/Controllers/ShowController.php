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
use Alexandr\Animator\Models\ShowModel;
use Alexandr\Animator\Base\UploadBra;

class ShowController extends Controller
{
    private $showModel;
    private $request;
    private $upload;
    public function __construct()
    {
        $this->showModel = new ShowModel();
        $this->request = new Request();
        $this->upload = new UploadBra();
    }
// страница показа всех шоу
    public function showAction(){

        $view = 'shows_view.php';
        $shows = $this->showModel->getShows();

        return parent::generateResponse($view, $shows);
    }
    // показать страницу добавления шоу
    public function ShowShowAction(){
        $view = 'add_show_view.php';
        $title =  "добавить шоу";
        $data = [
            'tittle'=>$title
        ];
        return parent::generateResponse($view,$data);
    }


// добавление фото и данных в бд
    public function addShowAction($request){
        $show = $request->post();
        $path = '../public_html/images/shows';
        $names = $this->upload->upload_image($path);
        $namesMultiPhotos = $this->upload->upload_images($path,$show['title']);
        $names =$names[0];
        $showData = [
            'title'=>$show['title'],
            'pic'=> $names,
            'pics'=>$namesMultiPhotos,
            'text'=>$show['show_text'],
            'title_page'=>$show['title_page'],
            'description'=>$show['description'],
            'keywords'=>$show['keywords'],
            'price'=>$show['price']
        ];


         $answer = $this->showModel->addShow($showData);
         return parent::generateAjaxResponse($answer);
    }

         public function deleteShowAction($request){
         $id = $request->params();
         $id = $id['id'];
         $showData = [
             'id'=>$id
         ];
         $answer = $this->showModel->deleteShow($showData);
         return parent::generateAjaxResponse($answer);
     }

    public function deleteShowPhotoAction($request){
        $photoNameForDelete = $request->post();
        $photoNameForDelete = $photoNameForDelete['DeletePhoto'];
        $Data = [
            'pic'=>$photoNameForDelete
        ];
        $answer = $this->showModel->deleteShowPhoto($Data);
        return parent::generateAjaxResponse($answer);

    }

    public  function showSingleShowAction($request){
        $id = $request->params();
        $id = $id['id'];
        $view = 'single_show_view.php';
        $show = $this->showModel->getShow($id);
        $characterPhotoNames = $this->showModel->getPhotoNameCharacter($id);
        $price = $this->showModel->getPrice($id);
        $data = [
            'show' => $show,
            'photos' =>$characterPhotoNames,
            'title'=>$show[0]['title_page'],
            'description' => $show[0]['description'],
            'keywords' => $show[0]['keywords'],
            'price' => $price
        ];
        return parent::generateResponse($view, $data);
    }

    public function editShowAction($request){
        $id = $request->params();
        $id = $id['id'];
        $title =  "Редактирование шоу";
        $show = $this->showModel->getShow($id);
        $price = $this->showModel->getPrice($id);
        $characterPhotoNames = $this->showModel->getPhotoNameCharacter($id);
        $data = [
            'photos'=>$characterPhotoNames,
            'title'=>$title,
            'show' => $show,
            'id'=>$id,
            'price'=>$price
        ];
        $view = 'edit_show_view.php';
        return parent::generateResponse($view, $data);
    }


     public  function saveEditShowAction($request){
         $show = $request->post();
         $id = $request->params();
         $id = $id['id'];
         $path = '../public_html/images/shows';
         $countMultiPhotosInDB = $this->showModel->count_check($id);
         $names = $this->upload->upload_image($path);
         $namesMultiPhotos = $this->upload->upload_images($path,$show['title'],$countMultiPhotosInDB);
         if($names=="toobig"){
             $answer="toobig";
             return parent::generateAjaxResponse($answer);
         }
         if ($names !== false){
             $names =$names[0];
         }
         $showData = [
             'title'=>$show['title'],
             'pic'=> $names,
             'pics'=>$namesMultiPhotos,
             'text'=>$show['show_text'],
             'title_page'=>$show['title_page'],
             'description'=>$show['description'],
             'keywords'=>$show['keywords'],
             'id'=>$id,
             'price'=>$show['price']
         ];

         $answer = $this->showModel->updateShow($showData);
         return parent::generateAjaxResponse($answer);
     }

}

