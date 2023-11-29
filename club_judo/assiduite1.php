<?php
// Vérifier l'authentification de l'utilisateur (à adapter en fonction de votre système d'authentification)
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
    exit();
}

// Connexion à la base de données
$mysqli = new mysqli("localhost", "nom_utilisateur", "mot_de_passe", "nom_base_de_donnees");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

// Récupérer l'ID de l'utilisateur
$userID = $_SESSION['user_id'];

// Requête SQL pour récupérer les cours de l'utilisateur
$query = "SELECT c.id, c.date, c.heure_debut, c.heure_fin, c.status FROM COURS c
          INNER JOIN PRESENT p ON c.id = p.id_cours
          WHERE p.id_users = $userID";

$result = $mysqli->query($query);

// Vérifier si la requête a réussi
if ($result) {
    echo "<h2>Liste des Cours</h2>";
    echo "<table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Heure de fin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

    // Afficher les résultats de la requête
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['heure_debut']}</td>
                <td>{$row['heure_fin']}</td>
                <td>{$row['status']}</td>
            </tr>";
    }

    echo "</tbody></table>";

    // Libérer le résultat de la requête
    $result->free();
} else {
    echo "Erreur dans la requête : " . $mysqli->error;
}

// Fermer la connexion à la base de données
$mysqli->close();
?>
