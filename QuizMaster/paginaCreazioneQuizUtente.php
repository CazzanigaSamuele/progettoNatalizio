<?php
    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già attiva
    }

    // Redirezione se l'utente non è autenticato
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se l'utente non è autenticato
        exit();
    }

    // Verifica il numero di domande, se non presente, setta a 0
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <h1>Crea il tuo Quiz</h1>
    <?php
        // Mostra messaggio se presente nella GET
        if(isset($_GET["messaggio"])){
            echo $_GET["messaggio"];
        }
    ?>
    <!-- Form per aggiungere domande al quiz -->
    <?php if(!isset($_GET['numDomande']) || $_GET['numDomande'] == 0): ?>
        <form action="paginaCreazioneQuizUtente.php" method="get">
            <label>Quante domande vuoi aggiungere al quiz?</label>
            <input type="number" name="numDomande" min="1" max="20" required><br>
            <input type="submit">
        </form>
    <?php else: ?>
        <form action="gestoreCreazioneQuiz.php" method="get">
            <label>Inserisci nome quiz:</label>
            <input type="text" name="nomeQuiz" required><br><br>
            
            <!-- Selezione per la difficoltà -->
            <select name="livelloDifficolta" required>
                <option value="Facile">Facile</option>
                <option value="Medio">Medio</option>
                <option value="Difficile">Difficile</option>
            </select>

            <!-- Ciclo per aggiungere le domande -->
            <?php for ($i=1; $i <= $numDomande; $i++) { 
                    echo '<label>Inserisci domanda'.$i.': </label> <input type="text" name="domanda'.$i.'" required><br>';
                    for ($j=1; $j <= 4; $j++) { 
                        echo '<label>Inserisci opzione'.$j.': </label><input type="text" name="opzione'.$i.$j.'" required><br>';
                    }
                    echo '<label>Inserisci opzione corretta'.$i.': </label><input type="text" name="opzioneCorretta'.$i.'" required><br>';
                    echo '<br>';
                }
            ?>
            <input type="hidden" name="numDomande" value="<?php echo $numDomande; ?>"> <!-- Numero di domande nascoste -->
            <input type="submit" value="Crea Quiz"><br>
        </form>
    <?php
    endif;
    ?>
    <!-- Link per tornare alla pagina iniziale -->
    
    <a href="paginaUtente.php">Torna alla pagina utente</a>
</body>
</html>
