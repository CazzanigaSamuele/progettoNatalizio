<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    require_once "Utente.php";

    $u = [];

    $contenuto = file_get_contents("csv/utenti.csv");
    $righe = explode("\r\n", $contenuto);

    foreach ($righe as $riga) {
        
        $colonne = explode(";", $riga);
        $username = $colonne[0];
        $password = $colonne[1];
        $ruolo =$colonne[2];

        $u[] = new Utente($username, $password, $ruolo);
    }

    $autenticato = false;

    if (!isset($_GET["username"]) || !isset($_GET["password"])) {
        header("location: login.php?messaggio=Inserire username e password");
        exit;
    }

    $username = $_GET["username"];
    $password = $_GET["password"];

    foreach ($u as $utente) {
        if ($utente->verificaCredenziali($username, $password)) {
            $_SESSION["autenticato"] = true;
            $_SESSION["utente"] = $utente->getRuolo();
            $autenticato = true;
            break;
        }
    }

    if (!$autenticato) {
        header("location: login.php?messaggio=Credenziali errate");
        exit;
    }

    header("location: stampa.php");
    exit;

?>
