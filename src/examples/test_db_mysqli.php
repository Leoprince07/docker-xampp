<?php

//presi dal docker-compose.yml
$host = 'db'; 
$dbname = 'root_db'; 
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

echo "Connessione al database riuscita con mysqli!";
//logica
//1. prendo i dati dalla richiesta http
//2. costruisco le query utilizzando i dati dell'utente
//3. eseguo le query
//4. prendo la risposta della query
//5. visualzzo i risultati

$connection->close();
