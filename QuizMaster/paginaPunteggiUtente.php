<?php
    include_once "classi/utenti.php"; 
    
    // Controlla se una sessione è già stata avviata, altrimenti la avvia
    if (!isset($_SESSION)) {
        session_start(); // Avvio della sessione se non è già avviata
    }

    // Verifica se l'utente è autenticato
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit(); // Interrompe l'esecuzione dello script
    }

    // Creazione di un'istanza della classe 'utenti'
    $u = new utenti(); 

    // Recupera il nome utente attuale dalla sessione
    $usernameUtenteAttuale = $_SESSION["username"]; 

    // Recupera i punteggi dei quiz associati al nome utente attuale
    $punteggi = $u->getRisultatiQuizDalNome($usernameUtenteAttuale); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Collegamento ai font e al file CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <?php
        // Visualizza il titolo della pagina con il nome utente attuale
        echo "<h1> Punteggi dell'utente: $usernameUtenteAttuale </h1>"; 
        echo "<br><br><table>"; // Apertura della tabella per visualizzare i punteggi

        // Itera attraverso l'elenco dei punteggi
        foreach ($punteggi as $punteggio) {
            // Recupera le informazioni dal punteggio corrente
            $nomeQuiz = $punteggio->getNomeQuiz(); // Nome del quiz
            $livelloDifficolta = $punteggio->getLivDifficolta(); // Livello di difficoltà del quiz
            $percentuale = $punteggio->getPercentuale(); // Percentuale di completamento

            // Aggiunge una riga alla tabella con le informazioni del punteggio
            echo "
                <tr>
                    <td> $nomeQuiz </td> <!-- Colonna con il nome del quiz -->
                    <td> $livelloDifficolta  </td> <!-- Colonna con il livello di difficoltà -->
                    <td> $percentuale% </td> <!-- Colonna con la percentuale di completamento -->
                </tr>";
        }

        echo "</table>"; // Chiusura della tabella
    ?>
    <!-- Link per tornare alla pagina utente -->
    <a href="paginaUtente.php">Torna alla pagina utente</a> 
    
</body>
</html>
