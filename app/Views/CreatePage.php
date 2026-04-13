<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une page</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button></a>";
} else {
?>
    <header>
        <div class="container">
            <h1>Créer une page</h1>
            <?php
            if (!empty($errors)) {
                echo "<div class='errors'>";
                foreach ($errors as $error) {
                    echo "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </header>
    <main>
        <div class="container">
            <form method="post">
                <div>
                    <label for="title"><strong>Titre :</strong></label>
                    <input id="title" type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>
                </div>
                <div>
                    <label for="slug"><strong>Slug :</strong></label>
                    <input id="slug" type="text" name="slug" value="<?= htmlspecialchars($slug ?? '') ?>" required>
                </div>
                <div>
                    <label for="author"><strong>Auteur :</strong></label>
                    <input id="author" type="text" name="author" value="<?= htmlspecialchars($author ?? '') ?>">
                </div>
                <div>
                    <label for="status"><strong>Statut :</strong></label>
                    <select id="status" name="status" required>
                        <option value="draft">Brouillon</option>
                        <option value="published">Publié</option>
                        <option value="archived">Archivé</option>
                    </select>
                </div>
                <div>
                    <label for="content"><strong>Contenu :</strong></label>
                    <textarea id="content" name="content" rows="10" cols="50" required><?= htmlspecialchars($content ?? '') ?></textarea>
                </div>
                <button type="submit" class="button button--primary">Créer la page</button>
                <a href="/index"><button type="button" class="button button--secondary">Annuler</button></a>
            </form>
        </div>
    </main>
<?php
}
?>
</body>
</html>