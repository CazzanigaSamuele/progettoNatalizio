<?php
require_once 'utente.php'; // Include la classe Utente

class utenti
{
    private $utenti; // Array per memorizzare gli utenti

    public function __construct() {
        $this->utenti = []; // Inizializza l'array degli utenti vuoto
        $this->estrapolaUtenti(); // Estrae gli utenti dal file CSV
    }

    // Metodo per estrapolare gli utenti dal file CSV
    public function estrapolaUtenti(){
        $contenuto = file_get_contents("csv/credenzialiUtenti.csv"); // Legge il contenuto del file CSV
        $righe = explode("\r\n", $contenuto); // Divide le righe del CSV

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga); // Divide ogni riga in colonne separate da ';'

            if (count($colonne) >= 2) { // Controlla se ci sono almeno 2 colonne (username e password)
                $username = $colonne[0];       // Estrae il nome utente
                $password = $colonne[1];       // Estrae la password

                $this->utenti[] = new Utente($username, $password); // Crea un oggetto Utente e lo aggiunge all'array
            }
        }
    }

    // Metodo per ottenere l'elenco degli utenti
    public function getUtenti() {
        return $this->utenti;
    }

    // Metodo per ottenere i punteggi dei quiz di un determinato utente
    public function getRisultatiQuizDalNome($nomeUser){
        foreach($this->utenti as $utente){
            if($utente->getUsername() == $nomeUser){ // Cerca l'utente specifico
                return $utente->getPercentualePunteggi(); // Restituisce i punteggi
            }
        }
    }
}
?>
