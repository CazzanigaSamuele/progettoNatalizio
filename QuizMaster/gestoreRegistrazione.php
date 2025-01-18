<?php
    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già attiva
    }

    require_once "classi/Utente.php"; // Include la classe Utente

    // Funzione per leggere gli utenti dal file CSV
    function leggiUtenti($nomePath) {
        $utenti = []; // Array per memorizzare gli utenti

        // Legge il contenuto del file CSV
        $contenuto = file_get_contents($nomePath);
        $righe = explode("\r\n", $contenuto); // Suddivide il contenuto in righe

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga); // Suddivide la riga in colonne
            if (count($colonne) >= 2) {
                $utenti[] = new Utente($colonne[0], $colonne[1]); // Crea un oggetto Utente e lo aggiunge all'array
            }
        }
        
        return $utenti; // Restituisce l'elenco di utenti
    }

    $username = $_GET["username"]; // Ottiene il valore dell'username dalla query GET
    $password = $_GET["password"]; // Ottiene il valore della password dalla query GET

    $u = leggiUtenti("csv/utenti.csv"); // Legge gli utenti dal file CSV

    // Controlla se l'username è già presente
    foreach ($u as $utente) {
        if ($utente->getUsername() == $username) {
            header("Location: registrazione.php?messaggio=Username già in uso"); // Redirige se l'username esiste già
            exit;
        }
    }

    // Aggiunge il nuovo utente al file CSV
    $nuovaRiga = $username . ";" . $password;
    file_put_contents("csv/credenzialiUtenti.csv", "\r\n" . $nuovaRiga, FILE_APPEND); // Aggiunge la nuova riga al file

    header("Location: login.php?messaggio=Registrazione completata con successo"); // Reindirizza con messaggio di successo
    exit;

?>
