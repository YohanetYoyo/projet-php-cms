<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une page</title>
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
            <h1>Supprimer une page</h1>
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
            <?php
            if (!empty($page)) {
                ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Slug</th>
                            <th>Statut</th>
                            <th>Auteur</th>
                            <th>Créée le</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= htmlspecialchars($page['title']) ?></td>
                                <td><?= htmlspecialchars($page['slug']) ?></td>
                                <td><?= htmlspecialchars($page['status']) ?></td>
                                <td><?= htmlspecialchars($page['author']) ?></td>
                                <td><?= htmlspecialchars($page['created_at']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                <div>
                    <h3>Aperçu du contenu :</h3>
                    <p><?= substr(htmlspecialchars($page['content']), 0, 200) ?>...</p>
                </div>

                <div>
                    <p style="color: red; font-weight: bold;">⚠️ ATTENTION : Cette action est irréversible !</p>
                </div>

                <form method="post" action="/delete-page">
                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                    <button type="submit" class="button button--danger">Supprimer la page</button>
                    <a href="/home"><button type="button" class="button button--secondary">Annuler</button></a>
                </form>
                <?php
            } else {
                ?>
                <p>Aucune page sélectionnée.</p>
                <a href="/home"><button type="button" class="button button--secondary">Retour à l'accueil</button></a>
                <?php
            }
            ?>
        </div>
    </main>
<?php
}
?>
</body>
</html>
