<?php
session_start();  // Avvia la sessione

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$nomeUtente = $_SESSION['username'];  // Ottieni il nome utente dalla sessione

// Recupera il quiz selezionato tramite GET
if (!isset($_GET['quizSelezionato'])) {
    header('Location: paginaQuizDisponibili.php');
    exit();
}

$quizSelezionato = (int)$_GET['quizSelezionato'];  // Indice del quiz selezionato

// Leggi i quiz disponibili dal file CSV
$filePath = 'csv/quizCreati.csv';
$quizDisponibili = [];
$quizCorrente = null;

if (($file = fopen($filePath, 'r')) !== FALSE) {
    $quizIndex = 0;  // Indice per navigare tra i quiz
    while (($data = fgetcsv($file, 1000, ';')) !== FALSE) {
        if ($quizIndex === $quizSelezionato) {
            $quizCorrente = $data;  // Raccogli il nome e la difficoltà del quiz selezionato
            break;
        }
        $quizIndex++;
    }
    fclose($file);
}

if ($quizCorrente === null) {
    // Se non troviamo il quiz, reindirizziamo alla pagina dei quiz disponibili
    header('Location: paginaQuizDisponibili.php');
    exit();
}

// Ora leggiamo le domande e opzioni per il quiz selezionato
$file = fopen($filePath, 'r');
$domande = [];
$quizIndex = 0;

while (($data = fgetcsv($file, 1000, ';')) !== FALSE) {
    if ($quizIndex === $quizSelezionato) {
        while (($domandaData = fgetcsv($file, 1000, ';')) !== FALSE) {
            if (count($domandaData) == 6) {  // Se una riga ha 6 colonne, è una domanda con 4 opzioni e la risposta corretta
                $domande[] = $domandaData;
            }
        }
        break;
    }
    $quizIndex++;
}

fclose($file);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inizia il Quiz</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Quiz: <?php echo $quizCorrente[0]; ?> (Difficoltà: <?php echo $quizCorrente[1]; ?>)</h1>

    <form action="paginaValutazioneQuiz.php" method="GET">
        <input type="hidden" name="quizSelezionato" value="<?php echo $quizSelezionato; ?>">
        <h2>Domande:</h2>

        <?php
        // Visualizza le domande con le opzioni
        foreach ($domande as $index => $domanda) {
            $domandaTesto = $domanda[0];  // Domanda
            $opzione1 = $domanda[1];  // Opzione 1
            $opzione2 = $domanda[2];  // Opzione 2
            $opzione3 = $domanda[3];  // Opzione 3
            $opzione4 = $domanda[4];  // Opzione 4
        ?>
            <fieldset>
                <legend>Domanda <?php echo ($index + 1); ?></legend>
                <p><?php echo $domandaTesto; ?></p>
                <label><input type="radio" name="risposta<?php echo $index; ?>" value="1"> <?php echo $opzione1; ?></label><br>
                <label><input type="radio" name="risposta<?php echo $index; ?>" value="2"> <?php echo $opzione2; ?></label><br>
                <label><input type="radio" name="risposta<?php echo $index; ?>" value="3"> <?php echo $opzione3; ?></label><br>
                <label><input type="radio" name="risposta<?php echo $index; ?>" value="4"> <?php echo $opzione4; ?></label><br>
            </fieldset>
        <?php } ?>

        <button type="submit">Valuta il Quiz</button>
    </form>
    <br>
    <form action="paginaQuizDisponibili.php">
        <button>Torna alla lista dei quiz</button>
    </form>
</body>
</html>
