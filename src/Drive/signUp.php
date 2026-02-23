<?php
session_start();
if($_POST && isset($_POST["nome"], $_POST["password"]))
{
    $nome = $_POST["nome"];
    $pass = $_POST["password"];

    require "db.php";

    $stmt = $connection->prepare("INSERT INTO Utenti(username, psw) VALUES(?, ?)");
    $stmt->bind_param("ss",$nome, $pass);

    if($stmt->execute())
    {
        header("Location: login.php");
        exit;
    }
    else
    {
        echo "Errore durante la registrazione";
    }
    $stmt->close();
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
</head>
<body>
    <h1>SIGN UP</h1>
    <form action = "signUp.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Invia">
    </form>
</body>
</html>