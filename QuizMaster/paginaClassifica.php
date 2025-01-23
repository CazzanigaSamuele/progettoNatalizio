<?php

    // Controlla se una sessione è già stata avviata, se no avviala
    if (!isset($_SESSION)) {
        session_start(); // Avvio della sessione se non è già avviata
    }

    // Verifica se l'utente è autenticato
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit(); // Interrompe l'esecuzione dello script
    }

    // Specifica il percorso del file CSV contenente i punteggi
    $file = 'csv/punteggi.csv'; 
    $dati = []; // Array per memorizzare i dati letti dal file

    // Verifica se il file esiste
    if (file_exists($file)) {
        $contenuto = file_get_contents($file); // Legge il contenuto del file
        $righe = explode("\n", $contenuto); // Suddivide il contenuto in righe

        foreach ($righe as $riga) {
            if (!empty(trim($riga))) { // Salta eventuali righe vuote
                $colonne = explode(';', $riga); // Divide la riga in colonne usando ";" come separatore
                $dati[] = [
                    'utente' => $colonne[0], // Nome utente
                    'quiz' => $colonne[1], // Nome del quiz
                    'difficolta' => $colonne[2], // Livello di difficoltà del quiz
                    'percentuale' => (int) $colonne[3] // Percentuale di completamento
                ];
            }
        }
    }

    // Crea una lista dei nomi dei quiz univoci
    $listaQuiz = [];
    foreach ($dati as $dato) {
        if (!in_array($dato['quiz'], $listaQuiz)) {
            $listaQuiz[] = $dato['quiz']; // Aggiunge il quiz alla lista se non è già presente
        }
    }

    // Determina quale quiz è stato selezionato dall'utente (tramite parametro GET)
    $quizSelezionato = $_GET['quiz'] ?? null;

    // Filtra i dati in base al quiz selezionato
    $datiFiltrati = [];
    if ($quizSelezionato) {
        foreach ($dati as $dato) {
            if ($dato['quiz'] === $quizSelezionato) {
                // Mantiene solo il punteggio massimo per ogni utente
                if (!isset($datiFiltrati[$dato['utente']]) || $dato['percentuale'] > $datiFiltrati[$dato['utente']]['percentuale']) {
                    $datiFiltrati[$dato['utente']] = $dato;
                }
            }
        }

        // Ordina i dati filtrati per percentuale decrescente (manual sorting)
        $ordinato = [];
        while (!empty($datiFiltrati)) {
            $massimo = null;
            foreach ($datiFiltrati as $chiave => $valore) {
                if ($massimo === null || $valore['percentuale'] > $massimo['percentuale']) {
                    $massimo = $valore; // Trova l'elemento con il punteggio massimo
                    $indiceMassimo = $chiave;
                }
            }
            $ordinato[] = $massimo; // Aggiunge il massimo trovato all'array ordinato
            unset($datiFiltrati[$indiceMassimo]); // Rimuove l'elemento già aggiunto
        }
        $datiFiltrati = $ordinato; // Sostituisce i dati filtrati con quelli ordinati
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Quiz</title>
    <!-- Link ai font e allo stile CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <h1>Classifica per Quiz</h1>

    <!-- Form per la selezione del quiz -->
    <form method="GET">
        <label for="quiz">Seleziona un quiz:</label>
        <select name="quiz" id="quiz" onchange="this.form.submit()">
            <option value="">-- Seleziona un quiz --</option>
            <?php foreach ($listaQuiz as $quiz): ?>
                <option value="<?php echo $quiz; ?>" <?php echo $quizSelezionato === $quiz ? 'selected' : ''; ?>>
                    <?php echo $quiz; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Tabella dei risultati filtrati -->
    <?php if ($quizSelezionato && $datiFiltrati): ?>
        <table>
            <thead>
                <tr>
                    <th>Posizione</th>
                    <th>Utente</th>
                    <th>Difficolta</th>
                    <th>Percentuale</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datiFiltrati as $index => $dato): ?>
                    <tr>
                        <td><?php echo "n°" . ($index + 1); ?></td> <!-- Posizione dell'utente -->
                        <td><?php echo $dato['utente']; ?></td> <!-- Nome utente -->
                        <td><?php echo $dato['difficolta']; ?></td> <!-- Livello di difficoltà -->
                        <td><?php echo $dato['percentuale']; ?>%</td> <!-- Percentuale di completamento -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($quizSelezionato): ?>
        <!-- Messaggio se non ci sono dati disponibili per il quiz selezionato -->
        <p style="text-align: center;">Nessun dato disponibile per il quiz selezionato.</p>
    <?php endif; ?>
    <!-- Link per tornare alla pagina utente -->
    <a href="paginaUtente.php">Torna alla pagina utente</a>
</body>
</html>
