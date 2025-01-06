<?php
class Punteggio{

    private $nomeQuiz;
    private $livelloDifficolta;
    private $percentuale;

    public function __construct($nQuiz, $livDiff, $percentuale) {
        $this->nomeQuiz = $nQuiz;
        $this->livelloDifficolta = $livDiff;
        $this->percentuale = $percentuale;
    }

    public function getNomeQuiz(){

        return $this->nomeQuiz;

    }
    public function getLivDifficolta(){

        return $this->livelloDifficolta;

    }
    public function getPercentuale(){

        return $this->percentuale;

    }
}

?>