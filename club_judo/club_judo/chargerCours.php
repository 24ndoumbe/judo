<?php
include 'connexion.php';


// Requête SQL pour récupérer tous les cours
$sql = "SELECT * FROM COURS";
$result = $connexion->query($sql);

// Récupérer les résultats en tant que tableau associatif
$coursExistants = $result->fetch_assoc();

// Renvoyer les résultats en tant que réponse JSON
echo json_encode($coursExistants);

$connexion->close();
?>







