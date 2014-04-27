<select name="aihe">
    <?php foreach ($data->aiheet as $value): ?>
        <option value = "<?php echo $value->getId(); ?>" 
                <?php echo (isset($data->ketju) && $value->getId() === haeAihe($data->ketju)->getId() ? 'selected' : ''); ?>>
            <?php echo sanitize($value); ?></option>
    <?php endforeach; ?>
</select>
