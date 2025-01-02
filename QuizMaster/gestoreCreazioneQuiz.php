<?php
require_once 'classi/Quiz.php';
require_once 'classi/Domanda.php';

session_start();  // Avvia la sessione

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$nomeUtente = $_SESSION['username'];  // Ottieni il nome utente dalla sessione

// Recupera i dati dal metodo GET
$nomeQuiz = $_GET['nomeQuiz'];  
$livelloDifficolta = $_GET['livelloDifficolta'];
$numDomande = (int)$_GET['numDomande'];

// Verifica che il numero di domande sia valido
if ($numDomande <= 0) {
    die("Errore: Il numero di domande deve essere maggiore di 0.");
}

$domande = [];

// Recupera le domande dal form
for ($i = 1; $i <= $numDomande; $i++) {
    $testoDomanda = $_GET["domanda$i"];
    
    // Le opzioni per la domanda
    $opzioni = [
        $_GET["opzione{$i}1"],
        $_GET["opzione{$i}2"],
        $_GET["opzione{$i}3"],
        $_GET["opzione{$i}4"]
    ];

    // La risposta corretta
    $rispostaCorretta = (int)$_GET["opzioneCorretta$i"];
    if ($rispostaCorretta < 1 || $rispostaCorretta > 4) {
        exit("Errore: La risposta corretta per la domanda $i deve essere tra 1 e 4.");
    }

    // Crea la domanda
    $domanda = new Domanda($testoDomanda, $opzioni[$rispostaCorretta - 1], $opzioni);
    $domande[] = $domanda;
}

// Crea il quiz
$quiz = new Quiz($nomeQuiz, $domande, $livelloDifficolta);

// Salvataggio del quiz nel file CSV
$filePath = 'csv/quizCreati.csv';
$file = fopen($filePath, 'a');

// Scrivi i dati del quiz
// Salva il nome del quiz e la difficoltà
fputcsv($file, [$nomeQuiz, $livelloDifficolta], ';');

// Scrivi le domande e le risposte
foreach ($domande as $domanda) {
    $data = [
        $domanda->getRichiesta(),
        $domanda->getOpzioni()[0],
        $domanda->getOpzioni()[1],
        $domanda->getOpzioni()[2],
        $domanda->getOpzioni()[3],
        $domanda->getRispostaCorretta()
    ];
    fputcsv($file, $data, ';');  // Usa il delimitatore ';' per separare i campi
}

// Aggiungi una riga vuota come separatore tra quiz
fputcsv($file, [], ';');

fclose($file);

// Reindirizza alla pagina di conferma
header('Location: paginaCreazioneQuizUtente.php?messaggio=Quiz salvato con successo!');
exit()
?>
