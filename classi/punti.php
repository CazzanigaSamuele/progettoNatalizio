<?php
   class punti   
    {
        private $punteggio;
        private $categoria;

        private $numcategorie;
        
        public function __construct($punt, $cat) {
            $this->punteggio = $punt;
            $this->categoria = $cat;
        }

        public function setCategoria($cat)
        {
            $this->categoria = $cat;
        }

        public function setPunteggio($punt)
        {
            $this->punteggio = $punt;
        }

        public function getCategoria(){

            return $this->categoria;

        }
        public function getPunteggio(){

            return $this->punteggio;

        }
        public function getNumCategorie(){

            return $this->numcategorie;

        }
        
    }
    

?>