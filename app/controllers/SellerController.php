<?php
class SellerController {
  public function index() {
    // Hämta och visa en lista med säljare
    $sellerModel = new SellerModel();
    $sellers = $sellerModel->getAllSellers();

    // Skicka säljarlistan till en vyfil
    // Exempelvis kan du använda require/include för att inkludera en vyfil som visar säljarlistan
    require_once 'app/views/sellers/index.php';
  }

  public function add() {
    // Hantera logiken för att lägga till en säljare
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Formulär skickades - validera och lägg till säljaren
      $name = $_POST['name'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];

      // Validera inmatade värden
      $sellerModel = new SellerModel();
      $isValidEmail = $sellerModel->validateEmail($email);
      // ... fortsätt med validering av andra fält

      if ($isValidEmail) {
        // Sanera inmatade värden
        $sanitizedName = $sellerModel->sanitizeInput($name);
        // ... fortsätt med sanering av andra fält

        // Lägg till säljaren i databasen
        $sellerModel->addSeller($sanitizedName, $lastname, $email, $mobile);

        // Om allt gick bra kan du omdirigera till säljarlistan eller en bekräftelsesida
        header('Location: /sellers'); // Exempel på omdirigering till säljarlistan
        exit();
      } else {
        // Visa felmeddelanden för ogiltig inmatning
        // Exempelvis kan du använda require/include för att inkludera en vyfil som visar felmeddelanden och formuläret igen
        require_once 'app/views/sellers/add.php';
      }
    } else {
      // Visa formuläret för att lägga till säljare
      // Exempelvis kan du använda require/include för att inkludera en vyfil med formuläret för att lägga till säljare
      require_once 'app/views/sellers/add.php';
    }
  }

  // Implementera övriga metoder som behövs för säljare
}
