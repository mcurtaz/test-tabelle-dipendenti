<?php
// risponderà ad una chiamata ajax restituendo un json pronto da stampare
header("Content-Type: application/json; charset=UTF-8");

// il file config crea la connessione al db. in functions ci sono delle funzioni e tutte le query sul db.
require_once('../config.php');
require_once('../functions.php');

$data = getAll($conn);
$result = array();

// prende i dati dalla funzione getAll() del file functions e li riorganizza in righe della tabella da stampare
foreach($data as $nome => $giorni){

    foreach($giorni as $giorno => $dati){
        
        $result[] = array(
            $nome,
            $dati['E'],
            $dati['U'],
            $dati['TOT'],
            $dati['P']
        );
    }

}

$conn -> close();

$json = json_encode($result);

echo $json;
