<?php
require_once __DIR__ . '/../partials/connect.php';

class Item {
  private $db;

  public $item_id;
  public $name;
  public $color;
  public $brand;
  public $sellerId;
  public $sold;
  public $created_at;
  public $updated_at;

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
    $query = "INSERT INTO items (name, color, brand, sellerId, sold, created_at, updated_at) VALUES (?, ?, ?, ?, 0, NOW(), NOW())";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$name, $color, $brand, $sellerId]);
  }

  public function updateStatus($itemId, $status) {
    $query = "UPDATE items SET sold = ?, updated_at = NOW() WHERE item_id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$status, $itemId]);
  }

  // Validerings- och saneringsmetoder

  public function validateName($name) {
    // Implementera valideringslogik för namn
  }

  public function validateColor($color) {
    // Implementera valideringslogik för färg
  }

  public function validateBrand($brand) {
    // Implementera valideringslogik för varumärke
  }

  public function validateSellerId($sellerId) {
    // Implementera valideringslogik för säljar-ID
  }

  public function sanitizeInput($input) {
    // Implementera saneringslogik för inmatning
  }

  // Övriga metoder för plagghantering
}
