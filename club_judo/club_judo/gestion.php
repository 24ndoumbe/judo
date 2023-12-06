<?php
include 'connexion.php';
session_start();

// je vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // je récupére les données du formulaire
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $status = $_POST['status'];
   

    // Requête SQL pour ajouter le cours à la base de données
    $sql = "INSERT INTO COURS (date, heure_debut, heure_fin, status) VALUES ('$date', '$heure_debut', '$heure_fin', '$status')";

    // Exécutez la requête
    if ($connexion->query($sql) === TRUE) {
        // Récupérer le nouvel ID du cours ajouté
    $nouvelID = $connexion->insert_id;

    // Récupérer les détails du nouveau cours
    $nouveauCours = ["id" => $nouvelID, "date" => $date, "heure_debut" => $heure_debut, "heure_fin" => $heure_fin, "status" => $status];

    // Renvoyer les détails du nouveau cours en tant que réponse JSON
    echo json_encode($nouveauCours);
        $response = "Cours ajouté avec succès.";
    } else {
        $response = "Erreur lors de l'ajout du cours : " . $connexion->error;
    }
}
$connexion->close();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Gestion des Cours</title>
    <h1 style="text-align: center;">Gestion des Cours</h1>
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    form {
        max-width: 1000px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-bottom: 20px;
    }


        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    main {
        padding: 20px;
    }

    #dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 20px;
        align-items: center;
        justify-content: center;
    }

    .widget {
        background-color: #f0f0f0;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <h1 style="text-align: center;">Gestion des Cours</h1>
    <h2 style="text-align: center;">Ajouter un Cours</h2>
    <form action="gestion.php" method="post" class="center-form";>
        <label for="date">Date:</label>
        <input type="date" name="date" required><br><br>
        
        <label for="heure_debut">Heure de Début:</label>
        <input type="time" name="heure_debut" required><br><br>
        
        <label for="heure_fin">Heure de Fin:</label>
        <input type="time" name="heure_fin" required><br><br>
        
        <label for="status">Status:</label>
        <select name="status" required>
            <option value=""></option>
            <option value="maintenu">Maintenu</option>
            <option value="annulé">Annulé</option>
        </select><br>
        <br>
        
        <input type="submit" value="Ajouter Cours" > <br><br>
    </form>

    <main>
        <div id="dashboard">
            <div class="widget">
            <h2 style="text-align: center;">Statistique des Cours</h2>
                <canvas id="barChart"></canvas>
                <br>
            </div>
        </div>
    </main>

    <script>
        
//Récupérez le contexte du canevas
var ctx = document.getElementById('barChart').getContext('2d');

// Définissez les données du diagramme à barres
var data = {
    labels: ['suivis', 'Non suivis', 'annulés'],
    datasets: [{
        label: 'nombre de cours',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        data: [700, 900, 860]
    }]
};

// Configurez le type de diagramme et affichez-le
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
    
</body>

</body>

</html>




</html>
