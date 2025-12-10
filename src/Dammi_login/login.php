<?php
$nome = htmlspecialchars($_POST['nome']);
$pass = htmlspecialchars($_POST['password']);

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

    $stmt=$connection->prepare("SELECT * FROM User WHERE Nome = ? AND password = ?");

    $stmt->bind_param("ss", $nome, $pass);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        echo "Login effettuato";
        if($nome == "Leonardo")
        {
            $query = "SELECT * FROM User";
            $result = $connection->query($query);
            var_dump($result);
            echo " La tabella user ha le seguenti righe: $result->num_rows<br>";
            echo "<table border = 2>";
            echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>Password</th>";
            echo "</tr>";
            while($row = $result->fetch_assoc())
            {
                //var_dump($row);
                echo "<tr>";
                echo "<td>". $row['Nome'] ."</td>";
                echo "<td>". $row['password'] ."</td>";
                echo "</tr>";
            }
            echo "</table>";

        }
    }
    else
    {
        echo "Login errato";
        echo '<a href="signUp.html"> Vai alla pagina di registrazione </a>';
    }
    
    $connection->close();
?>