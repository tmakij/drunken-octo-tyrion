<div id="kirjautunut">
    <form action="index.php" method="POST" id="ulos">
        <p>Hei, <?php echo getKirjautunut()->getNimi(); ?></p>
        <button type="submit">Kirjaudu ulos</button>
    </form>
</div>