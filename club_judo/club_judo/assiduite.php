
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

<?php

include 'connexion.php';
session_start();

//Vérifier si l'utilisateur est déjà authentifié
if (isset($_SESSION['adresse_mail'])) {
    // Rediriger vers la page de cours si l'utilisateur est déjà connecté
    header("Location: recup.php");
    exit(); 
}

// Vérifiez si l'utilisateur est connecté (vous pouvez ajuster cela selon votre logique de connexion)
if (isset($_SESSION['idcrédentials'])) {
    // Redirigez l'utilisateur vers la page de choix
    header("Location: http://localhost/club_judo/choix.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}




// je vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}



// requête pour récupérer les cours de l'utilisateur
$query = "SELECT c.idcours, c.date, c.heure_debut, c.heure_fin, c.status, p.presence FROM COURS c
 JOIN PRESENT p ON c.idcours = p.id_cours AND p.idcredentials = idcredentials
WHERE c.idcours = id_cours";

$result = $connexion->query($query);

// je vérifier si la requête a réussi
if ($result) {
    echo "<h2>Liste des Cours</h2>";
    echo "<table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Heure de fin</th>
                    <th>Status</th>
                    <th>presence</th> 
                </tr>
            </thead>
            <tbody>";

    // j'affiche les résultats de la requête
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['heure_debut']}</td>
                <td>{$row['heure_fin']}</td>
                <td>{$row['status']}</td>
                <td>{$row['presence']}</td>
            </tr>";
    }

    echo "</tbody></table>";

    // Libérer le résultat de la requête
    $result->free();
} else {
    echo "Erreur dans la requête : " . $connexion->error;
}

// 
$connexion->close();
?>
