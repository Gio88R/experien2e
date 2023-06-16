<?php
require_once __DIR__ . '/../models/Seller.php';

class SellerController {
  public function index() {
    // Hämta och visa en lista med säljare
    $sellerModel = new SellerModel();
    $sellers = $sellerModel->getAllSellers();

    // Skicka säljarlistan till en vyfil
    require_once __DIR__ . '/../views/sellers/index.php';
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

      if ($isValidEmail) {
        $sanitizedName = $sellerModel->sanitizeInput($name);

        // Lägg till säljaren i databasen
        $sellerModel->addSeller($name, $lastname, $email, $mobile);

        header('Location: /sellers');
        exit();
      } else {
        // Visa felmeddelanden för ogiltig inmatning
        // Exempelvis kan du använda require/include för att inkludera en vyfil som visar felmeddelanden och formuläret igen
        require_once __DIR__ . '/../views/sellers/add.php';
      }
    } else {
      // Visa formuläret för att lägga till säljare
      // Exempelvis kan du använda require/include för att inkludera en vyfil med formuläret för att lägga till säljare
      require_once __DIR__ . '/../views/sellers/add.php';
    }
  }
}
