<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier/Dépublier une page</title>
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
        <h1>Publier/Dépublier une page</h1>
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
                <p><strong>Statut actuel :</strong> <span style="font-weight: bold; color: #007bff;"><?= htmlspecialchars($page['status']) ?></span></p>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($page['author']) ?></p>
                <p><strong>Créée le :</strong> <?= htmlspecialchars($page['created_at']) ?></p>
            </div>

            <div class="content-preview">
                <h3>Aperçu du contenu :</h3>
                <p><?= substr(htmlspecialchars($page['content']), 0, 200) ?>...</p>
            </div>

            <form method="post">
                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                
                <label for="status"><strong>Nouveau statut :</strong></label>
                <select name="status" id="status" required>
                    <option value="draft" <?= $page['status'] == 'draft' ? 'selected' : '' ?>>Brouillon (draft)</option>
                    <option value="published" <?= $page['status'] == 'published' ? 'selected' : '' ?>>Publié (published)</option>
                    <option value="archived" <?= $page['status'] == 'archived' ? 'selected' : '' ?>>Archivé (archived)</option>
                </select>
                
                <br><br>
                
                <button type="submit" style="background-color: #28a745; color: white; padding: 10px 20px;">
                    Mettre à jour le statut
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
