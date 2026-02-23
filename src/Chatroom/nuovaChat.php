<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) 
{
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["username"];

// Gestione creazione nuova chat
$messaggio = "";
$tipo_messaggio = "";

if ($_POST && isset($_POST['crea_chat'])) 
{
    $nome_nuova_chat = trim($_POST['nome_chat']);
    
    if (!empty($nome_nuova_chat)) 
    {
        // Verifica se la chat esiste già
        $stmt = $connection->prepare("SELECT nome FROM Stanze WHERE nome = ? LIMIT 1");
        $stmt->bind_param("s", $nome_nuova_chat);
        $stmt->execute();
        $result_check = $stmt->get_result();
        
        if ($result_check->num_rows > 0) 
        {
            $messaggio = "Una chat con questo nome esiste già!";
            $tipo_messaggio = "error";
        } 
        else 
        {
            // Crea la nuova chat
            $stmt = $connection->prepare("INSERT INTO Stanze (nome, username) VALUES (?, ?)");
            $stmt->bind_param("ss", $nome_nuova_chat, $user_id);
            
            if ($stmt->execute()) 
            {
                $messaggio = "Chat creata con successo!";
                $tipo_messaggio = "success";
            } 
            else 
            {
                $messaggio = "Errore nella creazione della chat";
                $tipo_messaggio = "error";
            }
        }
        $stmt->close();
    } 
    else 
    {
        $messaggio = "Il nome della chat non può essere vuoto";
        $tipo_messaggio = "error";
    }
}

// Query per ottenere le chat dell'utente
$stmt = $connection->prepare("SELECT * FROM Stanze WHERE username = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Le Mie Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>
<body class="has-background-dark">
    <section class="section">
        <div class="container">
            <!-- Header -->
            <div class="box has-background-info-dark mb-5">
                <h1 class="title has-text-white">Dashboard Chat</h1>
                <p class="subtitle is-6 has-text-white-bis">
                    Benvenuto, <strong class="has-text-white"><?php echo htmlspecialchars($user_id); ?></strong>
                </p>
            </div>
            
            <!-- Sezione Crea Nuova Chat -->
            <div class="box has-background-dark mb-5">
                <h2 class="title is-4 has-text-white mb-4">Crea una Nuova Chat</h2>
                
                <?php if (!empty($messaggio)): ?>
                    <div class="notification <?php echo $tipo_messaggio === 'success' ? 'is-success' : 'is-danger'; ?> is-light">
                        <?php echo htmlspecialchars($messaggio); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="field has-addons">
                        <div class="control is-expanded">
                            <input 
                                type="text" 
                                name="nome_chat" 
                                class="input is-info has-background-dark has-text-white" 
                                placeholder="Inserisci il nome della chat..."
                                maxlength="100"
                                required
                                autofocus
                            >
                        </div>
                        <div class="control">
                            <button type="submit" name="crea_chat" class="button is-info is-dark">
                                <strong>Crea Chat</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Sezione Lista Chat -->
            <div class="box has-background-dark">
                <div class="level mb-4">
                    <div class="level-left">
                        <div class="level-item">
                            <h2 class="title is-5 has-text-white">Le tue chat (<?php echo $result->num_rows; ?>)</h2>
                        </div>
                    </div>
                </div>
                
                <?php if ($result->num_rows === 0): ?>
                    <div class="has-text-centered py-6">
                        <span class="icon is-large has-text-info mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </span>
                        <p class="title is-5 has-text-white mb-2">Non hai ancora nessuna chat.</p>
                        <p class="subtitle is-6 has-text-white-bis">
                            Crea la tua prima chat usando il form qui sopra!
                        </p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table is-fullwidth is-hoverable has-background-dark has-text-white">
                            <thead>
                                <tr class="has-background-info-dark">
                                    <th class="has-text-white">Nome Chat</th>
                                    <th class="has-text-white has-text-right">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr class="has-background-dark">
                                        <td>
                                            <strong class="has-text-white"><?php echo htmlspecialchars($row['nome']); ?></strong>
                                        </td>
                                        <td class="has-text-right">
                                            <a href="chat.php?nome=<?php echo urlencode($row['nome']); ?>" 
                                               class="button is-info is-dark is-small">
                                                Entra →
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Footer -->
            <div class="has-text-centered mt-5">
                <a href="logout.php" class="button is-info is-light">
                    Esci dall'account
                </a>
            </div>
        </div>
    </section>
</body>
</html>

<?php
$stmt->close();
$connection->close();
?>