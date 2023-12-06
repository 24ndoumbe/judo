
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de Présence/Absence</title>
</head>
<body>
    <h2>Choisissez votre présence/absence</h2>

    <?php


function fetchCoursFromDatabase() {
    $host = "localhost:3306";
    $user = "root";
    $password = "123456789";
    $database = "judo_club";

    $connexion = new mysqli($host, $user, $password, $database);

// je vérifie la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}



    $sql = "SELECT * FROM Cours WHERE date >= NOW()";

    $result = $connexion->query($sql);
    // je récupére les résultats en tant que tableau associatif
    $coursExistants = $result->fetch_all(MYSQLI_ASSOC);

    return $coursExistants;
    }

    // je récupére les cours disponibles depuis la base de données
    $coursExistants = fetchCoursFromDatabase();
    $cours = fetchCoursFromDatabase();

    var_dump($cours);

    // formulaire pour afficher le cour
    foreach ($cours as $leCours) {
        echo "<form action='traitement.php' method='post'>";
        echo "<input type='hidden' name='id_cours' value='" . $leCours['idcours'] . "'>";
        echo "<input type='hidden' name='idcrédentials' value='" . ['idcrédentials'] . "'>";
       // echo "<input type='hidden' name='presence' value='" . ['presence'] . "'>";
        echo "<p>Date: " . $leCours['date'] . "</p>";
        echo "<p>Heure de début: " . $leCours['heure_debut'] . "</p>";
        echo "<p>Heure de fin: " . $leCours['heure_fin'] . "</p>";
        echo "<label>Présent<input type='radio' name='presence' value='PRESENT'></label>";
        echo "<label>Absent<input type='radio' name='presence' value='ABSENT'></label>";
        echo "<input type='submit' value='Enregistrer'>";
        echo "</form>";
    }
    ?>

</body>
</html>
