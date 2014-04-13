<p>Hae viestejä</p>
<form action="search.php" method="POST" class="haku">
    Käyttäjä: <input type="text" name="haku_kayttaja_nimi" required>
    <br>
    Aihe: <?php require 'views/aiheet.php'; ?>
    <br>
    Aika välillä: <input type="datetime" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Päiväyksen tulee olla VVVV/MM/PP" name="aika_alku" required>-
    <input pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Päiväyksen tulee olla VVVV/MM/PP" type="datetime" name="aika_loppu" required>
    <p>Ajan tulee olla muodossa vvvv/kk/pp</p>
    <button type="submit">Hae</button>
</form> 
