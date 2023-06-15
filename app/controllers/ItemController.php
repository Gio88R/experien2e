<?php
require_once __DIR__ . '/../partials/connect.php';
require_once __DIR__ . '/../models/Item.php';

class ItemController {
  private $db;

  public function __construct() {
    global $pdo;
    $this->db = $pdo;
  }

  public function index() {
    // Hämta och visa en lista med plagg
    $itemModel = new ItemModel();
    $items = $itemModel->getAllItems();

    // Skicka plagglistan till en vyfil
    require_once 'app/views/items/index.php';
  }

  public function add() {
    // Hantera logiken för att lägga till ett plagg
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Formulär skickades - validera och lägg till plagg
      $name = $_POST['name'];
      $sellerId = $_POST['sellerId'];

      // Validera och sanera inmatade värden
      $itemModel = new ItemModel();
      $isValidName = $itemModel->validateName($name);
      $isValidSellerId = $itemModel->validateSellerId($sellerId);
      // ... fortsätt med validering av andra fält

      if ($isValidName && $isValidSellerId) {
        // Sanera inmatade värden
        $sanitizedName = $itemModel->sanitizeInput($name);
        $sanitizedSellerId = $itemModel->sanitizeInput($sellerId);
        // ... fortsätt med sanering av andra fält

        // Lägg till plagg i databasen
        $itemModel->addItem($sanitizedName, $sanitizedSellerId);

        // Om allt gick bra kan du omdirigera till plagglistan eller en bekräftelsesida
        header('Location: /items'); // Exempel på omdirigering till plagglistan
        exit();
      } else {
        // Visa felmeddelanden för ogiltig inmatning
        require_once 'app/views/items/index.php';
      }
    } else {
      // Visa formuläret för att lägga till ett plagg
      require_once 'app/views/items/index.php';
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

  // Implementera övriga metoder som behövs för plagg
}
