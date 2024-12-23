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
    <?php
        if(isset($_GET["messaggio"])){
            echo"".$_GET["messaggio"]."";
        }
    ?>
    <?php if(!isset($_GET['numDomande']) || $_GET['numDomande'] == 0): ?>
        <form action="paginaCreazioneQuizUtente.php" method="get">
            <label>Quante domande vuoi aggiungere al quiz?</label>
            <input type="number" name="numDomande" min="1" max="20"required><br>
            <input type="submit">
        </form>
    <?php else: ?>
        <?php echo $numDomande?>
        <form action="gestoreCreazioneQuiz.php" method="get">
            <label>Inserisci nome quiz:</label>
            <input type="text" name="nomeQuiz" required><br><br>
            
            <select name="livelloDifficolta" required>
                <option value="Facile">Facile</option>
                <option value="Medio">Medio</option>
                <option value="Difficile">Difficile</option>
            </select>

            <?php for ($i=1; $i <= $numDomande; $i++) { 
                    echo '<label>Inserisci domanda'.$i.'</label> <input type="text" name="domanda'.$i.'"><br>';
                    for ($j=1; $j <= 4; $j++) { 
                        echo '<label>Inserisci opzione'.$j.'</label><input type="text" name="opzione'.$i.$j.'"><br>';
                    }
                    echo '<label>Inserisci opzione corretta'.$i.':</label><input type="text" name="opzioneCorretta'.$i.'"><br>';
                    echo '<br>';
                }
            ?>
            <input type="hidden" name="numDomande" value="<?php echo $numDomande; ?>">
            <input type="submit" value="Crea Quiz"><br>
        </form>

    <?php endif; ?>
    <a href="paginaUtente.php">Torna alla pagina iniziale</a>
</body>
</html>
