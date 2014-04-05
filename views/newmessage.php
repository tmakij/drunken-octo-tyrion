<form id="uusiviesti" method="POST">
    Otsikko: <input type="text" name="otsikko" required>
    <br>
    Aihe:     
    <select>
        <option value="0">Rupattelu</option>
        <option value="1">Juttelu</option>
        <option value="2">Kakut</option>
        <option value="3">Yliopisto</option>
    </select>
    <br>
    <br>
    <textarea rows="25" cols="150" name="sisalto" required></textarea>
    <br>
    <button type="submit" id="luo">Läheta</button>
</form>
