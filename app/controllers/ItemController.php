<?php
require_once __DIR__ . '/../models/Item.php';
  
class ItemController {
  private $db;

  public function __construct() {
    global $pdo;
    $this->db = $pdo;
  }

  public function index() {
    // Hämta och visa en lista med plagg
    $items = $this->getAllItems();

    // Skicka plagglistan till en vyfil
    require_once __DIR__ . '/../views/items/index.php';
  }

  public function add() {
    // Hantera logiken för att lägga till ett plagg
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Formulär skickades - validera och lägg till plagg
      $name = $_POST['name'];
      $color = $_POST['color'];
      $brand = $_POST['brand'];
      $sellerId = $_POST['sellerId'];

      // Validera och sanera inmatade värden
      $itemModel = new Item();
      $isValidName = $itemModel->validateName($name);
      $isValidColor = $itemModel->validateColor($color);
      $isValidBrand = $itemModel->validateBrand($brand);
      $isValidSellerId = $itemModel->validateSellerId($sellerId);

      if ($isValidName && $isValidColor && $isValidBrand && $isValidSellerId) {
        // Sanera inmatade värden
        $sanitizedName = $itemModel->sanitizeInput($name);
        $sanitizedColor = $itemModel->sanitizeInput($color);
        $sanitizedBrand = $itemModel->sanitizeInput($brand);
        $sanitizedSellerId = $itemModel->sanitizeInput($sellerId);

        // Lägg till plagg i databasen
        $itemModel->addItem($sanitizedName, $sanitizedColor, $sanitizedBrand, $sanitizedSellerId);

        // Om allt gick bra kan du omdirigera till plagglistan eller en bekräftelsesida
        header('Location: /items'); // Exempel på omdirigering till plagglistan
        exit();
      } else {
        // Visa felmeddelanden för ogiltig inmatning
        require_once __DIR__ . '/../views/items/index.php';
      }
    } else {
      // Visa formuläret för att lägga till ett plagg
      require_once __DIR__ . '/../views/items/index.php';
    }
  }

  public function markSold($itemId) {
    // Hantera logiken för att markera ett plagg som sålt
    try {
      // Uppdatera plaggstatusen i databasen
      $query = "UPDATE Item SET sold = 1 WHERE itemId = ?";
      $stmt = $this->db->prepare($query);
      $stmt->execute([$itemId]);

      // Skicka eventuell respons eller utför andra åtgärder efter uppdateringen
      // Exempelvis en bekräftelsemeddelande eller omdirigering till en annan sida
    } catch (PDOException $e) {
      // Hantera eventuella fel vid uppdateringen av plaggstatusen
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function getAllItems() {
    $itemModel = new Item();
    return $itemModel->getAllItems();
  }

  // Implementera övriga metoder som behövs för plagg
}
