

<?php
session_start();
include 'connexion.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcours = $_POST['idcours'];
    $idusers = $_SESSION['idusers']; // Assurez-vous que vous avez une session utilisateur active

    // Utilisez $idcours et $idusers pour mettre à jour le statut de présence/absence dans la table "PRESENT"
    $requete = "INSERT INTO present (idcours, idcredentials) VALUES ('$idcours', '$idusers')";
    
    // Exécutez la requête
    if ($connexion->query($requete) === TRUE) {
        // Succès
        echo json_encode(['success' => true]);
    } else {
        // Erreur
        echo json_encode(['success' => false, 'error' => $connexion->error]);
    }
}
?>




<?php
//fonction pour gerer la présence et les absences
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
            $participants[] = $row['nom'] . ' ' . $row['prénom'];
        }

        // Retournez le tableau de participants
        return $participants;
    } else {
        // Gérez l'erreur de requête
        return "Erreur lors de la récupération des participants : " . $connexion->error;
    }
}

// Fonction pour enregistrer la présence
function savePresence($idcours, $status) {
    global $connexion;
    $idusers = $_SESSION['idusers']; // Assurez-vous que vous avez une session utilisateur active

    // Utilisez une requête SQL pour enregistrer la présence dans la table "COURS"
    $requete = "UPDATE cours SET status = '$status' WHERE id = '$idcours' AND id IN (SELECT idcours FROM present WHERE idcredentials = '$idusers')";

    // Exécutez la requête
    if ($connexion->query($requete) === TRUE) {
        // Succès
        echo json_encode(['success' => true]);
    } else {
        // Erreur
        echo json_encode(['success' => false, 'error' => $connexion->error]);
    }
}

// Traitement de la demande POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcours = $_POST['idcours'];
    $status = $_POST['status'];
    savePresence($idcours, $status);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $status = $_POST['status'];
    $idusers = $_SESSION['idusers']; // Assurez-vous que vous avez une session utilisateur active

    // Utilisez $startDate, $endDate, $status et $idusers pour mettre à jour le statut de présence/absence dans la table "PRESENT"
    // Vous devez écrire le code SQL approprié pour effectuer cette mise à jour
    // Assurez-vous également que les colonnes et les tables sont correctes dans votre base de données
    
    // Exemple de réponse JSON
    echo json_encode(['success' => true]);
}


//POUR LA PAGE ASSIDUITE
// Récupérez les données de présence/absence depuis le champ caché
$attendanceData = json_decode($_POST['attendanceData'], true);

// Vous pouvez maintenant traiter les données comme vous le souhaitez
// Par exemple, les enregistrer dans une base de données ou les utiliser d'une autre manière

// Exemple : Affichez les données récupérées
echo "Données de présence/absence reçues : <pre>";
print_r($attendanceData);
echo "</pre>";


//RECUP DONNEES COURS
// Supposons que vous avez l'ID de l'utilisateur connecté
$userID = $_SESSION['user_id'];

// Connexion à la base de données (assurez-vous d'avoir une connexion établie)
include 'connexion.php';

// Requête SQL pour récupérer les cours à venir pour l'utilisateur
$sql = "SELECT c.id, c.date, c.heure_debut, c.heure_fin, c.status
        FROM COURS c
        INNER JOIN PRESENT p ON c.id = p.id_cours
        INNER JOIN USERS u ON p.id_credentials = u.id_credentials
        WHERE u.id = $userID
          AND c.date >= CURRENT_DATE
        ORDER BY c.date, c.heure_debut";

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




?>





