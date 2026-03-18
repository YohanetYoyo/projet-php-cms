<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='?page=login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
?>
    <header>
        <h1>Bienvenue, <?= $_SESSION['user']->getLastname(). " ". $_SESSION['user']->getFirstname(). " !" ?></h1>
        <small><a href="?page=account">Gérer mon compte</a></small>
    </header>
    <main>
        <?php
        if ($_SESSION['user']->getIsAdmin() == 1):
        ?>
        <table>
            <tr>
                <td><a href="?page=manage-users"><button type="button">Gestion des utilisateurs</button></a></td>
            </tr>
        </table>
        <br>
        <?php
        endif;
        ?>
        <table>
            <tr>
                <td><a href="?page=create-page"><button type="button">Créer une page</button></a></td>
                <td><a href="#"><button type="button">Modifier une page</button></a></td>
                <td><a href="#"><button type="button">Supprimer une page</button></a></td>
                <td><a href="#"><button type="button">Publier/Dépublier</button></a></td>
            </tr>
        </table>
    </main>
    <br>
    <form method="post" action="?page=home">
        <button type="submit">Déconnexion</button>
    </form>
<?php
}
?>
</body>
</html>