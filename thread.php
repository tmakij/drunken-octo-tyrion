<?php
include 'common/header.php';
$ketju = $_GET['id'];
?>
<div class="viestiketju">
    <a href="response.php?id=<?php echo $ketju; ?>">Vastaa</a>
    <p>Aihe: Rupattelu</p>
    <p>Otsikko: Uusi foorumi</p>
    <br>
    <div class="fviesti">
        <div class="henkilo">
            <p>Matti Meikäinen</p>
            <br>
            <p>Ylläpitäjä</p>
        </div>
        <div class="sisalto">
            <p>12.51 1.1.1000</p>
            <p>On kyllä hieno!</p>
        </div>
    </div>
</div>
<?php
include 'common/footer.php';
