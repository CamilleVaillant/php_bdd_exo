<?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

    // Vérification de l'id passé en GET
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Requête pour obtenir les informations du film
        $request = $bdd->prepare('SELECT * FROM fiche_film WHERE id = :id');
        $request->execute(['id' => $id]);
        
        // Récupération des données
        $data = $request->fetch();
        if (!$data) {
            die('Film introuvable.');
        }
    } else {
        die('Identifiant de film manquant.');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fiche du film</title>
</head>
<body>
    <?php include("nav.php"); ?>

    <div class="article-container">
        <article>
            <?php if (!empty($data['image'])): ?>
            <img src="<?php echo htmlspecialchars($data['image']); ?>" alt="Image du film" style="width: 100%; height: auto;">
            <?php else: ?>
            <p>Aucune image disponible</p> <!-- Afficher un texte ou une image par défaut -->
            <?php endif; ?>
            <h1>Fiche du film</h1>
            <p><strong>Titre :</strong> <?php echo htmlspecialchars($data['titre']); ?></p>
            <p><strong>Durée :</strong> 
                <?php   
                    $min = $data['temps'] % 60;
                    $heure = intdiv($data['temps'], 60);
                    echo $heure . "h" . $min . "min";
                ?>
            </p>
            <p><strong>Sortie en :</strong> <?php echo htmlspecialchars($data['sortie']); ?></p>
            <a href="modifier.php?id=<?php echo htmlspecialchars($id); ?>">Modifier</a>
            <a href="delete.php?id=<?php echo htmlspecialchars($id); ?>">Supprimer</a>
        </article>
    </div>
</body>
</html>
