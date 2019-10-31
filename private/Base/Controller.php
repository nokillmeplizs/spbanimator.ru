<?php
namespace Alexandr\Animator\Base;


class Controller
{
    public static function create(array $routeInfo){
        $controllerData = null;

        switch ($routeInfo[0]) {
            case 0:
                // ... 404 Not Found
                var_dump("404 Not Found");
                break;
            case 2:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                var_dump("405 Method Not Allowed".$allowedMethods);
                break;
            case 1:
                $handler = $routeInfo[1];
                $controller = $handler[0];
                $action = $handler[1];

                $vars = $routeInfo[2];

                $controllerData = [[new $controller(), $action], $vars];
                break;
        }
        return $controllerData;
    }

    protected function generateResponse($view, array $data=[],
                                        $template='template_view.php')
    {
        $response = new Response();

        $response->setBody(
            $this->render($view, $data, $template)
        );

        return $response;
    }

    protected function generateAjaxResponse($text)
    {
        $response = new Response();

        $response->setBody(
            $text
        );

        return $response;
    }
    public function render($view, array $data,
                                     $template='template_view.php')
    {
        extract($data);
        ob_start();
        include __DIR__ . '/../Views/' . $template;
        $page = ob_get_contents();
        ob_end_clean();
        return $page;
    }
}