<?php
include 'connexion.php';

// Vérifier si la connexion est établie
if ($connexion) {
    echo "La connexion à la base de données a réussi !";
} else {
    echo "Échec de la connexion à la base de données.";
}

$connexion->close();

?>

