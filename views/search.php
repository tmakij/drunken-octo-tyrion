<p>Hae viestejä</p>
<form action="search.php" method="POST" class="haku">
    Käyttäjä: <input type="text" name="haku_kayttaja_nimi">
    <br>
    Aihe: <?php require 'views/aiheet.php'; ?>
    <br>
    Aika: <input type="datetime" name="aika_alku">-<input type="datetime" name="aika_loppu">
    <br>
    <button type="submit">Hae</button>
</form> 
