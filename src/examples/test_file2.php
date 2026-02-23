<?php
if($_POST && isset($_POST["submit"]) && isset($_FILES))
{
    if(isset($_FILES["file1"]))
    {
        $path = $_FILES["file1"]["tmp_name"];

        if(file_exists($path))
        {
            $contenuto = file_get_contents($_FILES["file1"]["tmp_name"]);
            var_dump($contenuto);
        }
        else
        {
            echo "file non trovato";
        } 
    }  
}
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post">
          Seleziona il file da caricare:
          <br>
          <input type="file" name = "file1"  id = "file1">
          <br>
          <input type = "submit" value = "Invia" name = "submit">
        </form>
    </body>
</html>
