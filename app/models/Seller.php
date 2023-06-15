<?php
require_once __DIR__ . '/../partials/connect.php';

class Seller {
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $mobile;
  
    public function __construct(int $id, string $name, string $lastname, string $email, string $mobile) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->mobile = $mobile;
      }
  
    public function getId() {
      return $this->id;
    }
  
    public function getName() {
      return $this->name;
    }
  
    public function getLastname() {
      return $this->lastname;
    }
  
    public function getEmail() {
      return $this->email;
    }
  
    public function getMobile() {
      return $this->mobile;
    }
}

class SellerModel {
  private $db;

  public function __construct() {
    global $host, $db, $user, $password;
    require_once __DIR__ . '/../partials/connect.php';
    $this->db = connect($host, $db, $user, $password);
}
  

  public function getAllSellers() {
    $query = "SELECT * FROM sellers";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    $sellers = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $seller = new Seller($row['id'], $row['name'], $row['lastname'], $row['email'], $row['mobile']);
      $sellers[] = $seller;
    }
  
    return $sellers;
  }
  public function validateEmail($email) {
    // Validera e-postadress med filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false; // Ogiltig e-postadress
    }
    return true; // Giltig e-postadress
  }

  public function addSeller($name, $lastname, $email, $mobile) {
    $query = "INSERT INTO sellers (name, lastname, email, mobile) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$name, $lastname, $email, $mobile]);
  }
  

  public function sanitizeInput($input) {
    // Sanera indata genom att ta bort potentiellt skadlig kod
    $sanitizedInput = filter_var($input, FILTER_SANITIZE_STRING);
    return $sanitizedInput;
  }
  // Övriga metoder för att hantera säljare
}
