<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
        <title>Foorumi</title>
    </head>
    <body>
        <div class="sivu">
            <?php if (!empty($data->virhe)): ?>
                <div class="alert alert-danger">Virhe: <?php echo $data->virhe; ?></div>
                <br>
                <br>
                <?php
            endif;
            require 'views/' . $kirj . '.php';
            ?>
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
            <?php require 'views/' . $sivu . '.php'; ?>
            <!-- Sivukohtainen alue loppuu -->
        </div>
    </body>
</html>
