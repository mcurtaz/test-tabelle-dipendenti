<?php

// Variabili accesso DB
$host = "localhost";
$user = "pippo";
$password = "pluto";
$dbname = "dblibemax";

// apro la connessione al db
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn && $conn->connect_error){
    echo "Connection failed: " . $conn->connect_error;
    return;
}