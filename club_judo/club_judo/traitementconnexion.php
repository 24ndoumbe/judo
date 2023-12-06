<?php
include 'connexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire de connexion
   
    $adresse_mail = $_POST["adresse_mail"];
    $password = $_POST["password"];
   

    // Préparer et exécuter la requête SQL
    $requete = "INSERT INTO credentials (adresse_mail, password) VALUES ('$adresse_mail', '$password' )";
    
    if ($connexion->query($requete) === TRUE) {
        echo "connecter";
    } else {
        echo "Erreur : " . $requete . "<br>" . $connexion->error;
    }

    // Fermer la connexion à la base de données
    $connexion->close();
}
?>
