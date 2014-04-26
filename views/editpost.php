<form method="POST">
    <textarea rows="25" cols="150" name="sisalto" required><?php echo sanitize($data->viesti->getSisalto()); ?></textarea>
    <br>
    <button type="submit">Tallenna</button>
</form>
