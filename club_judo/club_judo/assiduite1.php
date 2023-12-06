<?php

include 'connexion.php';
header("Location: http://localhost/club_judo/choix.php");

session_start();

//je vérifie si l'utilisateur est déjà authentifié
if (isset($_SESSION['adresse_mail'])) {
    // Rediriger vers la page de cours si l'utilisateur est déjà connecté
    header("Location: choix.php");
    exit(); 
}




// je vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}


    $adresse_mail = $_POST['adresse_mail'];
    $password = $_POST['password'];
try{
    
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
    $_SESSION['idcrédentials'] = $id_credentials;
    var_dump($_SESSION);


    $stmt_credentials->close();


    
    

} catch (Exception $e) {
    // nous permet d'annuler la transaction
    $connexion->rollback();
    echo "Erreur lors de la connexion : " . $e->getMessage();
}



$connexion->close();
?>
