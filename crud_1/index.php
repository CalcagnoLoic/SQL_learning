<?php
try{
	// On se connecte à MySQL
	$conn = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exercices CRUD 1</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 
</head>
<body>
    <h1>Exercices CRUD 1</h1>
    <h2>Afficher tous les clients</h2>
    <table>
      <thead>
        <tr>
          <th>Nom du client</th>
          <th>Prénom du client</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $exo1 = $conn->query("SELECT lastName, firstName FROM clients");

          while($row1 = $exo1->fetch()) {
            echo "<td>" . $row1['lastName'] . "</td>";
            echo "<td>" . $row1['firstName'] . "</td>";
            echo "</tr>";
          };
          $exo1->CloseCursor();
        ?>
      </tbody>
    </table>

    <h2>Afficher tous les types de spectacles possibles</h2>
    <table>
      <thead>
        <tr>
          <th>Tout les types de spectacles</th>
        </tr>
      </thead>
      <tbody>
          <?php
          $exo2 = $conn->query("SELECT * FROM showtypes");

          while($row2 = $exo2->fetch()) {
            echo "<tr>";
            echo "<td>" . $row2['type'] . "</td>";
            echo "</tr>";
          };
        ?>
      </tbody>
    </table>

    <h2>Afficher les 20 premiers clients</h2>
    <table>
      <thead>
        <tr>
          <th>Nom du client</th>
          <th>Prénom du client</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $exo3 = $conn->query("SELECT lastName, firstName FROM clients LIMIT 20");

          while($row3 = $exo3->fetch()) {
            echo "<td>" . $row3['lastName'] . "</td>";
            echo "<td>" . $row3['firstName'] . "</td>";
            echo "</tr>";
          };
          $exo1->CloseCursor();
        ?>
      </tbody>
    </table>

    <h2>N'afficher que les clients possédant une carte de fidélité</h2>
    <table>
      <thead>
        <tr>
          <th>Nom du client</th>
          <th>Prénom du client</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $exo4 = $conn->query("SELECT lastName, firstName FROM clients WHERE card=1");

          while($row4 = $exo4->fetch()) {
            echo "<td>" . $row4['lastName'] . "</td>";
            echo "<td>" . $row4['firstName'] . "</td>";
            echo "</tr>";
          };
          $exo1->CloseCursor();
        ?>
      </tbody>
    </table>

    <h2>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M". Trier les noms par ordre alphabétique.</h2>
    <?php
    $exo5 = $conn->query("SELECT lastName, firstName FROM clients WHERE lastname LIKE 'M%' ORDER BY lastname");
    while($row5 = $exo5->fetch()){
      echo "Nom : " . $row5['lastName'] . " / " ;
      echo "Prénom : " . $row5['firstName'];
      echo "<br>";
    }
    ?>

    <h2>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique.</h2>
    <?php
    $exo6 = $conn->query("SELECT title, performer, date, startTime FROM shows ORDER BY title");
    while($row6 = $exo6->fetch()){
      $date = date("d-m-Y", strtotime($row6['date']));
      echo $row6['title'] . " par " .  $row6['performer'] . ", le " . $date . " à " . $row6['startTime'];
      echo "<br>";
    }
    ?>

    <h2>Afficher tous les clients</h2>
    <?php
    $exo7 = $conn->query("SELECT id, lastName, firstName, birthDate, card, cardNumber FROM clients");
    while($row7 = $exo7->fetch()){
      $date = date("d-m-Y", strtotime($row7['birthDate']));

      echo "<p> Fiche signalétique du client n°" . $row7['id'] . "</p>";
      echo "<br>";
      echo "Nom du client : " . $row7['lastName'];
      echo "<br>";
      echo "Prénom du client : " . $row7['firstName'];
      echo "<br>";
      echo "Date de naissance du client : " . $date;
      echo "<br>";
      echo "Carte de fidélité : " . (($row7['card'] == 1) ? "Oui" : "Non");
      echo "<br>";
      echo (($row7['cardNumber'] == NULL) ? " "  : "Numéro de carte : " . $row7['cardNumber']);
      echo "<br>";
    }
    ?>
</body>
</html>