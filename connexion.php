<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $mot_de_passe = $_POST["mot_de_passe"];


    $connexion = mysqli_connect("127.0.0.1", "root", "root", "tp", 8889);


    if (!$connexion) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }


    $requete = "SELECT * FROM utilisateurs WHERE username='$username' AND mot_de_passe='$mot_de_passe'";


    $resultat = mysqli_query($connexion, $requete);


    if (mysqli_num_rows($resultat) == 1) {

        $_SESSION["username"] = $username;
        header("Location: accueil.php");
        exit();
    } else {

        $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
    }


    mysqli_close($connexion);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($erreur)) {
            echo "<p class='erreur'>$erreur</p>";
        } ?>
        <p>Pas encore de compte? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </div>
</body>

</html>