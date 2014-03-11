<?php
include 'test_call.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <title>
            <?php
            echo get_hello_upper();
            ?>
        </title>
    </head>
    <body>
        <?php
        for ($i = 0; $i < 100; $i++) {
            echo get_hello_lower() . '<br>';
        }
        ?>
    </body>
</html>
