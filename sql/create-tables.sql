CREATE TABLE kayttaja (
    id              SERIAL PRIMARY KEY,
    nimi            VARCHAR(32) NOT NULL,
	salasana        TEXT NOT NULL,
	ryhma           INTEGER NOT NULL
);

CREATE TABLE aihe (
    id              SERIAL PRIMARY KEY,
    nimi            VARCHAR(32) NOT NULL
);

CREATE TABLE viestiketju (
    id              SERIAL PRIMARY KEY,
    otsikko         VARCHAR(32) NOT NULL,
	aihe            INTEGER NOT NULL REFERENCES aihe(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE viesti (
    id              SERIAL PRIMARY KEY,
	sisalto         TEXT NOT NULL,
	aika            TIMESTAMP(0) NOT NULL,
	kirjoittaja     INTEGER NOT NULL REFERENCES kayttaja(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	viestiketju     INTEGER NOT NULL REFERENCES viestiketju(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE viesti_kayttaja (
    id                  SERIAL PRIMARY KEY,
	kayttaja            INTEGER NOT NULL REFERENCES kayttaja(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    viestiketju         INTEGER NOT NULL REFERENCES viestiketju(id) ON DELETE CASCADE ON UPDATE CASCADE
);
