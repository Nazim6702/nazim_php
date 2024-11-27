<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Film - Ma Collection de Films</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <section class="add-film-section">
        <h2>Ajouter un Nouveau Film</h2>
        <form action="#" method="POST" class="add-film-form">
            <div class="form-group">
                <label for="title">Titre du Film</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" required>
            </div>

            <div class="form-group">
                <label for="year">Année de Sortie</label>
                <input type="number" id="year" name="year" min="1900" max="2024" required>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea id="synopsis" name="synopsis" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="rating">Note (1 à 5)</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="comment">Commentaire</label>
                <textarea id="comment" name="comment" rows="3"></textarea>
            </div>

            <button type="submit">Ajouter le Film</button>
        </form>
    </section>

</body>
</html>