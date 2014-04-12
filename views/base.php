<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <title>Foorumi</title>
    </head>
    <body>
        <div class="sivu">
            <!-- Viesti alue alkaa -->
            <?php if (!empty($varoitus)): ?>
                <div class="alert alert-danger">Virhe: <?php echo sanitize($varoitus); ?></div>
                <br>
                <br>
            <?php endif; ?>
            <?php if (!empty($onnistuminen)): ?>
                <div class="alert alert-success">
                    <?php echo sanitize($onnistuminen); ?>
                </div>
            <?php endif; ?>
            <!-- Viesti alue loppuu -->
            <!-- Tervehdys alue alkaa -->
            <?php require 'views/' . $kirj . '.php'; ?>
            <!-- Tervehdys alue loppuu -->
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <ul class="nav nav-tabs">
                <li><a href="index.php">Etusivu</a></li>
                <li><a href="search.php">Haku</a></li>
                <?php if ($ryhma->paaseeSivulle('register.php')): ?>
                    <li><a href="register.php">Rekisteröidy</a></li>
                <?php endif; ?>
                <?php if ($ryhma->paaseeSivulle('admin.php')): ?>
                    <li><a href="admin.php">Hallinta</a></li>
                <?php endif; ?>  
            </ul>
            <br>
            <br>
            <!-- Sivukohtainen alue alkaa -->
            <?php require_once 'views/' . $sivu . '.php'; ?>
            <!-- Sivukohtainen alue loppuu -->
        </div>
    </body>
</html>
