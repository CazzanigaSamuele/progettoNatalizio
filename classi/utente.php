<?php
require_once 'punti.php';

class utente {
    private $user;
    private $password;
    private $punti = []; // Array per contenere gli oggetti punti

    public function __construct($user, $pass) {
        $this->user = $user;
        $this->password = $pass;
    }

    public function inizializzaPuntZero() {
        $categorie = ['Storia', 'Geografia', 'Scienze', 'Cultura generale', 'Musica', 'Sport', 'Cinema e Serie TV'];

        // Ciclo per inizializzare un oggetto punti per ogni categoria
        foreach ($categorie as $categoria) {
            $this->punti[$categoria] = new punti(0, $categoria);
        }
    }

    // Metodo per visualizzare i punteggi 
    public function mostraPunteggi() {
        foreach ($this->punti as $categoria => $puntiObj) {
            echo "Categoria: " . $categoria . ", Punteggio: " . $puntiObj->getPunteggio() . "\n";
        }
    }

    public function getUser(){

        return $this->user;

    }
    public function getPassword(){

        return $this->password;

    }
}
?>
