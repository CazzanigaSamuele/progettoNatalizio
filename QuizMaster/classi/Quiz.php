<?php

require_once 'utente.php';

class Quiz {

    private $nomeQuiz;
    private $difficoltàQuiz;
    private $domande = [];

    public function __construct($nomeQuiz, $domande, $difficoltàQuiz) {
        $this->nomeQuiz = $nomeQuiz;
        $this->domande = $domande;
        $this->difficoltàQuiz = $difficoltàQuiz;
    }

    public function getNomeQuiz() {
        return $this->nomeQuiz;
    }

    public function setNomeQuiz($nomeQuiz) {
        $this->nomeQuiz = $nomeQuiz;
    }

    public function getDifficoltàQuiz() {
        return $this->difficoltàQuiz;
    }

    public function setDifficoltàQuiz($difficoltàQuiz) {
        $this->difficoltàQuiz = $difficoltàQuiz;
    }

    public function getDomande() {
        return $this->domande;
    }

    public function aggiungiDomanda(Domanda $domanda) {
        $this->domande[] = $domanda;
    }

    public function getNumDomande(){
        return count($this->domande);
    }

    
}

?>
