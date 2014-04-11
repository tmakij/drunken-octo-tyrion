<div class="viestiketju">
    <?php if (!empty($data->ketju)): ?>
        <a href="response.php?id=<?php echo $data->ketju->getId(); ?>">Vastaa</a>
        <p>Aihe: <?php echo $aihe; ?></p>
        <p>Otsikko: <?php echo sanitize($data->ketju->getOtsikko()); ?></p>
        <br>
        <?php foreach ($data->ketju->getViestit() as $viesti): ?>
            <div class="fviesti">
                <div class="henkilo">
                    <p><?php echo sanitize($viesti->getKirjoittaja()); ?></p>
                    <br>
                    <p><?php echo getRyhmaID($viesti->getKirjoittaja()); ?></p>
                </div>
                <div class="sisalto">
                    <p><?php echo $viesti->getAika(); ?></p>
                    <p><?php echo sanitize($viesti->getSisalto()); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
