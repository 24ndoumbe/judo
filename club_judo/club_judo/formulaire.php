<?php
include 'connexion.php';

// je récupére les données du formulaire
$nom = $_POST['nom'];
$prénom = $_POST['prénom'];
$date_de_naissance = $_POST['date_de_naissance'];
$age = $_POST['age'];
$poids = $_POST['poids'];
$catégorie = $_POST['catégorie'];
$adresse_mail = $_POST['adresse_mail'];
$password = $_POST['password'];
$sexe = $_POST['sexe'];
$fk_cred = ['cred_fk'];

try {
    // je démarre la transaction
    $connexion->begin_transaction();

    // Requête SQL pour insérer les données dans la table "CREDENTIALS"
    $sql_credentials = "INSERT INTO CREDENTIALS (adresse_mail, password) VALUES (?, ?)";
    $stmt_credentials = $connexion->prepare($sql_credentials);
    $stmt_credentials->bind_param("ss", $adresse_mail, $password);
    // je spécifie les valeurs des paramètres
    $adresse_mail = $_POST['adresse_mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // j'exécute la requête
    $stmt_credentials->execute();
    // je récupére l'ID généré automatiquement
    $id_credentials = $stmt_credentials->insert_id;
    $stmt_credentials->close();
    // j'utilise l'ID généré dans la requête suivante
    $fk_cred = $id_credentials;



// Requête SQL pour insérer les données dans la table "USERS"
    $sql_users = "INSERT INTO USERS (nom, prénom, date_de_naissance, age, poids, catégorie, adresse_mail, password, sexe,fk_cred) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_users = $connexion->prepare($sql_users);
    $stmt_users->bind_param("sssisssssi", $nom, $prénom, $date_de_naissance, $age, $poids, $catégorie, $adresse_mail, $password, $sexe, $fk_cred);
    $stmt_users->execute();
    $stmt_users->close();

    // je valide la transaction
    $connexion->commit();
    echo "Utilisateur ajouté avec succès.";
} catch (Exception $e) {
    // nous permet d'annuler la transaction
    $connexion->rollback();
    echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
}

$connexion->close();
?>





