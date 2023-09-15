<?php

class SellerCtrl {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleEndpoint($endpoint) {
        if ($endpoint === '/sellers') {
            $sellers = $this->model->getAllSellers();
            $this->view->renderSellers($sellers);
            exit();
        } elseif (strpos($endpoint, '/sellers/') === 0) {
            $sellerId = substr($endpoint, strlen('/sellers/'));
            $seller = $this->model->getSellerById($sellerId);
            $items = array();
            
            foreach ($seller as $item) {
                $itemData = array(
                    "item_id" => $item["item_id"],
                    "item_name" => $item["item_name"],
                    "sbmt_date" => $item["sbmt_date"],
                    "sold" => $item["sold"],
                    "price" => $item["price"],
                    "sold_date" => $item["sold_date"]
                );
                $items[] = $itemData;
            }
            
            $sellerData = array(
                "seller_id" => $seller[0]["seller_id"],
                "seller_name" => $seller[0]["seller_name"],
                "seller_lastname" => $seller[0]["seller_lastname"],
                "total_items" => $seller[0]["total_items"],
                "total_items_sold" => $seller[0]["total_items_sold"],
                "total_sales" => $seller[0]["total_sales"],
                "items" => $items
            );
            
            header('Content-Type: application/json');
            
            echo json_encode($sellerData);
            exit();
        }
    }

    public function createSeller() {
        $jsonPayload = file_get_contents('php://input');
        $data = json_decode($jsonPayload, true);
        $name = isset($data['name']) ? filter_var($data['name'], FILTER_SANITIZE_STRING) : '';
        $lastname = isset($data['lastname']) ? filter_var($data['lastname'], FILTER_SANITIZE_STRING) : '';
        $totalItems = isset($data['total_items']) ? filter_var($data['total_items'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $totalItemsSold = isset($data['total_items_sold']) ? filter_var($data['total_items_sold'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $totalSales = isset($data['total_sales']) ? filter_var($data['total_sales'], FILTER_SANITIZE_NUMBER_INT) : 0;

        $success = $this->model->createSeller($name, $lastname, $totalItems, $totalItemsSold, $totalSales);
        if ($success) {
            $this->view->renderSuccessResponse();
        } else {
            $this->view->renderErrorResponse();
        }
    }
}
?>
