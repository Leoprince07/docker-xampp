<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) 
{
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["username"];

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
            <div class="box has-background-info-dark">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <div>
                                <h1 class="title has-text-white">Le Mie Chat</h1>
                                <p class="subtitle is-6 has-text-white-bis">
                                    Hai <?php echo $result->num_rows; ?> chat disponibili
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <a href="nuovaChat.php" class="button is-info is-dark">
                                <strong>+ Crea Nuova Chat</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($result->num_rows === 0): ?>
                <div class="box has-background-dark has-text-centered py-6">
                    <span class="icon is-large has-text-info mb-4">
                        <i class="fas fa-comments fa-3x"></i>
                    </span>
                    <p class="title is-5 has-text-white mb-2">Non hai ancora nessuna chat.</p>
                    <p class="subtitle is-6 has-text-white-bis">
                        Clicca su "Crea Nuova Chat" per iniziare!
                    </p>
                </div>
            <?php else: ?>
                <div class="box has-background-dark">
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
                                        <strong class="has-text-white"><?php echo ($row['nome']); ?></strong>
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
            
            <div class="has-text-centered mt-5">
                <a href="login.php" class="button is-info is-light">
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