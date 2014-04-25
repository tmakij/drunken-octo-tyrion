<form id="uusiviesti" method="POST">
    Otsikko: <input type="text" name="otsikko" required maxlength="31">
    <br>
    Aihe:<?php require 'aiheet.php'; ?>
    <br>
    <br>
    <textarea rows="25" cols="150" name="sisalto" required></textarea>
    <br>
    <button type="submit" id="luo">Läheta</button>
</form>
