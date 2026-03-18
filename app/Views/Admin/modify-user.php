<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="../../../style.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='?page=login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
if ($_SESSION['user']->getIsAdmin() != 1) {
    echo "Vous n'êtes pas autorisé à visionner cette page !";
    echo "<a href='?page=index'><button type='button'>Cliquez ici pour retourner à l'accueil</button><a/>";
} else {
    ?>
    <header>
        <h1>Modifier l'utilisateur <?= $user['lastname']. " ". $user['firstname'] ?></h1>
    </header>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
            ?>
            <h2 style="color: red;"><?= $error ?></h2>
        <?php
        endforeach;
    endif;
    ?>
    <form method="post" action="?page=modify-user">
        <table>
            <tr>
                <td>
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? $user['lastname'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? $user['firstname'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email :</label>
                </td>
                <td>
                    <input id="email" type="email" name="email" value="<?= $email ?? $user['email'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Admin :</label>
                </td>
                <td>
                    <label for="isAdmin">Oui :</label>
                    <input id="isAdmin" type="radio" name="isAdmin" value="1" <?= $isAdmin ?? $user['is_admin'] === 1 ? 'checked' : '' ?>>
                    <br>
                    <label for="isNotAdmin">Non :</label>
                    <input id="isNotAdmin" type="radio" name="isAdmin" value="0" <?= $isAdmin ?? $user['is_admin'] === 0 ? 'checked' : '' ?>>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="idUser" value="<?= $idUser ?? $user['id_user'] ?>">
                    <button type="submit">Modifier</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <a href="?page=manage-users"><button type="button">Retour vers gestion des utilisateurs</button></a>
    <?php
    }
}
?>
</body>
</html>