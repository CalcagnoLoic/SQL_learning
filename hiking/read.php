<?php
try{
	// On se connecte à MySQL
	$conn = new PDO('mysql:host=localhost;dbname=hiking_db;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <thead>
        <th>Nom de la randonnée</th>
        <th>Difficulté</th>
        <th>Distance parcourue (km)</th>
        <th>Durée de la randonnée (hh:mm:ss)</th>
        <th>Dénivelé de la rando (m)</th>
      </thead>
      <tbody>
        <tr>
        <?php
        $resultat = $conn->query("SELECT * FROM hiking");

        while($row = $resultat->fetch()) {
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['difficulty'] . "</td>";
          echo "<td>" . $row['distance'] . "</td>";
          echo "<td>" . $row['duration'] . "</td>";
          echo "<td>" . $row['height_difference'] . "</td>";
          echo "</tr>";
        };
        ?>
      </tbody>
    </table>
  </body>
</html>
