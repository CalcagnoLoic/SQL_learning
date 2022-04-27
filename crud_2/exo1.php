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
    <title>Exercice 1</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 
</head>
<body>
    <h1>Exercices CRUD 2</h1>
    <h2>Création d'un formulaire pour ajouter un client dans la DB</h2>
    <form action="" method="post">
        <p>Formulaire de réservation : </p>
        <label for="nom">Entrez votre nom : </label>
        <input type="text" name="nom"><br>
        <label for="prenom">Entrez votre prénom : </label>
        <input type="text" name="prenom"><br>
        <label for="birth">Entrez votre date de naissance : </label>
        <input type="text" name="birth"><br>
        <label for="card">Avez-vous une carte de fidélité? </label>
        <input type="radio" name="card" value="1">Oui
        <input type="radio" name="card" value="0">Non<br>
        <label for="cardNumber">Entrez votre numéro de carte de fidélité si vous en avez-une : </label>
        <input type="text" name="cardNumber"><br>
        <input type="submit" value="Envoyer" class="btn">
    </form>

    <?php
    $nom = isset($_POST['nom']) ? $_POST['nom'] : NULL ;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL ;
    $date = isset($_POST['birth']) ? $_POST['birth'] : NULL ;
    $nbr = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : NULL ;
    $cards = isset($_POST['card']) ? $_POST['card'] : NULL ;

    $add_client = $conn -> prepare("INSERT INTO clients(lastName, firstName, birthDate, card, cardNumber) VALUES (:lastName, :firstName, :birthDate, :card, :cardNumber)");

    $add_client -> execute([
        'lastName' => $nom,
        'firstName' => $prenom,
        'birthDate' => $date, 
        'card' => $cards,
        'cardNumber' => $nbr,
    ])
    ?>
</body>
</html>