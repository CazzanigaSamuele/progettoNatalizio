<?php
    include_once "classi/domanda.php";

    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_GET['numDomande']) && $_GET['numDomande'] > 0) {
        $numDomande = (int) $_GET['numDomande'];
        $nuovaRiga = "";
        $nomeQuiz= $_GET["nomeQuiz"];
        $difficoltaQuiz= $_GET["livelloDifficolta"];
        $nuovaRiga .= $nomeQuiz;
        $nuovaRiga .= ";".$difficoltaQuiz;
        for ($i = 1; $i <= $numDomande; $i++) {
            $domanda = $_GET["domanda$i"];
            $nuovaRiga .= ";".$domanda;

            for ($j = 1; $j <= 4; $j++) {
                $opzioni[] = $_GET["opzione{$i}{$j}"];
                $nuovaRiga .= ";".$_GET["opzione{$i}{$j}"];
            }

            $opzioneCorretta = $_GET["opzioneCorretta$i"];
            $nuovaRiga .= ";".$opzioneCorretta;
        }
        echo $nuovaRiga . "<br>";

        file_put_contents("csv/quizCreati.csv", "\r\n".$nuovaRiga , FILE_APPEND);

        header('Location: paginaCreazioneQuizUtente.php?numDomande=' . $numDomande . '&messaggio="quiz creato correttamente!!!"');
        exit();
    }
?>
