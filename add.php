<?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

    // Vérification si le formulaire a été soumis
    if (isset($_POST['titre']) && isset($_POST['temps']) && isset($_POST['sortie'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $temps = htmlspecialchars($_POST['temps']);
        $sortie = htmlspecialchars($_POST['sortie']);

        $imagePath = null;
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK){
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileType = mime_content_type($fileTmpPath);

            if(strpos($fileType, 'image/') == 0){
                $uploadsDir = 'image/';//dossier pour stoker l'image
            }

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $fileExtension; //nom unique
            $imagePath = $uploadsDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $imagePath)){
                die('erreur lors du téléchargement d\'image');
            }
        }else {
            die('le fichier téléchargé n\'est pas une image valide');
        }

        // Requête pour insérer le film dans la base de données
        $request = $bdd->prepare('INSERT INTO fiche_film (titre, temps, sortie, image) VALUES (:titre, :temps, :sortie, :image)');
        $request->execute([
            'titre' => $titre,
            'temps' => $temps,
            'sortie' => $sortie,
            'image' => $imagePath
        ]);
        header('Location: index.php'); // Rediriger vers la page d'accueil après la mise à jour
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un film</title>
</head>
<body>
    <?php include("nav.php");?>

    <!-- Conteneur principal pour centrer le formulaire -->
    <div class="main-container">
        <form action="add.php" method="post" enctype="multipart/form-data">
            <h1>Ajouter un film</h1>

            <!-- Formulaire d'ajout de film -->
            <label for="titre">Titre du film</label>
            <input type="text" id="titre" name="titre" required>

            <label for="temps">Durée (en minutes)</label>
            <input type="number" id="temps" name="temps" required>

            <label for="sortie">Année de sortie</label>
            <input type="number" id="sortie" name="sortie" required>

            <label for="image">Ajouter une image (optionnel) :</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Ajouter le film</button>
        </form>
    </div>
</body>
</html>
