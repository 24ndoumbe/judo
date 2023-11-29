
<?php
session_start();
include 'connexion.php';

//POUR LA PAGE ASSIDUITE




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que vous avez une session utilisateur active


    
    // Requête SQL pour récupérer les cours à venir pour l'utilisateur
$sql = "SELECT c.idcours, c.date, c.heure_début, c.heure_fin, c.statuts
FROM COURS c
INNER JOIN PRéSENT p ON c.idcours = p.id_cours
INNER JOIN USERS u ON p.id_créd = u.idusers
WHERE u.idusers = idusers
  AND c.date >= CURRENT_DATE
ORDER BY c.date, c.heure_début";

$result = $connexion->query($sql);

if ($result) {
// Traitez les résultats ici
while ($row = $result->fetch_assoc()) {
// $row contient les détails du cours à venir
// Faites quelque chose avec ces données
}
} else {
// Gestion des erreurs de requête
echo "Erreur de requête : " . $connexion->error;
}

// N'oubliez pas de fermer la connexion après utilisation
$connexion->close();
}






?>