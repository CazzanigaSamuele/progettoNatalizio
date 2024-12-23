<?php
    include_once "classi/CatalogoQuiz.php";
    if (!isset($_SESSION)) {
        session_start();
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

    $domande=$quiz->getDomande();
    $soluzioni=[];
    foreach ($domande as $domanda) {
        $soluzioni[]=$domanda->getRispostaCorretta();
    }

    $risposteDate=[];
    for ($i=0; $i < count($domande); $i++) { 
        $risposteDate[]= $_GET["risposta".$i];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Riepilogo del quiz "<?php echo $nomeQuiz ?>"</h1>
    <table>
        <thead>
            <tr>
                <th>N ° </th>
                <th>Domanda</th>
                <th>Risposta Data</th>
                <th>Risposta Corretta</th>
                <th>Esito</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $punteggio = 0;
                for ($i = 0; $i < count($domande); $i++) {
                    $domanda = $domande[$i];
                    $rispostaCorretta = $soluzioni[$i];
                    $rispostaData = $risposteDate[$i];
                    $corretta="Sbagliata";
                    if($rispostaCorretta == $rispostaData){
                        $corretta = "Corretta";
                    }

                    echo "<tr>";
                    echo "<td>" . ($i + 1) . "</td>";
                    echo "<td>" . $domanda->getRichiesta() . "</td>";
                    echo "<td>" . $rispostaData . "</td>";
                    echo "<td>" . $rispostaCorretta . "</td>";
                    echo "<td>" . $corretta . "</td>";
                    echo "</tr>";

                    if ($corretta=="Corretta") {
                        $punteggio++;
                    }
                }
            ?>
        </tbody>
    </table>
    <h2>Punteggio: <?php echo $punteggio . " / " . count($domande); ?></h2>
    <a href="paginaQuizDisponibili.php">Torna ai quiz disponibili</a>
</body>
</html>

