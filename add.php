<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

   if(isset($_POST['titre']) && isset($_POST['temps']) && isset($_POST['sortie'])){
    $titre=htmlspecialchars($_POST['titre']);
    $temps=htmlspecialchars($_POST['temps']);
    $sortie=htmlspecialchars($_POST['sortie']);

    $request = $bdd->prepare('INSERT INTO fiche_film (titre,temps,sortie)
                             VALUE (:titre,:temps,:sortie)
                            ');

    $request->execute([
        'titre'=>$titre,
        'temps'=>$temps,
        'sortie'=>$sortie,
    ]);

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php include("nav.php");?>

    <form action="add.php" method="post">
        <label for="titre">Le titre de votre film</label>
        <input type="text" id="titre" name="titre">
        <label for="temps">La duré de votre film</label>
        <input type="text" id="temps" name="temps">
        <label for="sortie">l'année de sortie</label>
        <input type="text" id="sortie" name="sortie">
        <button>Ajouter</button>
    </form>
</body>
</html>