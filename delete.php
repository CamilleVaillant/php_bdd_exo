<?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

    // Vérification de l'id passé en GET
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Requête pour suprimé la fiche film
        $request = $bdd->prepare('DELETE  FROM fiche_film WHERE id = :id');
        $request->execute(['id' => $id]);
        
        header('Location: index.php'); // Rediriger vers la page d'accueil après la mise à jour
        exit;
    }else {
        // Si l'ID n'est pas fourni, rediriger ou afficher une erreur
        die('Identifiant de film manquant.');
    }
?>
