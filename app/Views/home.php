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
                        <th colspan="3">Actions</th>
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
                                <form method="post" action="/modify-page/showUpdate">
                                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                    <button type="submit" class="button button--primary">Modifier</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/delete-page/showDelete">
                                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                    <button type="submit" class="button button--danger">Supprimer</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/publish-page/showPublish">
                                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                    <button type="submit" class="button button--primary">Publier</button>
                                </form>
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
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($otherPages as $page): ?>
                    <tr>
                        <td><?= htmlspecialchars($page['title']) ?></td>
                        <td><?= htmlspecialchars($page['slug']) ?></td>
                        <td><?= htmlspecialchars($page['status']) ?></td>
                        <td><?= htmlspecialchars($page['created_at']) ?></td>
                        <?php if ($page['id_role'] == 1): ?>
                        <td>
                            <form method="post" action="/modify-page/showUpdate">
                                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                <button type="submit" class="button button--primary">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="/delete-page/showDelete">
                                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                <button type="submit" class="button button--danger">Supprimer</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="/publish-page/showPublish">
                                <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                <button type="submit" class="button button--primary">Publier</button>
                            </form>
                        </td>
                        <?php elseif ($page['id_role'] == 2): ?>
                            <td>
                                <form method="post" action="/modify-page/showUpdate">
                                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                    <button type="submit" class="button button--primary">Modifier</button>
                                </form>
                            </td>
                            <?php elseif ($page['id_role'] == 3): ?>
                            <td>
                                <form method="post" action="/delete-page/showDelete">
                                    <input type="hidden" name="id_page" value="<?= htmlspecialchars($page['id_page']) ?>">
                                    <button type="submit" class="button button--danger">Supprimer</button>
                                </form>
                            </td>
                            <?php endif; ?>
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