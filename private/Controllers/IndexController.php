<?php
namespace Alexandr\Animator\Controllers;
use Alexandr\Animator\Base\Controller;
use Alexandr\Animator\Models\IndexModel;

class IndexController extends Controller
{


    private $indexModel;

    public function __construct()
    {
        $this->indexModel = new IndexModel();
    }

    public function indexAction()
    {
        $aboutData = $this->indexModel->getAboutInfo();
        $view = 'index_view.php';
        $data = [
            'data' => $aboutData,
            'title'=>$aboutData[0]['title_page'],
            'description' => $aboutData[0]['description'],
            'keywords' => $aboutData[0]['keywords']
        ];

        return parent::generateResponse($view, $data);
    }

    public function aboutAction()
    {
        $title = 'Titlename';
        $view = 'about_view.php';
        $data = [
            'title' => $title
        ];
        return parent::generateResponse($view, $data);
    }

    public function showCommentAction()
    {

        $view = 'comment_view.php';
        $comments = $this->indexModel->getLast3Comments();
        $moreComments = $this->indexModel->getMoreComments();
        $data = [
            'last3comments' => $comments,
            'moreComments' => $moreComments
        ];

        return parent::generateResponse($view, $data);
    }
//показывает страницу с видео
        public function VideoAction(){
        $view = 'video_view.php';
        $video = $this->indexModel->getVideo();
        $title = "Наше видео";
        $data = [
            'title'=>$title,
            'video'=>$video
        ];
        return parent::generateResponse($view,$data);
    }

//показывает страницу добавления видео
    public function showVideoAction(){
        $view = 'add_video_view.php';   ;
        $title = "Добавление видео";
        $data = [
            'title'=>$title
        ];
        return parent::generateResponse($view,$data);
    }
    public function addVideoAction($request)
    {
        $video = $request->post();
        $data = [
            'videoName' => $video['videoName'],
            'videoLink' => $video['videoLink']
        ];
        $answer = $this->indexModel->addVideo($data);
        return parent::generateAjaxResponse($answer);
    }

    public function deleteVideoAction($request){
        $id = $request->params();
        $id = $id['id'];
        $data = [
            'id'=>$id
        ];
        $answer = $this->indexModel->deleteVideo($data);
        return parent::generateAjaxResponse($answer);

    }
    // редактирование главной страницы текст и иноф о партнерах
    public function aboutUsEditAction($request){
        $id = $request->params();
        $id = $id['id'];
        $title =  "Редактирование главной страницы";
        $aboutData = $this->indexModel->getAboutInfo();
        $data = [
            'title'=>$title,
            'data' => $aboutData,
            'id'=>$id
        ];
        $view = 'edit_aboutUs_view.php';
        return parent::generateResponse($view, $data);
    }

    public  function aboutUsSaveAction($request){
        $about = $request->post();
        $id = $request->params();
        $id = $id['id'];
        $path = '../public_html/images/partner';
        $aboutData = [
            'title'=>$about['title'],
            'text'=>$about['aboutInfoText'],
            'id'=>$id,
            'title_page'=>$about['title_page'],
            'description'=>$about['description'],
            'keywords'=>$about['keywords'],
        ];

        $answer = $this->indexModel->updateAboutUsInfo($aboutData);
        return parent::generateAjaxResponse($answer);
    }
}


