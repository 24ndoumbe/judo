<?php
//include 'connexion.php';

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $status = $_POST['status'];

    // Requête SQL pour ajouter le cours à la base de données
    $sql = "INSERT INTO COURS (date, heure_debut, heure_fin, status) VALUES ('$date', '$heure_debut', '$heure_fin', '$status')";

    // Exécutez la requête
    if ($connexion->query($sql) === TRUE) {
        $response = "Cours ajouté avec succès.";
    } else {
        $response = "Erreur lors de l'ajout du cours : " . $connexion->error;
    }

    // Fermez la connexion à la base de données
    $connexion->close();
}


?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>
</head>
<body>
    <h2>Ajouter un Cours</h2>
    <form action="http://localhost/club_judo/cours.html" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" required><br>
        
        <label for="heure_debut">Heure de Début:</label>
        <input type="time" name="heure_debut" required><br>
        
        <label for="heure_fin">Heure de Fin:</label>
        <input type="time" name="heure_fin" required><br>
        
        <label for="status">Statut (maintenu ou annulé):</label>
        <select name="status" required>
            <option value="maintenu">Maintenu</option>
            <option value="annulé">Annulé</option>
        </select><br>
        
        <input type="submit" value="Ajouter Cours" >
    </form>

    <?php
    // Affichez la réponse de l'ajout du cours
    if (isset($response)) {
        echo "<p>$response</p>";
    }
    ?>
</body>
</html>
