<?php

require_once 'utils/config.php';
require_once 'utils/connect.php';
require_once 'models/item.php';
require_once 'models/Seller.php';
require_once 'controllers/Item-Controller.php';
require_once 'controllers/Seller-Controller.php';
require_once 'views/item-view.php';
require_once 'views/seller-view.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$request = rtrim($_SERVER['REQUEST_URI'], '/');
$baseUrl = '/experien2e';
$endpoint = str_replace($baseUrl, '', $request);



$Itemmodel = new ItemMdl($pdo);
$Itemview = new ItemView();
$Itemcontroller = new ItemCtrl($Itemmodel, $Itemview);

$sellerModel = new SellerMdl($pdo);
$sellerView = new SellerView();
$sellerController = new SellerCtrl($sellerModel, $sellerView);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($endpoint === '/items') {
        $Itemcontroller->getAllItems();
    } elseif (strpos($endpoint, '/items/') === 0) {
        $Itemcontroller->getItemById();
    }elseif ($endpoint === '/sellers' || strpos($endpoint, '/sellers/') === 0) {
        $sellerController->handleEndpoint($endpoint);
    }

}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (strpos($endpoint, '/items/') === 0) {
        $Itemcontroller->updateItemById();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($endpoint === '/sellers') {
        $sellerController->createSeller();
    } elseif($endpoint === '/items') {
        $Itemcontroller->createItem();
    }
}

?>
