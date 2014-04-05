<select name="aihe">
    <?php foreach ($aiheet as $value): ?>
        <option value = "<?php echo $value->getId(); ?>" <?php echo $value->getId() == $aihe->getId() ? 'selected' : ''; ?>><?php echo sanitize($value); ?></option>
    <?php endforeach; ?>
</select>
