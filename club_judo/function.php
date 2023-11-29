<?php
// Incluez votre fichier de connexion à la base de données
include 'connexion.php';


function getParticipantsForDate($date) {
    global $connexion;

    // Utilisez une requête SQL pour récupérer les participants pour la date spécifiée
    $sql = "SELECT nom, prénom FROM users WHERE date_inscription = '$date'";
    $result = $connexion->query($sql);

    // Vérifiez si la requête a réussi
    if ($result) {
        $participants = [];

        // Parcourez les résultats et stockez les participants dans un tableau
        while ($row = $result->fetch_assoc()) {
            $participants[] = $row['nom'] . ' ' . $row['prenom'];
        }

        // Retournez le tableau de participants
        return $participants;
    } else {
        // Gérez l'erreur de requête
        return "Erreur lors de la récupération des participants : " . $connexion->error;
    }
}



?>
