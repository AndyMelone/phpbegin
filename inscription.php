<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $ecole = $_POST["ecole"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $connexion = mysqli_connect("127.0.0.1", "root", "root", "tp", 8889);

    if (!$connexion) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    $requete = "INSERT INTO utilisateurs (nom, email, username, ecole, mot_de_passe) VALUES ('$nom', '$email', '$username', '$ecole', '$mot_de_passe')";

    if (mysqli_query($connexion, $requete)) {
        header("Location: connexion.php");
        exit();
    } else {
        echo "Erreur: " . $requete . "<br>" . mysqli_error($connexion);
    }
    mysqli_close($connexion);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Inscription</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="text" name="ecole" placeholder="École" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte? <a href="connexion.php">Connectez-vous ici</a></p>
    </div>
</body>

</html>