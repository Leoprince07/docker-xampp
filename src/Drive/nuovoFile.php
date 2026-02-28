<?php
session_start();

if(isset($_SESSION["username"]))
{
    require "db.php";

    if($_POST && isset($_POST["submit"]) && isset($_FILES))
    {
        if(isset($_FILES["file1"]))
        {
            $path = $_FILES["file1"]["tmp_name"];

            if(file_exists($path))
            {
                $contenuto = file_get_contents($path);
                $stmt = $connection->prepare("INSERT INTO File(nome, contenuto, giorno, username_utente) VALUES(?, ?, NOW(), ?)");
                $stmt->bind_param("sss", $path, $contenuto, $_SESSION["username"]);
                $stmt->execute();
            }
            else
            {
                echo "file non trovato";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <body>
    <form action="" method="post" enctype="multipart/form-data">
          Seleziona il file da caricare:
          <br>
          <input type="file" name = "file1"  id = "file1">
          <br>
          <input type = "submit" value = "Invia" name = "submit">
          <a href="dashboard.php">Torna alla dashboard</a>
        </form>
    </body>
</html>
