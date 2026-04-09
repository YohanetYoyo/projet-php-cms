<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une page</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button'>Cliquez ici pour vous connecter</button></a>";
} else {
?>
    <header>
        <h1>Modifier une page</h1>
    </header>

    <main>
        <?php
        if (!empty($errors)) {
            echo "<div class='errors'>";
            foreach ($errors as $error) {
                echo "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
            }
            echo "</div>";
        }

        if (!empty($page)) {
        ?>
            <form method="post">
                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">

                <label for="title"><strong>Titre :</strong></label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($page['title']) ?>" required>

                <label for="slug"><strong>Slug :</strong></label>
                <input type="text" name="slug" id="slug" value="<?= htmlspecialchars($page['slug']) ?>" required>

                <label for="author"><strong>Auteur :</strong></label>
                <input type="text" name="author" id="author" value="<?= htmlspecialchars($page['author']) ?>">

                <label for="status"><strong>Statut :</strong></label>
                <select name="status" id="status" required>
                    <option value="draft" <?= $page['status'] == 'draft' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= $page['status'] == 'published' ? 'selected' : '' ?>>Publié</option>
                    <option value="archived" <?= $page['status'] == 'archived' ? 'selected' : '' ?>>Archivé</option>
                </select>

                <label for="content"><strong>Contenu :</strong></label>
                <textarea name="content" id="content" rows="10" required><?= htmlspecialchars($page['content']) ?></textarea>

                <br><br>

                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px;">
                    Mettre à jour la page
                </button>

                <a href="/home"><button type="button" style="background-color: gray; color: white; padding: 10px 20px;">
                    Annuler
                </button></a>
            </form>
        <?php
        } else {
        ?>
            <p>Aucune page sélectionnée.</p>
            <a href="/home"><button type="button">Retour à l'accueil</button></a>
        <?php
        }
        ?>
    </main>

    <br>
    <form method="post" action="/home">
        <button type="submit">Déconnexion</button>
    </form>
<?php
}
?>
</body>
</html>
