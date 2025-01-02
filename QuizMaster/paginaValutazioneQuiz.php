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

// Calcola il punteggio
$risposteCorrette = 0;
$risposteUtente = [];

// Raccogli le risposte dell'utente
foreach ($_GET as $key => $value) {
    if (strpos($key, 'risposta') === 0) {
        $risposteUtente[] = $value;
    }
}

// Verifica le risposte
foreach ($domande as $index => $domanda) {
    $rispostaCorretta = $domanda[5];  // La risposta corretta è sempre la 6ª colonna
    $rispostaUtente = isset($risposteUtente[$index]) ? $risposteUtente[$index] : null;

    if ($rispostaUtente == $rispostaCorretta) {
        $risposteCorrette++;
    }
}

// Calcola la percentuale di risposte corrette
$percentuale = ($risposteCorrette / count($domande)) * 100;

// Salva la percentuale nel file punteggi.csv
$filePathPunteggi = 'csv/punteggi.csv';
$file = fopen($filePathPunteggi, 'a');
$dataPunteggio = [
    $nomeUtente,
    $quizCorrente[0],  // Nome del quiz
    $quizCorrente[1],  // Difficoltà
    $percentuale
];
fputcsv($file, $dataPunteggio, ';');
fclose($file);

// Reindirizza alla pagina dei punteggi con un messaggio di conferma
header('Location: paginaPunteggiUtente.php?messaggio=Punteggio salvato con successo!');
exit();
?>
