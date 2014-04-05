<form id="uusiviesti" method="POST">
    Otsikko: <input type="text" name="otsikko" required>
    <br>
    Aihe:<?php require_once 'aiheet.php'; ?>
    <br>
    <br>
    <textarea rows="25" cols="150" name="sisalto" required></textarea>
    <br>
    <button type="submit" id="luo">Läheta</button>
</form>
