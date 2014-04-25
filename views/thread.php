<div class="viestiketju">
    <?php if (!empty($data->ketju)): ?>
        <a href="response.php?id=<?php echo $data->ketju->getId(); ?>">Vastaa</a>
        <p>Aihe: <?php echo sanitize(haeAihe($data->ketju)); ?></p>
        <p>Otsikko: <?php echo sanitize($data->ketju->getOtsikko()); ?></p>
        <br>
        <?php require 'views/threadposts.php'; ?>
    <?php endif; ?>
</div>
