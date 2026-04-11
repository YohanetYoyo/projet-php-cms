<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un utilisateur</title>
    <link rel="stylesheet" href="css/main.css">
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
    <h1>Créer un utilisateur</h1>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
    ?>
        <h2 style="color: red;"><?= $error ?></h2>
    <?php
        endforeach;
    endif;
    ?>
</header>
    <form method="post" action="/create-user">
        <table>
            <tr>
                <td>
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? "" ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? "" ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email :</label>
                </td>
                <td>
                    <input id="email" type="email" name="email" value="<?= $email ?? "" ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pwd">Mot de passe :</label>
                </td>
                <td>
                    <input id="pwd" type="password" name="pwd" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="confirmPwd">Confirmer mot de passe :</label>
                </td>
                <td>
                    <input id="confirmPwd" type="password" name="confirmPwd" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Admin :</label>
                </td>
                <td>
                    <label for="isAdmin">Oui :</label>
                    <input id="isAdmin" type="radio" name="isAdmin" value="1">
                    <br>
                    <label for="isNotAdmin">Non :</label>
                    <input id="isNotAdmin" type="radio" name="isAdmin" value="0">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">S'inscrire</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <a href="/manage-users"><button type="button">Retour vers gestion des utilisateurs</button></a>
    <?php
    }
}
?>
</body>
</html>