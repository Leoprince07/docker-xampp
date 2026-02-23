<?php
$nome = $_POST['nome'];
$pass = $_POST['password'];

    $host = 'db'; 
    $dbname = 'root_db'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);
    
    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }
    
    echo "Connessione al database riuscita con Princedatabase! <br>";

    $query = "INSERT INTO User (Nome, password) VALUES ('$nome', '$pass')";

    echo $query;
    echo "<br>";

    $result = $connection->query($query);

    if($result === true)
    {
        echo "Sign up effettuato";
    }
    else
    {
        echo "Sign up errato: " . $connection->error;
    }
