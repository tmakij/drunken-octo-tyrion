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
            <!-- Virhe alue alkaa -->
            <?php if (!empty($varoitus)): ?>
                <div class="alert alert-danger">Virhe: <?php echo sanitize($varoitus); ?></div>
                <br>
                <br>
            <?php endif; ?>
            <!-- Virhe alue loppuu -->
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
                <?php
                echo $link_index;
                echo $link_search;
                echo $link_register;
                echo $link_admin;
                ?>
            </ul>
            <br>
            <br>
            <!-- Sivukohtainen alue alkaa -->
            <?php require_once 'views/' . $sivu . '.php'; ?>
            <!-- Sivukohtainen alue loppuu -->
        </div>
    </body>
</html>
