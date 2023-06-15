<?php
require_once __DIR__ . '/../partials/config.php';
require_once __DIR__ . '/../partials/connect.php';
require_once __DIR__ . '/../views/items/add.php';
require_once __DIR__ . '/../views/items/index.php';
require_once __DIR__ . '/../views/sellers/add.php';
require_once __DIR__ . '/../views/sellers/index.php';

class Router {
  public function start() {
    // Läs inkommande URL och splitta den i delar
    $url = isset($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : [];

    // Ta bort tomma delar och extrahera kontrollerns och metodenamn
    $controllerName = isset($url[1]) ? ucfirst($url[1]) . 'Controller' : 'HomeController';
    $methodName = isset($url[2]) ? $url[2] : 'index';

    // Inkludera kontrollerklassen
    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
    if (file_exists($controllerFile)) {
      require_once $controllerFile;
      // Skapa en instans av kontrollern
      $controller = new $controllerName();

      // Kör den aktuella metoden i kontrollern
      if (method_exists($controller, $methodName)) {
        $controller->$methodName();
      } else {
        // Felhantering om metoden inte finns
        echo '404 - Sidan hittades inte';
      }
    } else {
      // Felhantering om kontrollerklassen inte finns
      echo '404 - controller hittades inte';
    }
}
}
