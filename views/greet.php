<div id="kirjautunut">
    <form action="index.php" method="POST">
        <p>Hei, <?php echo sanitize(getKirjautunut()->getNimi()); ?></p>
        <p>Olet <?php echo $ryhma; ?></p>
        <button type="submit">Kirjaudu ulos</button>
    </form>
</div>
