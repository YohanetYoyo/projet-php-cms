<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une page</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button></a>";
} else {
?>
    <header>
        <h1>Supprimer une page</h1>
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
            <div class="page-info">
                <h2><?= htmlspecialchars($page['title']) ?></h2>
                <p><strong>Slug :</strong> <?= htmlspecialchars($page['slug']) ?></p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($page['status']) ?></p>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($page['author']) ?></p>
                <p><strong>Créée le :</strong> <?= htmlspecialchars($page['created_at']) ?></p>
            </div>

            <div class="content-preview">
                <h3>Aperçu du contenu :</h3>
                <p><?= substr(htmlspecialchars($page['content']), 0, 200) ?>...</p>
            </div>

            <div class="warning">
                <p style="color: red; font-weight: bold;">⚠️ ATTENTION : Cette action est irréversible !</p>
            </div>

            <form method="post">
                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                <button type="submit" class="button button--danger">
                    Supprimer la page
                </button>
                <a href="/home"><button type="button" class="button button--secondary">
                    Annuler
                </button></a>
            </form>
        <?php
        } else {
        ?>
            <p>Aucune page sélectionnée.</p>
            <a href="/home"><button type="button" class="button button--secondary">Retour à l'accueil</button></a>
        <?php
        }
        ?>
    </main>
<?php
}
?>
</body>
</html>
