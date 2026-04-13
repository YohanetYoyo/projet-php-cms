<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une page</title>
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

        if (!empty($page) && !empty($role)) {
        ?>
            <form method="post" action="/modify-page">
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

                <?php if (!empty($users) && $role['id_role'] == 1): ?>
                <table border="1" style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Rôle</th>
                        <th>Cochez pour retirer accès</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td>
                                <select name="roles[<?= $user['id_user'] ?>]">
                                    <option value="1" <?= $user['id_role'] === 1 ? 'selected' : '' ?>>Administrateur</option>
                                    <option value="2" <?= $user['id_role'] === 2 ? 'selected' : '' ?>>Éditeur</option>
                                    <option value="3" <?= $user['id_role'] === 3 ? 'selected' : '' ?>>Visiteur</option>
                                </select>
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                            </td>
                            <td>
                                <input type="checkbox" name="delete[]" value="<?= $user['id_user'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <br><br>

                <button type="submit" class="button button--primary">
                    Mettre à jour la page
                </button>

                <a href="/home"><button type="button" class="button button--secondary">
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
