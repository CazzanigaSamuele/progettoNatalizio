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
</head>
<body>
    <?php echo "ciao ".$username ?>

    <br><a href="paginaCreazioneQuizUtente.php">Crea quiz</a><br>
    <a href="paginaPunteggiUtente.php">visualizza punteggi di quiz precedenti</a>
    <a href=""></a>
</body>
</html>