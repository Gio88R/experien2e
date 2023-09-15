<?php


class ItemMdl  {
    private $connect;
        
    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function getAllItems() {
        $statement = $this->connect->query("SELECT * FROM items");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemById($itemId) {
        $statement = $this->connect->prepare("SELECT * FROM items WHERE item_id = :itemId");
        $statement->bindParam(':itemId', $itemId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public function markItemAsSold($itemId) {
        $soldDate = date('Y-m-d');
        $statement = $this->connect->prepare("UPDATE items SET sold = 1, sold_date = :soldDate WHERE item_id = :itemId");
        $statement->bindParam(':itemId', $itemId);
        $statement->bindParam(':soldDate', $soldDate);
        $statement->execute();

        $statement = $this->connect->prepare("SELECT * FROM items WHERE item_id = :itemId");
        $statement->bindParam(':itemId', $itemId);
        $statement->execute();
        $updatedItem = $statement->fetch(PDO::FETCH_ASSOC);

        return $updatedItem;
    }

    public function updateSellerSales($sellerId, $price) {
        $updateStmt = $this->connect->prepare("UPDATE sellers SET total_items_sold = total_items_sold + 1, total_sales = total_sales + :price WHERE seller_id = :sellerId");
        $updateStmt->bindParam(':price', $price);
        $updateStmt->bindParam(':sellerId', $sellerId);
        $updateStmt->execute();
    }
    public function insertItem($name, $sellerId, $sbmtDate, $price, $sold, $soldDate) {
        $statement = $this->connect->prepare("INSERT INTO items (item_name, seller_id, sbmt_date, price, sold, sold_date) VALUES (:item_name, :seller_id, :sbmt_date, :price, :sold, :sold_date)");

        $statement->bindParam(':item_name', $name);
        $statement->bindParam(':seller_id', $sellerId);
        $statement->bindParam(':sbmt_date', $sbmtDate);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':sold', $sold);
        $statement->bindParam(':sold_date', $soldDate);
        

        if ($statement->execute()) {
            $updateStmt = $this->connect->prepare("UPDATE sellers SET total_items = total_items + 1 WHERE seller_id = :seller_id");
            $updateStmt->bindParam(':seller_id', $sellerId);
            $updateStmt->execute();

            return true;
        } else {
            return false;
        }
    }
}
?>
