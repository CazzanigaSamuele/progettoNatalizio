<?php
session_start();  // Avvia la sessione

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$nomeUtente = $_SESSION['username'];  // Ottieni il nome utente dalla sessione

// Leggi i quiz disponibili dal file CSV
$filePath = 'csv/quizCreati.csv';
$quizDisponibili = [];

if (($file = fopen($filePath, 'r')) !== FALSE) {
    $quiz = [];
    while (($data = fgetcsv($file, 1000, ';')) !== FALSE) {
        if (count($data) == 2) {  // Questa è una riga con nome e difficoltà del quiz
            if (!empty($quiz)) {
                $quizDisponibili[] = $quiz;
            }
            $quiz = [
                'nome' => $data[0],  // Nome del quiz
                'difficolta' => $data[1],  // Difficoltà
                'domande' => []  // Lista di domande (inizialmente vuota)
            ];
        } else if (count($data) == 6) {  // Questa è una riga con la domanda e le risposte
            $quiz['domande'][] = [
                'domanda' => $data[0],
                'risposte' => [
                    $data[1], $data[2], $data[3], $data[4]
                ],
                'rispostaCorretta' => $data[5]
            ];
        }
    }
    // Aggiungi l'ultimo quiz
    if (!empty($quiz)) {
        $quizDisponibili[] = $quiz;
    }
    fclose($file);
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Disponibili</title>
</head>
<body>
    <h1>Seleziona un Quiz da Svolgere</h1>
    
    <form action="paginaSvolgimentoQuiz.php" method="GET">
        <label for="quizSelezionato">Scegli un quiz:</label>
        <select name="quizSelezionato" id="quizSelezionato" required>
            <?php foreach ($quizDisponibili as $index => $quiz): ?>
                <option value="<?php echo $index; ?>"><?php echo $quiz['nome']; ?> (<?php echo $quiz['difficolta']; ?>)</option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Inizia il Quiz</button>
    </form>

    <form action="paginaUtente.php">
        <button>Torna alla pagina principale</button>
    </form>
</body>
</html>
