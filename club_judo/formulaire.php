<?php
include 'connexion.php';

// Assurez-vous d'avoir inclus votre fichier de connexion à la base de données ici

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prénom = $_POST["prénom"];
    $date_de_naissance = $_POST["date_de_naissance"];
    $age = $_POST["age"];
    $poids = $_POST["poids"];
    $catégorie = $_POST["catégorie"];
    $adresse_mail = $_POST["adresse_mail"];
    $sexe = $_POST["sexe"];
   
    

    // Validation des données (vous pouvez ajouter des vérifications supplémentaires ici)

    // Préparer et exécuter la requête SQL
    $requete = "INSERT INTO users (nom, prénom, date_de_naissance, age, poids, catégorie, adresse_mail, sexe) VALUES ('$nom', '$prénom', '$date_de_naissance','$age', '$poids', '$catégorie', '$adresse_mail', '$sexe' )";
    //$result = $requete->execute();
    if ($requete) {
        echo "vous etes bien enregistrer";
        //echo"<script type=\"text/javascript\> alert('Vous etes bien enregistré.')</script>";
    } else {
       echo"probleme";
       // echo "Erreur : " . $requete . "<br>" . $connexion->error;
    }

    // Fermer la connexion à la base de données
    $connexion->close();
}
?>
