<?php

include 'common/header.php';
?>

<p>Tervetuloa foorumin jäseneksi!</p>
<form id="rekisteroityminen" class="kirjautuminen">
    Käyttäkätunnus: <input type="text" id="tunnus">
    <br>
    Salasana: <input type="password" id="salasana">
    <br>
    <input type="checkbox" name="lupaus">Lupaan käyttäytyä ihmisiksi
    <br>
    <button onclick="" id="kirjaudu">Rekisteröidy</button>
</form> 

<?php

include 'common/footer.php';
