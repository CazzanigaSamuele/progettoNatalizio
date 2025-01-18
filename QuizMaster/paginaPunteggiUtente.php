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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <?php
        echo "<h1> Punteggi dell'utente: $usernameUtenteAttuale </h1>" ; // Visualizza il nome utente attuale
        echo "<br><br><table>";
        foreach ($punteggi as $punteggio) {
            $nomeQuiz = $punteggio->getNomeQuiz();
            $livelloDifficolta = $punteggio->getLivDifficolta();
            $percentuale = $punteggio->getPercentuale();
            echo "
                <tr>
                    <td> $nomeQuiz </td>
                    <td> $livelloDifficolta  </td>
                    <td> $percentuale% </td>
                </tr>";
        }
        echo "</table>";
    ?>
    <a href="paginaUtente.php">Torna alla pagina utente</a> <!-- Link per tornare alla pagina utente -->
    
</body>
</html>
