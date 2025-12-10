<?php
$user = $_GET['nome'];
$pass = $_GET['password'];

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