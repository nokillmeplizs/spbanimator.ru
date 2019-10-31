<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.12.2018
 * Time: 20:01
 */

namespace Alexandr\Animator\Base;


class Request
{
    protected $cookies;
    protected $get;
    protected $post;
    protected $files;
    protected $server;
    protected $params;



    public function __construct()
    {
        $this->cookies = $_COOKIE;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function getUri(){
        return $this->server()['REQUEST_URI'];
    }

    public function getMethod(){
        return $this->server()['REQUEST_METHOD'];
    }

    public function cookies()
    {
        return $this->cookies;
    }

    public function get()
    {
        return $this->get;
    }

    public function post()
    {
        return $this->post;
    }

    public function files()
    {
        return $this->files;
    }

    public function server()
    {
        return $this->server;
    }

    public function params()
    {
        return $this->params;
    }


}