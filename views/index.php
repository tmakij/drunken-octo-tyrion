<a href="newmessage.php">Uusiviesti</a>
<br>
<br>
<br>
<div class="viestit">
    <?php if (!empty($data->ketjut)): ?>
        <?php foreach ($data->ketjut as $ketju): ?>
            <div class="ketju">
                <div class="ketju_tiedot">
                    <a href="thread.php?id=<?php echo $ketju->getId(); ?>"><?php echo sanitize($ketju->getOtsikko()); ?></a>
                    <br>
                    <p>Viimeisin viesti <?php echo $ketju->getAika(); ?></p>
                    Kirjoittaja: <?php echo sanitize($ketju->getViimeisin()); ?>
                </div>
                <?php if ($poisto) : ?>
                    <div class="ketju_toiminnot">
                        <form action="index.php?delete=<?php echo $ketju->getId(); ?>" method="POST" id="poisto">
                            <button type="submit">Poista ketju</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
