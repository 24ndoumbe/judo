<?php

include 'connexion.php';
session_start();
header('Location: cours.html');
/*if (!isset($_SESSION['idcrédentials'])) {
    header('Location: cours.html');
}else {
    // Redirige l'utilisateur vers la page de choix si le formulaire n'a pas été soumis
    header('Location: choix.php');
    exit();
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cours = $_POST['id_cours'];
    $idcrédentials = $_SESSION['idcrédentials'];
    $presence = $_POST['presence'];
   
    
    var_dump($_SESSION);
    
    
    
    
    try {
        
        // Requête SQL pour insérer les données dans la table "presence"
        $sql_present = "INSERT INTO PRESENT (id_cours, idcrédentials, presence) VALUES (?, ?, ?)";
        $stmt_present = $connexion->prepare($sql_present);
        $stmt_present->bind_param("iis", $id_cours, $idcrédentials, $presence);
        $stmt_present->execute();
        $stmt_present->close();

        echo "Présence/Absence enregistrée avec succès.";
    } catch (Exception $e) {
        echo "Erreur lors de l'enregistrement de la présence/absence : " . $e->getMessage();
    }
}

$connexion->close();


?>
