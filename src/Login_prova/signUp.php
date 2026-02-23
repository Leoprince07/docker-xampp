<?php
$nome = $_POST['nome'];
$pass = $_POST['password'];

$host = 'db';
$dbname = 'prova';
$user ='user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

$query = "INSERT INTO Utente(Nome, Password) VALUES ('$nome', '$pass')";

$result = $connection->query($query);

if($result === true)
{
    echo "Sign up effettuato";
}
else
{
    echo "Sign up errato";
}
$connection->close();