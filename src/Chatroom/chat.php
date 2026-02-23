<?php
session_start();

if (!isset($_SESSION["username"]))//se non è settata la sessione
{
    header("Location: login.php");//torno alla pagina di login
    exit;
}

$user_id = $_SESSION["username"];

require "db.php";

if (!isset($_GET['nome']))//se non è stata selezionata nessuna chat
{
    header ("Location: dashboard.php");//torno alla dashboard
    exit;
}

$chat_id = $_GET['nome'];

if ($_POST && isset($_POST['messaggio']))//se il metodo usato è $_POST e esiste un messaggio
{
    $messaggio = trim($_POST['messaggio']);//trim mi taglia gli spazi vuoti
    
    if (!empty($messaggio))//se il messaggio non è vuoto
    {
        $stmt = $connection->prepare("INSERT INTO Messaggi (nome, username, testo, giorno) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $chat_id, $user_id, $messaggio);
        
        if ($stmt->execute()) 
        {
            echo "Messaggio inviato con successo!";
        } 
        else 
        {
            echo "Errore nell'invio del messaggio";
        }
        $stmt->close();
    }
}
//controlla se la chat esiste
$stmt = $connection->prepare("SELECT nome FROM Stanze WHERE nome = ? LIMIT 1");
$stmt->bind_param("s", $chat_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) 
{
    echo "Chat non trovata";
    exit;
}


$chat_info = $result->fetch_assoc();
$nome_chat = $chat_info['nome'];
$stmt->close();
// Recupera tutti i messaggi della chat ordinati per data
$stmt = $connection->prepare("SELECT username, testo, giorno FROM Messaggi WHERE nome = ? ORDER BY giorno ASC");
$stmt->bind_param("s", $chat_id);
$stmt->execute();
$result = $stmt->get_result();
        
if ($result->num_rows === 0) 
{
    echo "Nessun messaggio ancora. Inizia la conversazione";
} 
else
{
    while ($row = $result->fetch_assoc()) 
    {
        echo htmlspecialchars($row['username']);
        echo date($row['giorno']);
        echo ($row['testo']);
    }
}
        
$stmt->close();
$connection->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat: <?php echo htmlspecialchars($nome_chat); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>
<body class="has-background-dark">
    <section class="section py-3 has-background-info-dark">
        <div class="container">
            <a href="dashboard.php" class="button is-info is-light is-small mb-3">
                ← Torna alla lista chat
            </a>
            
            <div class="box has-background-info-dark p-4">
                <h2 class="title is-4 has-text-white mb-2">
                    <?php echo htmlspecialchars($nome_chat); ?>
                </h2>
                <p class="subtitle is-6 has-text-white-bis">
                    Benvenuto, <?php echo htmlspecialchars($user_id); ?>!
                </p>
            </div>
        </div>
    </section>
    
    <div class="messages-container">
    </div>
    
    <div class="message-form">
        <div class="container">
            <form method="POST" action="">
                <div class="field">
                    <div class="control">
                        <textarea 
                            name="messaggio" 
                            class="textarea is-info has-background-dark has-text-white" 
                            rows="3" 
                            placeholder="Scrivi il tuo messaggio..." 
                            required
                        ></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-info is-dark is-fullwidth">
                            Invia Messaggio
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>