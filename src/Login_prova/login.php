<?php
$nome = $_POST['nome'];
$pass = $_POST['password'];

$host = 'db';
$dbname = 'prova';
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if($connection->connect_error)
{
    die("Errore di connessione: " . $connection->connect_error);
}

$query = "SELECT * FROM Utente WHERE Nome ='$nome' AND Password = '$pass'";

$result = $connection->query($query);

if($result->num_rows > 0)
{
    echo "Login effettuato";
}
else
{
    echo "Login errato";
    echo '<a href="signUp.html"> Vai alla pagina di registrazione </a>';
}
$connection->close();