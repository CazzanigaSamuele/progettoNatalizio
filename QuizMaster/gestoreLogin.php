<?php
session_start();  

// Funzione per verificare le credenziali nel file CSV
function verificaCredenziali($username, $password) {
    $filePath = 'csv/credenzialiUtenti.csv';  // Percorso del file CSV
    if (file_exists($filePath)) {
        // Apri il file CSV
        if (($file = fopen($filePath, 'r')) !== false) {
            // Scorri le righe del file
            while (($row = fgetcsv($file, 1000, ';')) !== false) {
                $fileUsername = trim($row[0]);  // Rimuovi eventuali spazi extra
                $filePassword = trim($row[1]);  // Rimuovi eventuali spazi extra

                // Verifica se le credenziali corrispondono
                if ($username === $fileUsername && $password === $filePassword) {
                    fclose($file);
                    return true;  // Le credenziali sono corrette
                }
            }
            fclose($file);
        }
    }
    return false;  // Le credenziali non sono corrette
}

// Verifica se i parametri sono stati passati tramite GET
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Verifica le credenziali nel file CSV
    if (verificaCredenziali($username, $password)) {
        $_SESSION['username'] = $username;  // Memorizza il nome utente nella sessione
        header('Location: paginaUtente.php');  // Reindirizza all'area protetta
        exit();
    } else {
        header('Location: login.php?errore=Credenziali errate!');  // Reindirizza alla pagina di login con un errore
        exit();
    }
} else {
    // Se i parametri username e password non sono passati, reindirizza alla pagina di login
    header('Location: login.php');
    exit();
}
?>
