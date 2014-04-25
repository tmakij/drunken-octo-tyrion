<select name="aihe">
    <?php foreach ($data->aiheet as $value): ?>
        <option value = "<?php echo $value->getId(); ?>" 
                <?php echo $value->getId() === haeAihe($data->ketju)->getId() ? 'selected' : ''; ?>>
            <?php echo sanitize($value); ?></option>
    <?php endforeach; ?>
</select>
