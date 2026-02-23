<?php
session_start();
if($_POST && isset($_POST['nome'], $_POST['password']))
{
    $nome = $_POST['nome'];
    $pass = $_POST['password'];

    require "db.php";

    $stmt = $connection->prepare("SELECT psw FROM Utenti WHERE username = ? ");
    $stmt->bind_param("s", $nome);
    $stmt->execute();

    $result = $stmt->get_result();
    $utente = $result->fetch_assoc();

    $stmt = $connection->prepare("SELECT username, psw FROM Utenti WHERE username = ? AND psw = ?");
    $stmt->bind_param("ss", $nome, $pass);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0)
    {
        header ("Location: dashboard.php");
    }
    else
    {
        header("Location: signUp.php");
        exit;
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
    <title>LOGIN</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form action = "login.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Invia">
    </form>
</body>
</html>