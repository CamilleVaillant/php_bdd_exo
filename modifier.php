<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

// Vérification de l'ID du film
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupération des informations du film
    $request = $bdd->prepare('SELECT * FROM fiche_film WHERE id = :id');
    $request->execute(['id' => $id]);
    $data = $request->fetch();

    // Si le film n'est pas trouvé
    if (!$data) {
        die('Film introuvable');
    }
} else {
    die('Identifiant de film non valide');
}

// Traitement du formulaire (lors de l'envoi)
if (isset($_POST['titre'], $_POST['temps'], $_POST['sortie'])) {
    // Récupération des nouvelles valeurs du formulaire
    $titre = htmlspecialchars($_POST['titre']);
    $temps = htmlspecialchars($_POST['temps']);
    $sortie = htmlspecialchars($_POST['sortie']);
    $imagePath = $data['image']; // Conserver l'image actuelle par défaut

    // Vérification si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileType = mime_content_type($fileTmpPath);

        // Vérification si le fichier est bien une image
        if (strpos($fileType, 'image/') === 0) {
            $uploadsDir = 'images/'; // Répertoire de stockage des images
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0755, true);
            }

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $fileExtension;
            $imagePath = $uploadsDir . $newFileName;

            // Déplacement du fichier
            if (!move_uploaded_file($fileTmpPath, $imagePath)) {
                die('Erreur lors du téléchargement de l\'image.');
            }
        } else {
            die('Le fichier téléchargé n\'est pas une image valide.');
        }
    }

    // Mise à jour du film dans la base de données
    $update = $bdd->prepare('UPDATE fiche_film SET titre = :titre, temps = :temps, sortie = :sortie, image = :image WHERE id = :id');
    $update->execute([
        'titre' => $titre,
        'temps' => $temps,
        'sortie' => $sortie,
        'image' => $imagePath,
        'id' => $id
    ]);

    echo "Film mis à jour avec succès!";
    header('Location: index.php'); // Rediriger vers la page d'accueil après la mise à jour
    exit;
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
    
    <div class="main-container">
        <form action="modifier.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <h1>Modifier information du film</h1>

            <!-- Formulaire de modification du film -->
            <label for="titre">Titre du film</label>
            <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($data['titre']); ?>" required>

            <label for="temps">Durée (en minutes)</label>
            <input type="number" id="temps" name="temps" value="<?php echo htmlspecialchars($data['temps']); ?>" required>

            <label for="sortie">Année de sortie</label>
            <input type="number" id="sortie" name="sortie" value="<?php echo htmlspecialchars($data['sortie']); ?>" required>

            <label for="image">Changer l'image (optionnel)</label>
            <input type="file" id="image" name="image" accept="image/*">

            <?php if ($data['image']): ?>
                <p>Image actuelle :</p>
                <img src="<?php echo $data['image']; ?>" alt="Image actuelle" style="max-width: 200px;">
            <?php endif; ?>

            <button type="submit">Modifier</button>
        </form>
    </div>

</body>
</html>
