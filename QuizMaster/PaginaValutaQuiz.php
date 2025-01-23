<?php
    include_once "classi/CatalogoQuiz.php"; 

    // Controlla se una sessione è già stata avviata, altrimenti la avvia
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verifica se l'utente è autenticato
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit(); // Interrompe l'esecuzione dello script
    }

    // Recupera il nome del quiz dai parametri GET
    $nomeQuiz = "";
    if (isset($_GET["nomeQuiz"])) {
        $nomeQuiz = $_GET["nomeQuiz"]; // Nome del quiz passato tramite GET
    } else {
        echo "Errore: quiz non è stato passato correttamente."; // Messaggio di errore
        exit; // Interrompe l'esecuzione dello script
    }

    // Creazione di un'istanza della classe 'CatalogoQuiz'
    $c = new CatalogoQuiz();

    // Recupera il quiz tramite il nome
    $quiz = $c->ottieniQuizTramiteNome($nomeQuiz);

    // Ottiene la difficoltà del quiz
    $difficoltaQuiz = $quiz->getDifficoltàQuiz();

    // Ottiene le domande del quiz
    $domande = $quiz->getDomande();

    // Recupera le risposte corrette per ogni domanda
    $soluzioni = [];
    foreach ($domande as $domanda) {
        $soluzioni[] = $domanda->getRispostaCorretta(); // Salva la risposta corretta
    }

    // Recupera le risposte date dall'utente tramite GET
    $risposteDate = [];
    for ($i = 0; $i < count($domande); $i++) { 
        $risposteDate[] = $_GET["risposta" . $i]; // Risposte dell'utente
    }

    // Recupera il nome utente dalla sessione
    $nomeUtente = $_SESSION["username"]; 

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
    <h1>Riepilogo del quiz "<?php echo $nomeQuiz ?>"</h1> <!-- Titolo con il nome del quiz -->
    <table>
        <?php 
            // Inizializza il punteggio
            $punteggio = 0;

            // Intestazione della tabella
            echo "<tr>";
            echo "<td><strong>N°</strong></td>"; // Colonna numero della domanda
            echo "<td><strong>Domanda</strong></td>"; // Colonna domanda
            echo "<td><strong>Risposta Data</strong></td>"; // Colonna risposta data
            echo "<td><strong>Risposta Corretta</strong></td>"; // Colonna risposta corretta
            echo "<td><strong>Esito</strong></td>"; // Colonna esito (Corretta/Sbagliata)
            echo "</tr>";

            // Itera attraverso le domande per generare le righe della tabella
            for ($i = 0; $i < count($domande); $i++) {
                $domanda = $domande[$i]; // Recupera la domanda corrente
                $rispostaCorretta = $soluzioni[$i]; // Recupera la risposta corretta
                $rispostaData = $risposteDate[$i]; // Recupera la risposta data dall'utente
                $corretta = "Sbagliata"; // Valore predefinito per l'esito

                // Verifica se la risposta data è corretta
                if ($rispostaCorretta == $rispostaData) {
                    $corretta = "Corretta";
                }

                // Genera una riga della tabella
                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>"; // Numero della domanda
                echo "<td>" . $domanda->getRichiesta() . "</td>"; // Testo della domanda
                echo "<td>" . $rispostaData . "</td>"; // Risposta data
                echo "<td>" . $rispostaCorretta . "</td>"; // Risposta corretta
                echo "<td>" . $corretta . "</td>"; // Esito
                echo "</tr>";

                // Incrementa il punteggio se la risposta è corretta
                if ($corretta == "Corretta") {
                    $punteggio++;
                }
            }

            // Calcola la percentuale di risposte corrette
            $percentuale = ($punteggio / count($domande)) * 100;
            $percentuale = round($percentuale); // Arrotonda la percentuale

            // Crea una nuova riga per il file CSV
            $nuovaRiga = $nomeUtente . ";" . $nomeQuiz . ";" . $difficoltaQuiz . ";" . $percentuale . "\r\n";

            // Salva i risultati nel file CSV
            file_put_contents("csv/punteggi.csv", $nuovaRiga, FILE_APPEND); 
        ?>
    </table>

    <h2>Punteggio: <?php echo $punteggio . " / " . count($domande); ?></h2> <!-- Visualizza il punteggio -->
    <!-- Link per tornare ai quiz disponibili -->
    <a href="paginaQuizDisponibili.php">Torna ai quiz disponibili</a> 
    <!-- Link per tornare alla pagina principale -->
    <a href="index.php">Torna all'index</a> 
</body>
</html>
