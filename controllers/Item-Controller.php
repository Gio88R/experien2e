<?php

require_once 'models/item.php';
require_once 'views/item-view.php';

class ItemCtrl {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function getItemById() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', $path);
        $itemId = end($parts);

        $item = $this->model->getItemById($itemId);

        if ($item) {
            $this->view->renderJson($item);
        } else {
            $this->view->renderNotFound();
        }
    }
    
    public function getAllItems() {
        $items = $this->model->getAllItems();
        $this->view->renderJson($items);
    }

    

    public function updateItemById() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', $path);
        $itemId = end($parts);
    
        $item = $this->model->getItemById($itemId);
    
        if ($item) {
            $item = $this->model->markItemAsSold($itemId);
    
            $sellerId = $item['seller_id'];
            $price = $item['price'];
    
            $this->model->updateSellerSales($sellerId, $price);
    
            $updatedItemResponse = array(
                'message' => 'Item marked as Sold',
                'data' => $item
            );
    
            $this->view->renderJson($updatedItemResponse);
        } else {
            $this->view->renderNotFound();
        }
    }
    public function createItem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jsonPayload = file_get_contents('php://input');
            $data = json_decode($jsonPayload, true);
    
            $name = isset($data['item_name']) ? filter_var($data['item_name'], FILTER_SANITIZE_STRING) : '';
            $sellerId = isset($data['seller_id']) ? filter_var($data['seller_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
            $sbmtDate = $data['sbmt_date'];
            $price = isset($data['price']) ? filter_var($data['price'], FILTER_SANITIZE_NUMBER_INT) : 0;
            $sold = isset($data['sold']) ? filter_var($data['sold'], FILTER_SANITIZE_NUMBER_INT) : 0;
            $soldDate = $data['sold_date'];
    
            $result = $this->model->insertItem($name, $sellerId, $sbmtDate, $price, $sold, $soldDate);
    
            if ($result) {
                $this->view->renderSuccessResponse();
            } else {
                $this->view->renderErrorResponse();
            }
        }
    }
}
?>
