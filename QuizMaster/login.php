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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <?php
    // Se c'è un messaggio passato tramite GET, lo visualizza
    if (isset($_GET["messaggio"])) {
        echo $_GET["messaggio"];
    }
    ?>

    <h1>Bentornato effettua il Login</h1>
    <!-- Form per il login -->
    <form action="gestoreLogin.php" method="get">
        User: <input type="text" name="username" required><br> <!-- Campo per inserire il nome utente -->
        Password: <input type="password" name="password" required><br> <!-- Campo per inserire la password -->
        <button type="submit">Login</button> <!-- Pulsante per inviare il modulo -->
    </form>
    <br>
    <a href="registrazione.php">Vai alla Registrati</a>  ||  <a href="index.php">Torna all'index</a> 
</body>
</html>
