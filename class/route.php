<?php

$ROUTE = new class {
    private $routes = [];
    public function route(string $path, callable $callback)
    {
        $this->routes[$path] = $callback;
    }

    public function run()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $f = false;
        foreach ($this->routes as $p => $cb) {
            if ($p != $uri)
                continue;
            $f = true;
            $cb();
        }
        if (!$f)
            include '404.php';
    }
}

    ?>