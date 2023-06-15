<!DOCTYPE html>
<html>
<head>
  <title>Säljare</title>
</head>
<body>
  <h1>Säljare</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Namn</th>
        <th>Efternamn</th>
        <!-- Lägg till fler kolumnrubriker efter behov -->
      </tr>
    </thead>
    <tbody>
      <!-- Loopa igenom säljare och visa i tabellen -->
      <?php foreach ($sellers as $seller): ?>
        <tr>
          <td><?php echo $seller->getId(); ?></td>
          <td><?php echo $seller->name; ?></td>
          <td><?php echo $seller->lastname; ?></td>
          <!-- Visa fler kolumndata efter behov -->
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
