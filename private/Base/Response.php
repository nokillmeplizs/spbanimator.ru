<?php
namespace Alexandr\Animator\Base;


class Response
{
    protected $body;
    protected $headers = [];
    protected $statusCode = 200;

    public function __construct($body = '', $statusCode = 200, array $headers = [])
    {
        $this
            ->setBody($body)
            ->setStatusCode($statusCode)
            ->setHeaders($headers)
        ;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function send()
    {
        $this
            ->sendHeaders()
            ->sendBody();

        return $this;
    }

    protected function sendBody()
    {
        echo $this->getBody();
        return $this;
    }

    protected function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        foreach ($this->getHeaders() as $name => $value) {
            header("$name: $value", false, $this->getStatusCode());
        }

        http_response_code($this->getStatusCode());

        return $this;
    }


    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }


    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->getHeaders(), $headers);
        return $this;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

}