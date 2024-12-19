<?php

class domanda{

    private $richiesta; //stringa della domanda quindi esempio: Quale la capitale dell'italia?
    private $opzioni = []; //opzioni possibili

    private $rispostacorretta; //risposta corretta
    private $maxRisposte;

    public function __construct($richiesta, $rispostacorretta, $opzioni) {
        $this->richiesta = $richiesta;
        $this->rispostacorretta = $rispostacorretta;
        $this->maxRisposte = 4;
        $this->opzioni;
    }

    public function stampaDomandaRisposte(){
        echo $this->richiesta . "\n";
        $count = 1; //variabile per stampa concreta
        for ($i=0; $i < $this->maxRisposte; $i++) { 
            echo "Opzione". $count . ": " . $this->opzioni[$i] . "\n"; 
            $count++; 
        }

    }

    


}

?>