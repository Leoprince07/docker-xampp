<?php
session.start();

if(isset($_POST['nomeGiocattolo']) && isset($_POST['nomeElfo']))
    {
        $host = 'db';
        $user = 'babbonatale';
        $password = 'user';
        $dbname = 'user';
        $port = 3306;

        $connection = new mysqli($host, $user, $password, $dbname, $port);

        if(connection->connect_error)
        {
            die("Errore di connessione: " . $connection->connect_error)
        }
    }
$query = "SELECT NomeGiocattolo, COUNT(*) AS NumeroUnita FROM giocattoli GROUP BY NomeGiocattolo";

$reult = $connection->query($query);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo ($row['NomeGiocattolo']). ":";
        echo ($row['NumeroUnita']). "<br>";
    }

}


