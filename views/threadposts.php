<?php foreach ($data->viestit as $viesti): ?>
    <div class="fviesti">
        <div class="henkilo">
            <p><?php echo sanitize($viesti->getKirjoittaja()); ?></p>
            <br>
            <p><?php echo getRyhmaID($viesti->getKirjoittaja()); ?></p>
        </div>
        <div class="sisalto">
            <div>
                <p><?php echo $viesti->getAika(); ?></p>
                <p><?php echo sanitize($viesti->getSisalto()); ?></p>
            </div>
            <?php if (onKirjautunut() && saaMuokataViestiä(getKirjautunut(), $viesti)): ?>
                <div class="toiminnot">
                    <a href="editpost.php?id=<?php echo $viesti->getId(); ?>">Muokkaa</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
endforeach;
