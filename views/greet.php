<div id="kirjautunut">
    <form action="index.php" method="POST" id="ulos">
        <p>Hei, <?php echo $kayttaja->getNimi(); ?></p>
        <p>Olet <?php echo $ryhma; ?></p>
        <button type="submit">Kirjaudu ulos</button>
    </form>
</div>
