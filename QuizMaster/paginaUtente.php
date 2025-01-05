<?php
    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già avviata
    }

    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit();
    }

    if (isset($_GET["username"])) {
        $username = $_GET["username"]; // Recupera il nome utente dall'URL
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/menustyle.css"> <!-- Stile CSS per il menu -->
</head>
<body>
    <div class="menu-container">
        <a href="paginaCreazioneQuizUtente.php" class="menu-button">Crea quiz</a>
        <a href="paginaPunteggiUtente.php" class="menu-button">Visualizza punteggi</a>
        <a href="paginaQuizDisponibili.php" class="menu-button">Visualizza quiz disponibili</a>
        <a href="index.php" class="menu-button">Torna all'index</a>
    </div>
</body>
</html>
