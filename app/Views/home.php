<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='?page=login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>
    <header>
        <h1>Bienvenue, <?= $_SESSION['user']->getLastname(). " ". $_SESSION['user']->getFirstname(). " !" ?></h1>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
            ?>
            <h2 style="color: red;"><?= $error ?></h2>
        <?php
        endforeach;
    endif;
    ?>
    </header>
    <form method="post" action="?page=home">
        <button type="submit">Déconnexion</button>
    </form>
    </body>
    </html>
<?php
}