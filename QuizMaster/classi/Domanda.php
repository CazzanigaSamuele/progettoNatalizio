<?php
    // Definizione della classe Domanda
    class Domanda {

        // Proprietà private per la domanda, le opzioni e la risposta corretta
        private $richiesta;
        private $opzioni = [];
        private $rispostacorretta;
        private $maxRisposte;

        // Costruttore della classe
        public function __construct($richiesta, $rispostacorretta, $opzioni) {
            $this->richiesta = $richiesta;
            $this->rispostacorretta = $rispostacorretta;
            $this->maxRisposte = 4; // Sempre 4 opzioni per domanda
            $this->opzioni = $opzioni;
        }

        // Metodo per stampare la domanda e le opzioni
        public function stampaDomandaRisposte() {
            echo $this->richiesta . "\n"; // Stampa la domanda
            $count = 1; // Conta le opzioni
            for ($i = 0; $i < $this->maxRisposte; $i++) {
                echo "Opzione " . $count . ": " . $this->opzioni[$i] . "\n"; // Stampa ogni opzione
                $count++;
            }
        }

        // Getter per la domanda
        public function getRichiesta() {
            return $this->richiesta;
        }

        // Setter per la domanda
        public function setRichiesta($richiesta) {
            $this->richiesta = $richiesta;
        }

        // Getter per le opzioni
        public function getOpzioni() {
            return $this->opzioni;
        }

        // Getter per la risposta corretta
        public function getRispostaCorretta() {
            return $this->rispostacorretta;
        }

        // Setter per la risposta corretta
        public function setRispostaCorretta($rispostacorretta) {
            $this->rispostacorretta = $rispostacorretta;
        }

        // Getter per il numero massimo di risposte (sempre 4)
        public function getMaxRisposte() {
            return $this->maxRisposte;
        }
    }
?>
