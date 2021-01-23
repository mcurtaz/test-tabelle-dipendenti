<?php
// DATI DB DA FILE DATA.PHP
require_once('data.php');

// CONNESSIONE COME UTENTE ROOT
$connection = new mysqli('localhost', 'root', 'root');

// CREAZIONE DB
if ($connection->query('CREATE DATABASE IF NOT EXISTS dblibemax ') === true) {
    echo "Database created successfully <br>";
  } else {
    echo "Error creating database: <br>" . $connection->error;
}


// CREAZIONE TABELLE
$tabellaDipendente = "dblibemax.dipendente (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100) NOT NULL, cognome VARCHAR(100) NOT NULL)";

if ($connection->query('CREATE TABLE IF NOT EXISTS ' . $tabellaDipendente) === true) {
    echo "Table dipendente created successfully <br>";
  } else {
    echo "Error creating table: dipendente <br>" . $connection->error;
}

$tabellaTimbrata = "dblibemax.timbrata (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, dipendente_id BIGINT NOT NULL, dataora DATETIME(0) NOT NULL, verso VARCHAR(1) NOT NULL, FOREIGN KEY (dipendente_id) REFERENCES dipendente (id) ON DELETE CASCADE)";

if ($connection->query('CREATE TABLE IF NOT EXISTS ' . $tabellaTimbrata) === true) {
    echo "Table timbrata created successfully <br>";
  } else {
    echo "Error creating table: timbrata <br>" . $connection->error;
}

// RECORD IN TABELLA DIPENDENTE

foreach ($dipendenti as $dipendente) {

    $qry = "INSERT INTO dblibemax.dipendente (nome, cognome) VALUES ('" . $dipendente['nome'] . "','" . $dipendente['cognome'] . "')";

    if($connection -> query($qry) == true){
        echo "Employee " . $dipendente['cognome'] . ": insert success <br>";
    } else {
        echo "Error insert on table: dipendete <br>" . $connection->error;
    }

}

// RECORD IN TABELLA TIMBRATA

foreach ($timbrate as $timbrata) {

    $qry = "INSERT INTO dblibemax.timbrata (dipendente_id, dataora, verso) VALUES ('" . $timbrata['dipendente_id'] . "','" . $timbrata['dataora'] . "','" . $timbrata['verso'] . "')";
    
    if($connection -> query($qry) == true){
        echo "Timbrata " . $timbrata['dataora'] . ": insert success <br>";
    } else {
        echo "Error insert on table: dipendete <br>" . $connection->error;
    }
}


// CREAZIONE USER CON SOLO PERMESSI LETTURA (USERNAME E PASSWORD DA RIPORTARE NEL FILE CONFIG.PHP)

$user = "pippo";
$password = "pluto";

if($connection -> query("CREATE USER '" . $user . "'@'localhost' IDENTIFIED BY '" . $password . "'")){
    echo "User " . $user . " created successfully";
}else{
    echo "Error creating user: " . $connection->error;
}

$connection -> query("GRANT SELECT ON dblibemax.* TO '" . $user . "'@'localhost'");

$connection -> query("FLUSH PRIVILEGES");

$connection -> close();

  




