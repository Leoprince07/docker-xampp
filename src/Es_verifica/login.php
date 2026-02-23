<?php
$user = $_POST['nome'];
$pass = $_POST['password'];

$NOME_OK = "santa";
$PASS_OK = "rudolf";

if ($user === $NOME_OK && $pass === $PASS_OK) 
{
    echo "Login effettuato!";
    echo '<a href="prodFGioc.php"> Vai alla pagina di Giochi </a>';
} else 
{
    echo "Credenziali errate";
}
?>