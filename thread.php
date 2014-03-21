<?php
include 'common/header.php';
$ketju = $_GET['id'];
?>
<div>
    <a href="response.php?id=<?php echo $ketju; ?>">Vastaa</a>
    <p>Aihe: Rupattelu</p>
    <p>Uusi foorumi</p>
    <br>
    <div>
        <div>
            <p>Matti Meikäinen</p>
            <br>
            <p>Ylläpitäjä</p>
        </div>
        <div>
            <p>12.51 1.1.1000</p>
            <p>On kyllä hieno!</p>
        </div>
    </div>
</div>
<?php
include 'common/footer.php';
