<p>Hallinta</p>
<form action="admin.php" method="POST">
    Aseta käyttäjä <input type="number" required> ryhmään
    <select>
        <option value="0">Viestikielto</option>
        <option value="1">Pääkäyttäjä</option>
        <option value="2">Käyttäjä</option>
    </select>
    <button type="submit" name="toiminto" value="aseta_kayttaja_ryhma">Ok</button>
</form>
<br>
<form action="admin.php" method="POST">
    Poista aihe
    <?php require 'views/aiheet.php'; ?>
    <button type="submit" name="toiminto" value="poista_aihe">Ok</button>
</form>
<br>
<form action="admin.php" method="POST">
    Lisää aihe
    <input type="text" name="uusi_aihe" required maxlength="31">
    <button type="submit" name="toiminto" value="lisaa_aihe">Ok</button>
</form>
