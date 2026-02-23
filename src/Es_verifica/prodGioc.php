<?php

if(isset($_SESSION['auth']) && $_SESSION['auth'])
{
    $nomeGiocattolo = $_POST('nomeGiocattolo');
    $nomeElfo = $_POST('nomeElfo');

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
            die("Errore di connessione: " . $connection->connect_error);
        }

        $nomeGiocattolo = $_POST('nomeGiocattolo');
        $nomeElfo = $_POST('nomeElfo');

        $query = "INSERT INTO giocatori (nomeGiocattolo, nomeElfo) VALUES ('$nomeGiocattolo', '$nomeElfo')";

        $result = $connection->query($query);

        if($result = $connection->affected_rows()>0)
        {
            echo "Giocatore inserito correttamente";
        
        }
        else
        {
            echo "Errore durante l'inserimento del giocatore";
        }

        $connection->close();
    }
}