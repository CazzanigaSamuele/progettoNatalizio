<?php
session_start();  // Avvia la sessione

// Se l'utente è già loggato, lo redirige alla pagina protetta
if (isset($_SESSION['username'])) {
    header('Location: paginaUtente.php');  // Reindirizza se l'utente è già loggato
    exit();
}

// Mostra un messaggio di errore se passato tramite GET
if (isset($_GET['errore'])) {
    echo "<p style='color: red;'>".$_GET['errore']."</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Benvenuto alla Login</h1>
    <form method="GET" action="gestoreLogin.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        
        <button type="submit">Login</button>
    </form>
    <br>
    <form action="registrazione.php">
        <button>Registrati</button>
    </form>
</body>
</html>

