<form id="muokkaa" method="POST">
    Otsikko: <input type="text" name="otsikko" value="<?php echo $ketju->getOtsikko(); ?>" required>
    <br>
    Aihe:<?php require_once 'aiheet.php'; ?>
    <br>
    <button type="submit" id="luo">Lähetä</button>
</form>
