<?php

class Item {
  private $itemId;
  private $name;
  private $color;
  private $brand;
  private $sellerId;
  private $sold;
  private $db;

  public function __construct($itemId, $name, $color, $brand, $sellerId, $sold) {
    $this->itemId = $itemId;
    $this->name = $name;
    $this->color = $color;
    $this->brand = $brand;
    $this->sellerId = $sellerId;
    $this->sold = $sold;

    // Anslut till databasen
    $this->db = new PDO("mysql:host=localhost;dbname=experien2e", "experien2e", "abc123");
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function addItem($name, $color, $brand, $sellerId) {
    $query = "INSERT INTO Item (name, color, brand, sellerId, sold) VALUES (?, ?, ?, ?, 0)";
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

  public function getDaysInInventory() {
    $query = "SELECT createdDate FROM Item WHERE itemId = ?";
  $stmt = $this->db->prepare($query);
  $stmt->execute([$this->itemId]);
  $createdDate = $stmt->fetchColumn();

  $currentDate = date('Y-m-d'); // Aktuellt datum

  $datetime1 = new DateTime($createdDate);
  $datetime2 = new DateTime($currentDate);
  $interval = $datetime1->diff($datetime2);

  return $interval->days;
  }

  public function markAsSold() {
    $query = "UPDATE Item SET sold = 1 WHERE itemId = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$this->itemId]);
    $this->sold = 1;
  }

  public function getItemInfo() {
    $query = "SELECT * FROM Item WHERE itemId = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$this->itemId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
