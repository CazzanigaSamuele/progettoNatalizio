<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    require_once "classi/Utente.php";

    function leggiUtenti($nomePath) {
        $utenti = [];
        
        $contenuto = file_get_contents($nomePath);
        $righe = explode("\r\n", $contenuto);

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga);
            if (count($colonne) >= 2) {
                $utenti[] = new Utente($colonne[0], $colonne[1]);
            }
        }
        
        return $utenti;
    }


    $username = $_GET["username"];
    $password = $_GET["password"];

    $u = leggiUtenti("csv/utenti.csv");

    foreach ($u as $utente) {
        if ($utente->getUsername() == $username) {
            header("Location: registrazione.php?messaggio=Username già in uso");
            exit;
        }
    }

    $nuovaRiga = $username . ";" . $password;
    file_put_contents("csv/utenti.csv", "\r\n" . $nuovaRiga, FILE_APPEND);

    header("Location: login.php?messaggio=Registrazione completata con successo");
    exit;

?>
