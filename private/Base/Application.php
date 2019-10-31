<?php
namespace Alexandr\Animator\Base;

class Application
{
    private $config;

    public function __construct($config)
    {
        $this->config = $this->loadConfig($config);
    }

    private function loadConfig($configPath)
    {
        if (!is_readable($configPath)) {
            var_dump("not readable");
        }
        return $config = json_decode(file_get_contents($configPath), true);
    }

    public function handleRequest(Request $request){
        $router = new Router($this->config['urls']);

        $routeInfo = $router->dispatch($request->getMethod(), $request->getUri());
        $controllerData = Controller::create($routeInfo);

        $request->setParams($controllerData[1]);

        $response = call_user_func_array($controllerData[0], [$request]);

        if (!$response instanceof Response) {
            throw new \LogicException('The controller must return the response object.');
        }
        return $response;
    }

}