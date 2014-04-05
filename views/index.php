<a href="newmessage.php">Uusiviesti</a>
<br>
<br>
<br>
<div class="viestit">
    <?php if (!empty($data->ketjut)): ?>
        <?php foreach ($data->ketjut as $ketju): ?>
            <div class="viesti">
                <a href="thread.php?id="<?php echo $ketju->getId() . '"'; ?>><?php echo $ketju->getOtsikko(); ?></a>
                <br>
                <p>Viimeisin viesti <?php echo $ketju->getAika(); ?></p>
                <p>Kirjoittaja: <?php echo $ketju->getViimeisin(); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
