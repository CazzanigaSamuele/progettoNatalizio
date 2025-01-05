<?php
    include_once "classi/utenti.php"; // Inclusione della classe 'utenti'
    if (!isset($_SESSION)) {
        session_start(); // Avvio della sessione se non è già avviata
    }
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit();
    }

    $u = new utenti(); // Creazione di un'istanza della classe 'utenti'
    $usernameUtenteAttuale = $_SESSION["username"]; // Recupera il nome utente attuale dalla sessione
    $punteggi = $u->getRisultatiQuizDalNome($usernameUtenteAttuale); // Recupera i punteggi dei quiz

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo $usernameUtenteAttuale; // Visualizza il nome utente attuale
        foreach ($punteggi as $punteggio) {
            echo $punteggio;
            echo "<br>";
        }
    ?>
</body>
</html>
