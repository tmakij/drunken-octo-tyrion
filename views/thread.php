<div class="viestiketju">
    <a href="response.php?id=0">Vastaa</a>
    <p>Aihe: Rupattelu</p>
    <p>Otsikko: Uusi foorumi</p>
    <br>
    <?php if (!empty($data->ketju)): ?>
        <?php foreach ($data->ketju->getViestit() as $viesti): ?>
            <div class="fviesti">
                <div class="henkilo">
                    <p><?php echo $viesti->getKirjoittaja(); ?></p>
                    <br>
                    <p><?php echo getRyhmaID($viesti->getKirjoittaja()); ?></p>
                </div>
                <div class="sisalto">
                    <p><?php echo $viesti->getAika(); ?></p>
                    <p><?php echo $viesti->getSisalto(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
