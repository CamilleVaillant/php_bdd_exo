<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <?php include("nav.php");?>
    <form action="inscription.php" method="post">
        <h1>Inscription</h1>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
