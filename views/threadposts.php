<?php foreach ($data->viestit as $viesti): ?>
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
    <?php
endforeach;
