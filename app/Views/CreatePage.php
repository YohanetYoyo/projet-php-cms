<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une page</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button'>Cliquez ici pour vous connecter</button></a>";
} else {
?>
    <header>
        <h1>Créer une page</h1>
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
        ?>

        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="title"><strong>Titre :</strong></label>
                    </td>
                    <td>
                        <input id="title" type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="slug"><strong>Slug :</strong></label>
                    </td>
                    <td>
                        <input id="slug" type="text" name="slug" value="<?= htmlspecialchars($slug ?? '') ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="author"><strong>Auteur :</strong></label>
                    </td>
                    <td>
                        <input id="author" type="text" name="author" value="<?= htmlspecialchars($author ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="status"><strong>Statut :</strong></label>
                    </td>
                    <td>
                        <select id="status" name="status" required>
                            <option value="draft">Brouillon</option>
                            <option value="published">Publié</option>
                            <option value="archived">Archivé</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="content"><strong>Contenu :</strong></label>
                    </td>
                    <td>
                        <textarea id="content" name="content" rows="10" cols="50" required><?= htmlspecialchars($content ?? '') ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Créer la page</button>
                        <a href="/home"><button type="button">Annuler</button></a>
                    </td>
                </tr>
            </table>
        </form>
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