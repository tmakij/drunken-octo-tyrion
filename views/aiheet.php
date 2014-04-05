<select name="aihe">
    <?php foreach ($aiheet as $value): ?>
        <option value = "<?php echo $value->getId(); ?>"><?php echo $value; ?></option>
    <?php endforeach; ?>
</select>
