<?php

class Router {
    protected $routes = [];

    function add( $method, $uri, $controller )
    {
        $this->routes[] = [
            "method" => $method,
            'uri' => '/index.php' . $uri,
            'controller' => $controller
        ];

    }

    public function get( $uri, $controller )
    {
        return $this->add('GET', $uri, $controller);
    }

    public function put( $uri, $controller )
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function post( $uri, $controller )
    {
        return $this->add('POST', $uri, $controller);
    }

    public function DELETE( $uri, $controller )
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function route( $uri, $method )
    {
        foreach($this->routes as $route)
        {
            if($route['uri'] == $uri && $route['method'] == $method)
            {   

                return require $route['controller'];
            }
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}