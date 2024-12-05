<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');
    $id=$_GET['id'];
    
        $request = $bdd->prepare('SELECT titre, temps, sortie
                                  FROM fiche_film
                                  WHERE (:id)
                               ');

        $request->execute([
        'id'=>$id,
       
        ]);

        
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

<?php
    if(isset($id)){
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
       
    
    }
?>
</body>
</html>