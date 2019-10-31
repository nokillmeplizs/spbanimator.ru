<?php
/**
 * Created by PhpStorm.
 * User: BB
 * Date: 27.12.2018
 * Time: 12:28
 */

namespace Alexandr\Animator\Controllers;


use Alexandr\Animator\Base\Controller;
use Alexandr\Animator\Models\AccountModel;
use Alexandr\Animator\Base\Session;

class AccountController extends Controller
{
    private $accountModel;
    private  $session;
    public function __construct()
    {
     $this->accountModel = new AccountModel();
     $this->session = new Session();
    }

    public function logoutAction(){
        $this->session->close();
        header('Location: /');
        return;
    }

    public function accountAction(){
        $view = 'account_view.php';
        $title =  "Аккаунт";
        $data = [
            'title' => $title
        ];
        return parent::generateResponse($view, $data);
    }

    public function registrationAction($request){
        $postData = $request->post(); // массив $_POST
        $answer = $this->accountModel->addUser($postData);
        return parent::generateAjaxResponse($answer);
    }

    public function authAction($request){
        $postData = $request->post(); // массив $_POST
        $answer = $this->accountModel->authUser($postData);

        return parent::generateAjaxResponse($answer);
    }
    //оставить новый отзыв
    public function addCommentAction($request){
        $postData = $request->post(); // массив $_POST
        $comment =$postData['textarea'];
        $data =[
          'comment'=>$comment
        ];
        $answer = $this->accountModel->addComment($data);

        return parent::generateAjaxResponse($answer);
    }

}