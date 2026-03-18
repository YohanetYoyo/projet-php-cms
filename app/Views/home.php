<!DOCTYPE html>
<html lang="fr">
<head>
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
        <a href="?page=manage-users"><button type="button">Gestion des utilisateurs</button></a>
        <?php
        endif;
        ?>
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