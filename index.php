<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

    $request = $bdd->prepare('SELECT * FROM fiche_film');
    $request->execute([]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste des films</title>
</head>
<body>
    <?php include("nav.php"); ?>

    <!-- Conteneur des articles en grille -->
    <div class="articles-container">
        <?php while($data = $request->fetch()): ?>
            <article>
                <?php if (!empty($data['image'])): ?>
                <img src="<?php echo htmlspecialchars($data['image']); ?>" alt="Image du film" style="width: 100%; height: auto;">
                <?php else: ?>
                <p>Aucune image disponible</p> <!-- Afficher un texte ou une image par défaut -->
                <?php endif; ?>
                <p><strong>Titre:</strong> <?php echo htmlspecialchars($data['titre']); ?></p>
                <p><strong>Durée:</strong> 
                    <?php   
                        $min = $data['temps'] % 60;
                        $heure = intdiv($data['temps'], 60);
                        echo $heure . "h" . $min . "min";
                    ?>
                </p>
                <p><strong>Sortie en:</strong> <?php echo htmlspecialchars($data['sortie']); ?></p>
                <a href="voir_plus.php?id=<?php echo $data['id']; ?>">Voir plus</a>
            </article>
        <?php endwhile; ?>
    </div>
</body>
</html>
