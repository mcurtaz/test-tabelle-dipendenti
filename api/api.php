<?php
header("Content-Type: application/json; charset=UTF-8");

require_once('../config.php');
require_once('../functions.php');

$data = getAll($conn);
$result = array();

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
