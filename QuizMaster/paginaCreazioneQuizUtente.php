<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_GET["numDomande"])) {
        $numDomande = (int) $_GET["numDomande"]; 
    } else {
        $numDomande = 0; 
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
    <?php if ($numDomande == 0): ?>
        <form action="paginaCreazioneQuizUtente.php" method="get">
            <label>Quante domande vuoi aggiungere al quiz?</label>
            <input type="number" name="numDomande" min="1" max="20"required><br>
            <input type="submit">
        </form>
    <?php else: ?>
        <?php echo $numDomande?>
        <form action="gestoreCreazioneQuiz.php" method="get">
            <label>Inserisci nome quiz:</label>
            <input type="text" name="nomeQuiz" required><br>
            <input type="submit" value="Crea Quiz">
        </form>
    <?php endif; ?>
</body>
</html>
