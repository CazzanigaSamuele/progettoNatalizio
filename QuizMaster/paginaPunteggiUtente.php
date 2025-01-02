<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    // Se l'utente non è loggato, reindirizzalo alla pagina di login
    header('Location: login.php');
    exit();  
}

$nomeUtente = $_SESSION['username'];  // Ottieni il nome utente dalla sessione

// Percorso del file CSV
$filePath = 'csv/punteggi.csv';

if (!file_exists($filePath)) {
    exit("Errore: il file dei punteggi non esiste.");
}

// Leggi il file CSV
$punteggi = [];
if (($file = fopen($filePath, 'r')) !== false) {
    // Salta la prima riga (intestazioni del CSV)
    fgetcsv($file, 0, ';');

    // Leggi tutte le righe del CSV
    while (($data = fgetcsv($file, 1000, ';')) !== false) {
        // Ogni riga: nome_utente;nome_quiz;livello_difficolta;percentuale
        if ($data[0] == $nomeUtente) {
            $punteggi[] = [
                'nome_quiz' => $data[1],
                'livello_difficolta' => $data[2],
                'percentuale' => $data[3]
            ];
        }
    }
    fclose($file);
}

if (empty($punteggi)) {
    echo "<h1>Non hai ancora completato alcun quiz.</h1>";
} else {
    echo "<h1>Punteggi per $nomeUtente</h1>";
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Nome Quiz</th>
                    <th>Livello di Difficoltà</th>
                    <th>Percentuale</th>
                </tr>
            </thead>
            <tbody>";

    // Mostra i punteggi in una tabella
    foreach ($punteggi as $punteggio) {
        echo "<tr>
                <td>{$punteggio['nome_quiz']}</td>
                <td>{$punteggio['livello_difficolta']}</td>
                <td>{$punteggio['percentuale']}%</td>
              </tr>";
    }

    echo "</tbody></table>";
}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<form action="paginaUtente.php">
    <button>Torna alla pagina Iniziale</button>
</form>
