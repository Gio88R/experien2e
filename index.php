<?php
// Anpassad autoload-funktion
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $modelFile = "app/models/{$className}.php";
    $controllerFile = "app/controllers/{$className}.php";

    if (file_exists($modelFile)) {
        require_once $modelFile;
    } elseif (file_exists($controllerFile)) {
        require_once $controllerFile;
    } elseif (file_exists('partials/connect.php')) {
        require_once 'partials/connect.php';
    }
});



// Ladda config, router och connect
require_once 'app/router/router.php';

// Skapa en ny routerinstans och starta routern
$router = new Router();
$router->start();
