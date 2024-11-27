<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Films - FilmoTeca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Ma Collection de Films</h1>
        <nav>
            <a href="index.html">Accueil</a>
            <a href="ajouter_film.html">Ajouter un Film</a>
            <a href="liste_films.php">Liste des Films</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <section class="film-list-section">
        <h2>Liste des Films</h2>
        <table class="film-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Année</th>
                    <th>Synopsis</th>
                    <th>Réalisateur</th>
                    <th>Date de Création</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "filmoteca");

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                $sql = "SELECT id, title, year, synopsis, director, `created-at`, genre FROM movie";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["year"] . "</td>";
                        echo "<td>" . $row["synopsis"] . "</td>";
                        echo "<td>" . $row["director"] . "</td>";
                        echo "<td>" . $row["created-at"] . "</td>";
                        echo "<td>" . $row["genre"] . "</td>";
                        echo "<td>
                                <button class='edit-btn'>Éditer</button>
                                <button class='delete-btn'>Supprimer</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Aucun film trouvé.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 FilmoTeca. Tous droits réservés.</p>
    </footer>

</body>
</html>