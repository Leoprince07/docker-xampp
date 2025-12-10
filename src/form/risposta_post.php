<?php
$user = $_POST['nome'];
$pass = $_POST['password'];

$NOME_OK = "Leonardo";
$PASS_OK = "forzajuve";

if ($user === $NOME_OK && $pass === $PASS_OK) 
{
    echo "Login effettuato!";
} else 
{
    echo "Credenziali errate";
}
?>