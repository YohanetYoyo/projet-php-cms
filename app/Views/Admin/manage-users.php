<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/css/main.css">
    <script>
        function deleteAccount(deletionForm) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce compte ?") === true) {
                document.getElementById(deletionForm).submit();
            } else {
                return false;
            }
        }
    </script>
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button><a/>";
} else {
    if ($_SESSION['user']->getIsAdmin() != 1) {
        echo "Vous n'êtes pas autorisé à visionner cette page !";
        echo "<a href='/index'><button type='button' class='button button--primary'>Cliquez ici pour retourner à l'accueil</button><a/>";
    } else {
    ?>
    <header>
        <div class="container">
            <h1>Gestion des utilisateurs</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <a href="/create-user"><button type="button" class="button button--primary">Créer un utilisateur</button></a>
            <h2>Utilisateurs actuels</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Admin ?</th>
                    <th>Créé le</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php
                foreach($users as $user):
                    if ($user['id_user'] != $_SESSION['user']->getIdUser()):
                        ?>
                        <tr>
                            <td><?= $user['lastname']?></td>
                            <td><?= $user['firstname']?></td>
                            <td><?= $user['email']?></td>
                            <td><?= $user['is_admin']?></td>
                            <td><?= $user['created_at']?></td>
                            <td>
                                <form method="post" action="/manage-users/update">
                                    <input type="hidden" name="idUser" value="<?= $user['id_user']?> ?>">
                                    <button type="submit" class="button button--primary">Modifier</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/manage-users/delete">
                                    <input type="hidden" name="idUser" value="<?= $user['id_user']?> ?>">
                                    <button onclick="return deleteAccount('deletionForm')" type="submit" class="button button--danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    endif;
                endforeach;
                ?>
            </table>
            <a href="/index"><button type="button" class="button button--secondary">Retour vers l'accueil</button></a>
        </div>
    </main>
    <?php
    }
}
?>
</body>
</html>