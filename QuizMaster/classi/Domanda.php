<?php

    class Domanda {

        private $richiesta;
        private $opzioni = [];
        private $rispostacorretta;
        private $maxRisposte;

        public function __construct( $richiesta, $rispostacorretta, $opzioni) {
            $this->richiesta = $richiesta;
            $this->rispostacorretta = $rispostacorretta;
            $this->maxRisposte = 4;
            $this->opzioni = $opzioni;
        }

        public function stampaDomandaRisposte() {
            echo $this->richiesta . "\n";
            $count = 1;
            for ($i = 0; $i < $this->maxRisposte; $i++) {
                echo "Opzione " . $count . ": " . $this->opzioni[$i] . "\n";
                $count++;
            }
        }
        public function getRichiesta() {
            return $this->richiesta;
        }

        public function setRichiesta($richiesta) {
            $this->richiesta = $richiesta;
        }

        public function getOpzioni() {
            return $this->opzioni;
        }

        public function getRispostaCorretta() {
            return $this->rispostacorretta;
        }

        public function setRispostaCorretta($rispostacorretta) {
            $this->rispostacorretta = $rispostacorretta;
        }

        public function getMaxRisposte() {
            return $this->maxRisposte;
        }
    }

?>
