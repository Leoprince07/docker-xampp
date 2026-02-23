<?php
session_start();
if ($_POST && isset($_POST['nome'], $_POST['password'])) 
{
    $nome = $_POST['nome'];
    $pass = $_POST['password'];
    
    require "db.php";

    $stmt = $connection->prepare("SELECT psw FROM Utenti WHERE username = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();

    $result = $stmt->get_result();
    $utente = $result->fetch_assoc();


    $stmt = $connection->prepare("SELECT username, psw FROM Utenti WHERE username = ? AND psw = ?");

    $stmt->bind_param("ss", $nome, $pass);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) 
    {
        $_SESSION["username"] = $nome;
        header("Location: dashboard.php");
        exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>
<body class="has-background-dark">
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <div class="box has-background-info-dark">
                        <h1 class="title has-text-white has-text-centered">LOGIN</h1>
                        
                        <form action="login.php" method="post">
                            <div class="field">
                                <label class="label has-text-white" for="nome">Nome:</label>
                                <div class="control">
                                    <input class="input is-info" type="text" id="nome" name="nome" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label has-text-white" for="password">Password:</label>
                                <div class="control">
                                    <input class="input is-info" type="password" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button class="button is-info is-dark is-fullwidth">INVIA</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>