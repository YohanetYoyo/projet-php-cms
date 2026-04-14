<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button></a>";
} else {
    $show = false;
    if (!empty($page)) {
        if (!empty($role)) {
            if ($role['id_role'] == 3 && $page['status'] != 'published') {
                echo "La page n'a pas encore été publiée !";
                echo "<a href='/index'><button type='button' class='button button--primary'>Cliquez ici pour retourner à l'accueil</button><a/>";
            } else {
                $show = true;
            }
        } else {
            echo "Vous n'êtes pas autorisé à visionner cette page !";
            echo "<a href='/index'><button type='button' class='button button--primary'>Cliquez ici pour retourner à l'accueil</button><a/>";
        }
    }
    if ($show) {
    ?>
    <header>
        <div class="container">
            <h1><?= htmlspecialchars($page['title']) ?></h1>
        </div>
    </header>
    <main>
        <div class="container">
            <p><?= htmlspecialchars($page['content']) ?></p>
        <?php
    } else {
        ?>
        <p>La page n'est pas configurée</p>
        <?php
    }
    ?>
    <a href="/index"><button type="button" class="button button--secondary">Retour à l'accueil</button></a>
    </div>
    </main>
    <?php
}
?>
</body>
</html>
