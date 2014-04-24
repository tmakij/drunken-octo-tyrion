INSERT INTO kayttaja (nimi, salasana, ryhma) VALUES ('NormiKäyttäjä', '12345', 2), ('Admin', 'admin', 1), ('Käyttäjäkiellossa', '666', 0);
INSERT INTO aihe (nimi) VALUES ('Rupattelu'), ('Spämmi'), ('Yliopisto'), ('Tietojenkäsittelytiede');
INSERT INTO viestiketju (otsikko, aihe) VALUES ('Uusi foorumi!', 1), ('Tapaaminen', 1);
INSERT INTO viesti (sisalto, aika, kirjoittaja, viestiketju) VALUES ('On kyllä hieno!', '1000-1-1 12:51:00', 1, 1), ('No on!', '1100-1-1 12:55:00', 2, 1), ('Millon tavataan??', '1050-1-1 13:00:00', 3, 2);
INSERT INTO viesti_kayttaja (kayttaja, viesti, onlukenut) VALUES (1, 1, FALSE), (2, 2, FALSE);
