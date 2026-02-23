<?php
session_start()

require "db.php";

if(isset $_SESSION["username"])
{
    $user_id = $_SESSION["username"];

    $stmt = $connection->prepare("SELECT * FROM Utenti WHERE username = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        echo "Hai <?php $result->num_row ?> file disponibili";
        while($row = $result->fetch_assoc())
        {
            echo $row["nome"];
        }
    }
    else
    {
        echo "Nessun file presente";
        echo "Carica un file";
    }
}
else
{
    header("Location: login.php");
    exit;
}

$stmt->close();
$connection->close();

?>