<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_GET["username"])) {
        $username = $_GET["username"];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="menustyle.css">
</head>
<body>
    <h1>Benvenuto su QuizMasters</h1>
    <div class="menu-container">
    <h2>Cosa vuoi fare?</h2>
    <form action="paginaCreazioneQuizUtente.php">
        <button type="submit" class="menu-button">Crea Quiz</button>
    </form>
    <form action="paginaPunteggiUtente.php">
        <button type="submit" class="menu-button">Vai ai tuoi punteggi</button>
    </form>
    <form action="paginaQuizDisponibili.php">
        <button type="submit" class="menu-button">Visualizza quiz esistenti</button>
    </form>
    <form action="logout.php">
        <button type="submit" class="menu-button">Esci</button>
    </form>
</div>

</body>
</html>