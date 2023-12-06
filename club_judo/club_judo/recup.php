<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cours</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Liste des adhérents</h2>
    <table>
        <thead>
            <tr>
                <th>nom</th>
                <th>prenom</th>
                <th>presence</th>
                <th>cours</th>
                
            </tr>
        </thead>
        <tbody>
            <?php


        include 'connexion.php';

        
        //$id_cours = 'id_cours'; 
        $id_cours = 'id_cours'; 
        



        try {
            $sql = "SELECT users.nom, users.prénom, present.presence, cours.date
            FROM present
            JOIN credentials ON credentials.idcrédentials = present.idcrédentials
            JOIN users ON idusers = fk_cred
            JOIN cours ON id_cours = id_cours
            WHERE present.presence = presence AND present.id_cours = id_cours";
            
            $stmt = $connexion->prepare($sql);
            $stmt->bind_param("i", $id_cours );
            $stmt->execute();
            $result = $stmt->get_result();

            // j'affiche les noms et prénoms des utilisateurs présents
            while ($row = $result->fetch_assoc()) {
                echo "Nom: " . $row['nom'] . ", Prénom: " . $row['prenom'] . ", presence: " . $row['presence'] . ",date: " . $row['date'] . "<br>";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des utilisateurs présents : " . $e->getMessage();
        }

        $connexion->close();
        




            // Votre connexion à la base de données ici

            /*$dsn = 'mysql:dbname=judo_club; host=localhost:3306';
            $user = "root";
            $password = "123456789";
            try {
                $pdo = new PDO($dsn, $user, $password);
            } catch (PDOException $e) {
                print "Erreur" . $e->getMessage() . "<br>";
                die();
            }

            $sql = "SELECT users.nom, users.prénom, present.presence, cours.date
            FROM present
            JOIN credentials ON credentials.idcrédentials = present.idcrédentials
            JOIN users ON idusers = fk_cred
            JOIN cours ON id_cours = id_cours
            WHERE present.presence = presence AND present.id_cours = id_cours";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($present as $p) {
                echo "<tr>";
                echo "<td>{$u['nom']}</td>";
                echo "<td>{$u['prénom']}</td>";
                echo "<td>{$p['presence']}</td>";
                echo "<td>{$c['cours']}</td>";
                
                echo "</tr>";
            }*/
            ?>
        </tbody>
    </table>
</body>
</html>
