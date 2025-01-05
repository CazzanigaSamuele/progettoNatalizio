<?php

if (!isset($_SESSION)) {
    session_start(); // Avvia la sessione se non è già attiva
}

require_once "classi/Utente.php"; // Include la classe Utente

$u = []; // Inizializza un array vuoto per memorizzare gli utenti

// Legge il contenuto del file CSV e suddivide le righe in array
$contenuto = file_get_contents("csv/credenzialiUtenti.csv");
$righe = explode("\r\n", $contenuto);

// Per ogni riga nel file CSV, crea un oggetto Utente
foreach ($righe as $riga) {
    $colonne = explode(";", $riga); // Suddivide la riga in colonne
    $username = $colonne[0]; // Primo valore è l'username
    $password = $colonne[1]; // Secondo valore è la password

    $u[] = new Utente($username, $password); // Crea un oggetto Utente e lo aggiunge all'array
}

$autenticato = false; // Inizializza la variabile di stato di autenticazione

// Controlla se i parametri 'username' e 'password' sono stati inviati via GET
if (!isset($_GET["username"]) || !isset($_GET["password"])) {
    header("location: login.php?messaggio=Inserire username e password"); // Redirige con messaggio di errore
    exit;
}

$username = $_GET["username"];
$password = $_GET["password"];

// Verifica se l'utente esiste e le credenziali sono corrette
foreach ($u as $utente) {
    if ($utente->verificaCredenziali($username, $password)) {
        $_SESSION["autenticato"] = true; // Setta la sessione di autenticazione
        $_SESSION["username"] = $username; // Memorizza l'username in sessione
        $autenticato = true; // Imposta autenticato come vero
        break;
    }
}

if (!$autenticato) {
    header("location: login.php?messaggio=Credenziali errate"); // Redirige con errore se non autenticato
    exit;
}

// Se autenticazione riuscita, redirige alla pagina dell'utente
header("location: paginaUtente.php?username=$username");
exit;

?>
