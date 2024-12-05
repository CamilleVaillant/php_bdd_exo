<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

    $request = $bdd->prepare('  SELECT *
                                FROM fiche_film'
                            );
    $request->execute([]);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Exercice php_bdd</title>
</head>


<body>
    <h1>Récuperation de la requêtte</h>
    <?php include("nav.php");?>
    <?php while($data = $request->fetch()): ?>
        <article>
            <!-- <?php var_dump($data)?> -->
            <p>Titre:<?php echo $data['titre']?></p>
            <p>Durée:<?php   
                $min = $data['temps']%60;
                $heure =($data['temps']-$min)/60;
                echo $heure . "h" . $min . "min";
                            
            ?></p>
            <p>Sortie en:<?php echo $data['sortie'] ?></p>
            <a href="voir_plus.php?id=<?php echo $data['id']?>">voir plus</a>
            <a href="modifier.php">Modifier</a>
            <a href="">suprimer</a>
        </article>
        
    <?php endwhile?>
    



                          





</body>
</html>