<form id="muokkaa" method="POST">
    Otsikko: <input type="text" name="otsikko" required>
    <br>
    Aihe:<?php require_once 'aiheet.php'; ?>
    <button type="submit" id="luo">Lähetä</button>
</form>
