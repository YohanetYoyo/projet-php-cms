<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page</title>
    <link rel="stylesheet" href="css/main.css">
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
        <h1><?= htmlspecialchars($page['title']) ?></h1>
    </header>

    <main>
        <div class="page-info">
            <p><?= htmlspecialchars($page['content']) ?></p>
        </div>
        <?php
    } else {
        ?>
        <p>La page n'est pas configurée</p>
        <?php
    }
    ?>
    <br>
    <a href="/index"><button type="button" class="button button--secondary">Retour à l'accueil</button></a>
    </main>
    <?php
}
?>
</body>
</html>
