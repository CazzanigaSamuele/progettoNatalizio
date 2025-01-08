<?php

    if (!isset($_SESSION)) {
        session_start(); // Avvio della sessione se non è già avviata
    }
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit();
    }


// Leggi il file CSV
$file = 'csv/punteggi.csv'; 
$dati = [];

if (($contenuto = fopen($file, 'r')) !== false) {
    while (($colonne = fgetcsv($contenuto, 1000, ';')) !== false) {
        $dati[] = [
            'utente' => $colonne[0],
            'quiz' => $colonne[1],
            'difficolta' => $colonne[2],
            'percentuale' => (int) $colonne[3]
        ];
    }
    fclose($contenuto);
}

// Estrai i nomi dei quiz senza duplicati
$listaQuiz = array_unique(array_column($dati, 'quiz'));
sort($listaQuiz);

// Ottieni il quiz selezionato dall'utente
$quizSelezionato = $_GET['quiz'] ?? null;

// Filtra i dati in base al quiz selezionato
$datiFiltrati = [];
if ($quizSelezionato) {
    foreach ($dati as $dato) {
        if ($dato['quiz'] === $quizSelezionato) {
            // Salva solo il punteggio massimo per ogni utente
            if (!isset($datiFiltrati[$dato['utente']]) || $dato['percentuale'] > $datiFiltrati[$dato['utente']]['percentuale']) {
                $datiFiltrati[$dato['utente']] = $dato;
            }
        }
    }
    // Ordina per percentuale decrescente
    usort($datiFiltrati, function ($a, $b) { //a = primo parametro; b = secondo parametro 
        return $b['percentuale'] - $a['percentuale']; //in base al risultato se è positivo o negativo ci sono 2 casi
        //b maggiore di a quindi b prima ; a maggiore di b quindi a prima
    });
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <h1>Classifica per Quiz</h1>

    <form method="GET">
        <label for="quiz">Seleziona un quiz:</label>
        <select name="quiz" id="quiz" onchange="this.form.submit()">
            <option value="">-- Seleziona un quiz --</option>
            <?php foreach ($listaQuiz as $quiz): ?>
                <option value="<?php echo $quiz; ?>" <?php echo $quizSelezionato === $quiz; ?>>
                    <?php echo $quiz; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

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
                        <td><?php echo "n°" . $index + 1; ?></td>
                        <td><?php echo $dato['utente']; ?></td>
                        <td><?php echo $dato['difficolta']; ?></td>
                        <td><?php echo $dato['percentuale']; ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($quizSelezionato): ?>
        <p style="text-align: center;">Nessun dato disponibile per il quiz selezionato.</p>
    <?php endif; ?>
    <a href="paginaUtente.php">Torna alla pagina utente</a>
</body>
</html>