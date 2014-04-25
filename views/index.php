<a href="newmessage.php">Uusiviesti</a>
<br>
<br>
<br>
<div class="viestit">
    <?php if (!empty($data->ketjut)): ?>
        <?php foreach ($data->ketjut as $ketju): ?>
            <div class="ketju">
                <div class="ketju_tiedot">
                    <h5><a href="thread.php?id=<?php echo $ketju->getId(); ?>"><?php
                            echo sanitize($ketju->getOtsikko() . (onLuettuKetju($ketju->getId()) ? '' : ' (Lukemattomia viestejä)'));
                            ?></a></h5>
                    <br>
                    <p>Viimeisin viesti <?php echo $ketju->getAika(); ?></p>
                    Kirjoittaja: <?php echo sanitize($ketju->getViimeisin()); ?>
                </div>
                <?php if ($ryhma->voiHallita()) : ?>
                    <div class="ketju_toiminnot">
                        <form action="index.php?delete=<?php echo $ketju->getId(); ?>" method="POST" id="poisto">
                            <button type="submit">Poista ketju</button>
                        </form>
                        <a href="editthread.php?id=<?php echo $ketju->getId(); ?>">Muokkaa</a>
                    </div>
                <?php endif; ?>
            </div>
            <br>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
