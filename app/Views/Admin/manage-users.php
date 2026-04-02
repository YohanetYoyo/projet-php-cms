<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="../../../style.css">
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
    echo "<a href='/login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
    if ($_SESSION['user']->getIsAdmin() != 1) {
        echo "Vous n'êtes pas autorisé à visionner cette page !";
        echo "<a href='/index'><button type='button'>Cliquez ici pour retourner à l'accueil</button><a/>";
    } else {
    ?>
    <header>
        <h1>Gestion des utilisateurs</h1>
    </header>
    <main>
        <a href="/create-user"><button type="button">Créer un utilisateur</button></a>
        <br><br>
        <table border="1px">
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
                        <button type="submit">Modifier</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="/manage-users/delete">
                        <input type="hidden" name="idUser" value="<?= $user['id_user']?> ?>">
                        <button onclick="return deleteAccount('deletionForm')" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php
                  endif;
            endforeach;
            ?>
        </table>
    </main>
    <br>
    <a href="/index"><button type="button">Retour vers l'accueil</button></a>
    <?php
    }
}
?>
</body>
</html>