<?php
include_once "classi/CatalogoQuiz.php"; // Include la classe CatalogoQuiz

if (!isset($_SESSION)) {
    session_start(); // Avvia la sessione se non è già stata avviata
}

if (isset($_GET['numDomande'])) { // Verifica se il parametro 'numDomande' è stato passato nella richiesta GET
    $q = new CatalogoQuiz(); // Istanzia un oggetto CatalogoQuiz

    $numDomande = (int)$_GET['numDomande']; // Convertire il numero di domande in un intero
    $nomeQuiz = $_GET["nomeQuiz"];
    $_SESSION['nQuiz'] = $nomeQuiz; // Estrae il nome del quiz
    $difficoltaQuiz = $_GET["livelloDifficolta"]; // Estrae la difficoltà del quiz
    // Verifica se il nome del quiz è già presente
    if ($q->controllaSeNomeQuizPresente($nomeQuiz)) {
        header('Location: paginaCreazioneQuizUtente.php?' . '&messaggio=nome quiz già presente!!!');
        exit(); // Esce dal flusso se il nome del quiz esiste già
    }

    $righeAggiunte = ""; // Inizializza una stringa per salvare le righe del nuovo quiz
    for ($i = 1; $i <= $numDomande; $i++) {
        $nuovaRiga = ""; // Inizializza ogni riga del quiz

        $domanda = $_GET["domanda$i"]; // Estrae la domanda $i
        $opzioni = []; // Array per contenere le opzioni della domanda

        $nuovaRiga .= $nomeQuiz; 
        $nuovaRiga .= ";" . $difficoltaQuiz;
        $nuovaRiga .= ";" . $domanda;

        // Aggiunge le opzioni della domanda
        for ($j = 1; $j <= 4; $j++) {
            $opzione = $_GET["opzione{$i}{$j}"];
            $opzioni[] = $opzione;
            $nuovaRiga .= ";" . $opzione;
        }

        $opzioneCorretta = $_GET["opzioneCorretta$i"];
        $flag = false;

        // Controlla se l'opzione corretta è presente tra le opzioni
        foreach ($opzioni as $opzione) {
            if ($opzioneCorretta == $opzione) {
                $flag = true;
                break;
            }
        }

        if ($flag == false) {
            // Redirect con messaggio di errore se l'opzione corretta non è presente
            header('Location: paginaCreazioneQuizUtente.php?' . '&messaggio=Opzione corretta deve essere presente nelle opzioni!!!');
            exit(); // Esce se l'opzione corretta non è valida
        }

        $nuovaRiga .= ";" . $opzioneCorretta;

        $righeAggiunte .= $nuovaRiga . "\r\n"; // Aggiunge la riga al contenuto del quiz
    }

    // Scrive le righe aggiunte nel file CSV
    file_put_contents("csv/quizCreati.csv", $righeAggiunte, FILE_APPEND);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Se lo desideri puoi caricare un file</h1><br><br>
    <form action="gestoreCaricamentoFile.php" method="post">
        <input type="file" name="file" id="file"><br><br>
        <button type="submit">Invia</button>
    </form>
    <br>
    <form action="paginaCreazioneQuizUtente.php">
        <button>Non inserire nessuna immagine</button>
    </form>
</body>
</html>
