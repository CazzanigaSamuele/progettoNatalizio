<?php
    include_once "classi/CatalogoQuiz.php";
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php');
        exit();
    }

    $nomeQuiz="";
    if (isset($_GET["nomeQuiz"])) {
        $nomeQuiz = $_GET["nomeQuiz"];
    } else {
        echo "Errore: quiz non è stato passato correttamente.";
        exit;
    }

    $c= new CatalogoQuiz();

    $quiz=$c->ottieniQuizTramiteNome($nomeQuiz);
    
    $difficoltaQuiz=$quiz->getDifficoltàQuiz();

    $domande=$quiz->getDomande();
    $soluzioni=[];
    foreach ($domande as $domanda) {
        $soluzioni[]=$domanda->getRispostaCorretta();
    }

    $risposteDate=[];
    for ($i=0; $i < count($domande); $i++) { 
        $risposteDate[]= $_GET["risposta".$i];
    }

    $nomeUtente = $_SESSION["username"];

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
    <h1>Riepilogo del quiz "<?php echo $nomeQuiz ?>"</h1>
    <table>
        <?php 
            $punteggio = 0;

            echo "<tr>";
            echo "<td><strong>N°</strong></td>";
            echo "<td><strong>Domanda</strong></td>";
            echo "<td><strong>Risposta Data</strong></td>";
            echo "<td><strong>Risposta Corretta</strong></td>";
            echo "<td><strong>Esito</strong></td>";
            echo "</tr>";

            for ($i = 0; $i < count($domande); $i++) {
                $domanda = $domande[$i];
                $rispostaCorretta = $soluzioni[$i];
                $rispostaData = $risposteDate[$i];
                $corretta = "Sbagliata";
                if ($rispostaCorretta == $rispostaData) {
                    $corretta = "Corretta";
                }

                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>" . $domanda->getRichiesta() . "</td>";
                echo "<td>" . $rispostaData . "</td>";
                echo "<td>" . $rispostaCorretta . "</td>";
                echo "<td>" . $corretta . "</td>";
                echo "</tr>";

                if ($corretta == "Corretta") {
                    $punteggio++;
                }
            }

            $percentuale = ($punteggio / count($domande)) * 100;
            $percentuale = round($percentuale);
            $nuovaRiga=$nomeUtente.";".$nomeQuiz.";".$difficoltaQuiz.";".$percentuale."\r\n";
            file_put_contents("csv/punteggi.csv", $nuovaRiga, FILE_APPEND);
        ?>
    </table>

    <h2>Punteggio: <?php echo $punteggio . " / " . count($domande); ?></h2>
    <a href="paginaQuizDisponibili.php">Torna ai quiz disponibili</a>
    <a href="index.php">Torna all'index</a>
</body>
</html>