<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer mon compte</title>
    <link rel="stylesheet" href="css/main.css">
    <script>
        function deleteAccount(deletionForm) {
            if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?") === true) {
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
    echo "<a href='?page=login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
    ?>
    <header>
        <h1>Gérer mon compte</h1>
    </header>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
            ?>
            <h2 style="color: red;"><?= $error ?></h2>
        <?php
        endforeach;
    endif;
    ?>
    <form method="post" action="/account/update">
        <table>
            <tr>
                <td>
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? $_SESSION['user']->getLastname() ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? $_SESSION['user']->getFirstname() ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email :</label>
                </td>
                <td>
                    <input id="email" type="email" name="email" value="<?= $email ?? $_SESSION['user']->getEmail() ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Modifier</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <form method="post" action="/account/delete" id="deletionForm">
        <button onclick="return deleteAccount('deletionForm')" style="background-color: lightcoral;">Supprimer mon compte</button>
    </form>
    <br>
    <a href="/index"><button type="button">Retour vers l'accueil</button></a>
    <?php
}
?>
</body>
</html>