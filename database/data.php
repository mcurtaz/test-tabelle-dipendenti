<?php
$dipendenti = array();
 
$dipendenti[] = array('id' => 1, 'nome' => "Mario", 'cognome' => "Rossi");
$dipendenti[] = array('id' => 2, 'nome' => "Marco", 'cognome' => "Gialli");
$dipendenti[] = array('id' => 3, 'nome' => "Luca", 'cognome' => "Verdi");

$timbrate = array();

$timbrate[] = array('id' => 1, 'dipendente_id' => 2, 'dataora' => "2020-12-03 22:00:00", 'verso' => "E");
$timbrate[] = array('id' => 2, 'dipendente_id' => 3, 'dataora' => "2020-12-03 22:05:00", 'verso' => "E");
$timbrate[] = array('id' => 3, 'dipendente_id' => 3, 'dataora' => "2020-12-04 06:00:00", 'verso' => "U");
$timbrate[] = array('id' => 4, 'dipendente_id' => 2, 'dataora' => "2020-12-04 06:05:00", 'verso' => "U");
$timbrate[] = array('id' => 5, 'dipendente_id' => 1, 'dataora' => "2020-12-04 09:00:00", 'verso' => "E");
$timbrate[] = array('id' => 6, 'dipendente_id' => 1, 'dataora' => "2020-12-04 13:00:00", 'verso' => "U");
$timbrate[] = array('id' => 7, 'dipendente_id' => 1, 'dataora' => "2020-12-04 14:00:00", 'verso' => "E");
$timbrate[] = array('id' => 8, 'dipendente_id' => 1, 'dataora' => "2020-12-04 18:00:00", 'verso' => "U");