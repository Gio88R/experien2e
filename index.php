<?php
// Anpassad autoload-funktion
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    require_once 'app/models/{$className}.php';
    require_once 'app/controllers/{$className}.php';
});

// Ladda config, router och connect
require_once 'app/router/router.php';

// Skapa en ny routerinstans och starta routern
$router = new Router();
$router->start();
