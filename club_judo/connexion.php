<?php
$host = "localhost:3306";
$user = "root";
$password = "123456789";
$database = "judo_club";

$connexion = new mysqli($host, $user, $password, $database);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}
?>
