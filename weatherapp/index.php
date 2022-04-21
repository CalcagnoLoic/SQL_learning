<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Afficher les infos de la base de donnée dans un tableau HTML</h2>

    <?php 
    //Connexion à la DB
    try{
	// On se connecte à MySQL
	$conn = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    //Réalisation requête
    $res = $conn->query("SELECT * from meteo");
    ?>

    <!--Création du tableau-->
    <table>
    <thead>
        <tr>
            <th>Ville</th>
            <th>Haut</th>
            <th>Bas</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = $res->fetch()) : ?>
        <tr>
            <td><?php echo ($row['ville']); ?> <input type="checkbox" name="del" </td>
            <td><?php echo ($row['haut']); ?></td>
            <td><?php echo ($row['bas']); ?></td>
        </tr>
        <?php endwhile; 
        $res->closeCursor();
        ?>
    </tbody>
    </table>

    <h2>Ajouter des données depuis un formulaire</h2>

    <form action="" method="get">
        <label for="ville">Entrez une ville</label>
        <input type="" name="ville"> <br>
        <label for="haut">Entrez une température max</label>
        <input type="" name="haut"> <br>
        <label for="bas">Entrez une température min</label>
        <input type="" name="bas"> <br>
        <input type="submit">
    </form>

    <?php
    //recup les infos du form 
    $ville = isset($_GET['ville']) ? $_GET['ville'] : NULL;
    $haut = isset($_GET['haut']) ? $_GET['haut'] : NULL;
    $bas = isset($_GET['bas']) ? $_GET['bas'] : NULL;
    // echo $ville;
    // echo $bas;
    // echo $haut;

    try{
    $conn = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    //Réalisation requête préparée
    $res2 = $conn->prepare("INSERT INTO meteo(ville, haut, bas) VALUES (:ville, :haut, :bas)");
    $res2->execute([
        'ville' => $ville,
        'haut' => $haut,
        'bas' => $bas,
    ]) or die(print_r($conn->errorInfo()));;

    header("Location: /SQL_learning/weatherapp/index.php");
    $res2->closeCursor();

    //Supprimer des infos de la db
    $delID = isset($_GET['del']) ? $_GET['del'] : NULL;
    $deleteRes = $conn -> prepare("DELETE FROM meteo WHERE ville :ville");
    $deleteRes -> execute([
        'ville' => $delID,
    ]) or die(print_r($conn->errorInfo()));
    $deleteRes -> closeCursor();
    ?>
</body>
</html>