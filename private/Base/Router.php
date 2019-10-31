<?php
namespace Alexandr\Animator\Base;


class Router
{
    private $dispatcher_func;
    public function __construct(array $urls)
    {
        $this->dispatcher_func = $this->setOptions($urls);
    }

    public function setOptions(array $urls){

        return function (\FastRoute\RouteCollector $r) use ($urls) {

            foreach ($urls as $name => $data) {
                $arr = explode("::", $data['controller']);
                $r->addRoute($data['method'], $data['path'],
                    [$arr[0], $arr[1]]);
            }
        };
    }

    public function dispatch($httpMethod, $uri){
        $dispatcher = \FastRoute\simpleDispatcher($this->dispatcher_func);
        return $dispatcher->dispatch($httpMethod, $uri);
    }

}