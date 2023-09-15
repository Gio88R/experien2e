<?php



class SellerMdl {
    private $connect;
        
    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function getAllSellers() {
        $statement = $this->connect->query("SELECT * FROM sellers ORDER BY name");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellerById($sellerId) {
        $statement = $this->connect->prepare("
            SELECT
                items.item_id,
                items.item_name,
                items.sbmt_date,
                items.sold,
                items.price,
                items.sold_date,
                sellers.seller_id,
                sellers.name AS seller_name,
                sellers.total_items,
                sellers.total_items_sold,
                sellers.total_sales
            FROM
                items
                LEFT JOIN sellers ON items.seller_id = sellers.seller_id
            WHERE
                sellers.seller_id = :sellerId
        ");
        $statement->bindParam(':sellerId', $sellerId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createSeller($name, $totalItemsSbmt, $totalItemsSold, $totalSalesAmount) {
        $statement = $this->connect->prepare("INSERT INTO sellers (name, total_items, total_items_sold, total_sales) VALUES (:name, :total_items, :total_items_sold, :total_sales)");
        $statement->bindParam(':name', $name);
        $statement->bindParam(':total_items', $totalItemsSbmt);
        $statement->bindParam(':total_items_sold', $totalItemsSold);
        $statement->bindParam(':total_sales', $totalSalesAmount);
        return $statement->execute();
    }
}
    
?>