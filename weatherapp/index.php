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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application météo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="baneer">
        <h1>Application météo</h1>
    </div>

    <?php 
    //Réalisation requête
    $res = $conn->query("SELECT * from meteo");
    ?>

    <!--Création du tableau-->
    <form action="" method="post" class="meteo">
        <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Ville</th>
                <th>Température maximale</th>
                <th>Température minimale</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $res->fetch()) : ?>
            <tr>
                <td><input type="checkbox" name="del[]" value=<?php echo $row['ville'];?> </td>
                <td><?php echo ($row['ville']); ?></td>
                <td><?php echo ($row['haut']); ?></td>
                <td><?php echo ($row['bas']); ?></td>
            </tr>
            <?php endwhile; 
            $res->closeCursor();
            ?>
        </tbody>
        </table>
        <?php
        if(isset($_POST['del'])) {
            foreach($_POST['del'] as $value) {
                $deleteRes = $conn -> prepare("DELETE FROM meteo WHERE ville = :ville");
                $deleteRes -> execute([
                    'ville' => $value,
                ]);
            }
        }
        ?>
        <input type="submit" value="Supprimer une ville?" class="btn1">
    </form>
    <p>Pour que la suppression soit affichée, n'oublie pas de refresh la page ;)</p>
    <p><strong>Attention! </strong>Pour les villes ayant des noms composés, sépare les différentes parties du nom de la ville par des underscores!</p>
        
    <h2>Ta ville n'apparait pas dans la liste? N'hésite pas à l'ajouter!</h2>
    <form action="" method="post" class="add">
        <label for="ville">Entrez une ville :</label>
        <input type="" name="ville" placeholder="Ville"> <br>
        <label for="haut">Entrez une température maximale :</label>
        <input type="" name="haut" placeholder="Température max"> <br>
        <label for="bas">Entrez une température minimale :</label>
        <input type="" name="bas" placeholder="Température min"> <br>
        <input type="submit" value="Ajout d'une ville" class="btn2">
    </form>

    <?php
    //recup les infos du form 
    $ville = isset($_POST['ville']) ? $_POST['ville'] : 'Une ville est requise';
    $haut = isset($_POST['haut']) ? $_POST['haut'] : 'Une température max est requise';
    $bas = isset($_POST['bas']) ? $_POST['bas'] : 'Une température min est requise';

    //Réalisation requête préparée
    $res2 = $conn->prepare("INSERT INTO meteo(ville, haut, bas) VALUES (:ville, :haut, :bas)");
    $res2->execute([
        'ville' => $ville,
        'haut' => $haut,
        'bas' => $bas,
    ]) or die();

    header("Location: /SQL_learning/weatherapp/index.php");
    $res2->closeCursor();
    ?>
</body>
</html>