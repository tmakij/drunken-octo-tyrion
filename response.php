<?php
include 'common/header.php';
$ketju = $_GET['id'];
?>
<form id="uusiviesti" class="uusiviesti">
    <p id="otsikko"><?php echo "Otsikko " . $ketju . " (Haetaan tietokannasta)"; ?></p>
    <br>
    <br>
    <textarea rows="25" cols="150" id="sisalto"></textarea>
    <br>
    <button onclick="" id="luo">Läheta</button>
</form> 
<?php
include 'common/footer.php';
