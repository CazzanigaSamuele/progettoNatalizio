<?php
// Avvia la sessione, se non è già avviata
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica che il nome del quiz sia presente nella sessione
    if (!isset($_SESSION['nQuiz'])) {
        echo "Nome del quiz non trovato nella sessione.";
        exit();
    }

    $nomeQuiz = $_SESSION['nQuiz'];  // Prendi il nome del quiz dalla sessione

    // Gestione del file immagine
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];  // Percorso temporaneo del file
        $fileName = $_FILES['file']['name'];         // Nome originale del file
        $uploadDir = 'immagini/';                     // Cartella per immagazzinare le immagini


        // Creazione di un percorso di destinazione per l'immagine (con il suo nome originale)
        $destPath = $uploadDir . basename($fileName);

        // Sposta il file caricato nella cartella 'immagini/'
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo "Immagine caricata con successo: $fileName<br>";

            // Aggiungi i dati dell'immagine e del quiz nel file CSV
            $datiImmagine = [
                'nomeQuiz' => $nomeQuiz,
                'fileName' => $fileName,
                'filePath' => $destPath
            ];

            // Converti i dati in una stringa CSV
            $datiCSV = implode(";", $datiImmagine) . "\r\n";  // Separatore ; per CSV

            // Scrivi i dati nel file 'immagini.csv'
            file_put_contents('csv/immagini.csv', $datiCSV, FILE_APPEND);

            echo "Dati immagine salvati nel file CSV.<br>";
        } else {
            echo "Errore durante il caricamento dell'immagine.";
        }
    } else {
        echo "Nessun file selezionato o errore nel caricamento.";
    }
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
    <form action="paginaCreazioneQuizUtente.php">
        <button>Torna Indietro</button>
    </form>
</body>
</html>

