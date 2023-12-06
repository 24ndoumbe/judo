
<?php
session_start();
include 'connexion.php';


// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['adresse_mail'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit(); 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcours = $_POST['idcours'];
    $idusers = $_SESSION['idusers']; 

    //$idcours et $idusers pour mettre à jour le statut de présence/absence dans la table "PRESENT"
    $requete = "INSERT INTO present (idcours, idcredentials) VALUES ('$idcours', '$idusers')";
    
    // pour exécuter la requête
    if ($connexion->query($requete) === TRUE) {
        // Succès
        echo json_encode(['success' => true]);
    } else {
        // Erreur
        echo json_encode(['success' => false, 'error' => $connexion->error]);
    }
}


$connexion->close();
?>





