<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
?>
    <header>
        <h1>Bienvenue, <?= $_SESSION['user']->getLastname(). " ". $_SESSION['user']->getFirstname(). " !" ?></h1>
        <small><a href="/account">Gérer mon compte</a></small>
    </header>
    <main>
        <?php
        if ($_SESSION['user']->getIsAdmin() == 1):
        ?>
        <table>
            <tr>
                <td><a href="/manage-users"><button type="button" class="button button--primary">Gestion des utilisateurs</button></a></td>
            </tr>
        </table>
        <br>
        <?php
        endif;
        ?>
        </br>
        <h2>Vos pages</h2>
        <?php if (!empty($pages)): ?>
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Slug</th>
                        <th>Statut</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?= htmlspecialchars($page['title']) ?></td>
                            <td><?= htmlspecialchars($page['slug']) ?></td>
                            <td><?= htmlspecialchars($page['status']) ?></td>
                            <td><?= htmlspecialchars($page['created_at']) ?></td>
                            <td>
                                <a href="/modify-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--primary">Modifier</button></a>
                                <a href="/delete-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--danger">Supprimer</button></a>
                                <a href="/publish-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--primary">Publier</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Vous n'avez pas encore créé de page.</p>
        <?php endif; ?>
        <br>
        <table>
            <tr>
                <td><a href="/create-page"><button type="button" class="button button--primary">Créer une nouvelle page</button></a></td>
            </tr>
        </table>
        <br>
        <h2>Autres pages</h2>
        <?php if (!empty($otherPages)): ?>
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Slug</th>
                    <th>Statut</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($otherPages as $page): ?>
                    <tr>
                        <td><?= htmlspecialchars($page['title']) ?></td>
                        <td><?= htmlspecialchars($page['slug']) ?></td>
                        <td><?= htmlspecialchars($page['status']) ?></td>
                        <td><?= htmlspecialchars($page['created_at']) ?></td>
                        <td>
                            <?php if ($page['id_role'] == 1): ?>
                            <a href="/modify-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--primary">Modifier</button></a>
                            <a href="/delete-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--danger">Supprimer</button></a>
                            <a href="/publish-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--primary">Publier</button></a>
                            <?php elseif ($page['id_role'] == 2): ?>
                            <a href="/modify-page?id=<?= htmlspecialchars($page['id_page']) ?>"><button type="button" class="button button--primary">Modifier</button></a>
                            <?php elseif ($page['id_role'] == 3): ?>
                            <a href="/page/<?= htmlspecialchars($page['slug']) ?>"><button type="button" class="button button--primary">Voir</button></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Vous n'avez pas accès à d'autres pages.</p>
        <?php endif; ?>
    </main>
    <br>
    <form method="post" action="/home">
        <button type="submit" class="button button--secondary">Déconnexion</button>
    </form>
<?php
}
?>
</body>
</html>