<?php

include_once "classi/Quiz.php";
include_once "classi/Domanda.php";

class CatalogoQuiz 
{
    private $quiz;

    public function __construct() {
        $this->quiz = [];
        $this->estrapolaQuizDalCsv();
    }

    public function estrapolaQuizDalCsv() {
        $contenuto = file_get_contents("csv/quizCreati.csv");
        $righe = explode("\r\n", $contenuto); 

        $quizTemp = null;

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga);
            $nomeQuiz = $colonne[0];
            $difficoltàQuiz = $colonne[1];
            $richiesta = $colonne[2];
            $opzione1 = $colonne[3];
            $opzione2 = $colonne[4];
            $opzione3 = $colonne[5];
            $opzione4 = $colonne[6];
            $opzioni = [$opzione1, $opzione2, $opzione3, $opzione4];
            $rispostaCorretta = $colonne[7];

            $domanda = new Domanda($richiesta, $rispostaCorretta, $opzioni);

            if ($quizTemp === null || $quizTemp->getNomeQuiz() !== $nomeQuiz || $quizTemp->getDifficoltàQuiz() !== $difficoltàQuiz) {
                $quizTemp = new Quiz($nomeQuiz, [$domanda], $difficoltàQuiz);
                $this->quiz[] = $quizTemp;
            } else {
                $quizTemp->aggiungiDomanda($domanda);
            }
        }
    }

    public function getQuiz() {
        return $this->quiz;
    }

    public function ottieniQuizTramiteNome($nomeQuiz){
        $quizTmp=null;
        foreach ($this->quiz as $elemento) {
            if($elemento->getNomeQuiz() == $nomeQuiz) {
                $quizTmp = $elemento;
            }
        }

        return $quizTmp;
    }
}
?>
