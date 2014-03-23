<?php
include 'common/header.php';
?>
<form id="uusiviesti" class="uusiviesti">
    Otsikko: <input type="text" id="otsikko">
    <br>
    Aihe:     
    <select>
        <option value="0">Rupattelu</option>
        <option value="1">Juttelu</option>
        <option value="2">Kakut</option>
        <option value="3">Yliopisto</option>
    </select>
    <br>
    <br>
    <textarea rows="25" cols="150" id="sisalto"></textarea>
    <br>
    <button onclick="" id="luo">Läheta</button>
</form> 
<?php
include 'common/footer.php';
