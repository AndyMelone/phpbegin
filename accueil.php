<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: connexion.php");
    exit();
}

$username = $_SESSION["username"];

$connexion = mysqli_connect("127.0.0.1", "root", "root", "tp", 8889);

if (!$connexion) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

$requete = "SELECT * FROM utilisateurs WHERE username='$username'";

$resultat = mysqli_query($connexion, $requete);

$utilisateur = mysqli_fetch_assoc($resultat);

mysqli_close($connexion);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Bienvenue, <?php echo $utilisateur["nom"]; ?></h2>
        <p>Email: <?php echo $utilisateur["email"]; ?></p>
        <p>École: <?php echo $utilisateur["ecole"]; ?></p>
        <a href="index.html" class="btn">Se déconnecter</a>
    </div>
</body>

</html>