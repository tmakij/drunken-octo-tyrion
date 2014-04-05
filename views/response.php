<form id="uusiviesti" method="POST" class="uusiviesti">
    <p id="otsikko">Otsikko: <?php echo $ketju->getOtsikko(); ?></p>
    <p>Aihe: <?php echo $aihe; ?></p>
    <br>
    <textarea rows="25" cols="150" name="sisalto"></textarea>
    <br>
    <button type="submit" id="luo">Läheta</button>
</form>
