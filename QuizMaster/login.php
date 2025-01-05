<?php 
    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già attiva
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css"> <!-- Collega il file CSS per lo stile del sito -->
</head>
<body>
    <?php
    // Se c'è un messaggio passato tramite GET, lo visualizza
    if (isset($_GET["messaggio"])) {
        echo $_GET["messaggio"];
    }
    ?>
    <!-- Form per il login -->
    <form action="gestoreLogin.php" method="get">
        User: <input type="text" name="username" required><br> <!-- Campo per inserire il nome utente -->
        Password: <input type="password" name="password" required><br> <!-- Campo per inserire la password -->
        <button type="submit">Login</button> <!-- Pulsante per inviare il modulo -->
    </form>
    
    <!-- Form per la registrazione -->
    <form action="registrazione.php" method="get">
        <button type="submit">Registrati</button> <!-- Pulsante per registrarsi -->
    </form>

    <!-- Form per tornare alla pagina principale -->
    <form action="index.php" method="get">
        <button type="submit">Torna a index</button> <!-- Pulsante per tornare alla pagina principale -->
    </form>
</body>
</html>
