<form id="muokkaa" method="POST">
    Otsikko: <input type="text" name="otsikko" value="<?php echo sanitize($data->ketju->getOtsikko()); ?>" required maxlength="31">
    <br>
    Aihe:<?php require 'views/aiheet.php'; ?>
    <br>
    <button type="submit" id="luo">Lähetä</button>
</form>
