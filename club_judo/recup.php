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
    <h2>Liste des Cours</h2>
    <table>
        <thead>
            <tr>
                <th>nom</th>
                <th>prenom</th>
                <th>Heure de Fin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Votre connexion à la base de données ici

            $dsn = 'mysql:dbname=judo_club; host=localhost:3306';
            $user = "root";
            $password = "123456789";
            try {
                $pdo = new PDO($dsn, $user, $password);
            } catch (PDOException $e) {
                print "Erreur" . $e->getMessage() . "<br>";
                die();
            }

            $sql = "SELECT * FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $u) {
                echo "<tr>";
                echo "<td>{$u['nom']}</td>";
                echo "<td>{$u['prénom']}</td>";
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
