<?php
require_once __DIR__ . '/../partials/connect.php';

class Item {
  private $db;

  public function __construct() {
    global $host, $db, $user, $password;
    $this->db = connect($host, $db, $user, $password);
  }

  public function getAllItems() {
    $query = "SELECT * FROM items";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  
  public function addItem($name, $color, $brand, $sellerId) {
    $query = "INSERT INTO items (name, color, brand, sellerId, sold) VALUES (?, ?, ?, ?, 0)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$name, $color, $brand, $sellerId]);
  }

  public function getItemId() {
    return $this->itemId;
  }

  public function getName() {
    return $this->name;
  }

  public function getColor() {
    return $this->color;
  }

  public function getBrand () {
    return $this->brand;
  }

  public function getSellerId() {
    return $this->sellerId;
  }

  public function isSold() {
    return $this->sold;
  }
}
