<?php
session_start();

if(isset($_SESSION['auth']) && $_SESSION['auth'])
{
    echo '<section>';
    echo '<form name = "Giocattoli_POST" method = "POST" action = "prodGioc.php">';

    echo '<label for = "nome_giocattolo"> Nome Giocattolo</label>';
    echo '<input type = text id = "nomeGiocattolo name = "nomeGiocattolo">';

    echo 'label for = "nome_elfo">Nome Elfo</label>';
    echo '<input type = text id = "nomeElfo" name = "nomeElfo">';

    echo '<button type = submit> Inserisci</button>';

    echo '</form>';
    echo '</section>';

    echo '<section>';
    echo '<a href="prodElfi.php"> Visualizza i giocattoli degli elfi </a>';
    echo '<br>';
    echo '</section>';
}