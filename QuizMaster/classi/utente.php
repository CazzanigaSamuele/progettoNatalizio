<?php
require_once 'punteggio.php';

class utente {
    // Proprietà private dell'utente
    private $user;
    private $password;
    private $punteggi; // Array per memorizzare le percentuali di punteggio

    // Costruttore della classe
    public function __construct($user, $pass) {
        $this->user = $user;         // Inizializza il nome utente
        $this->password = $pass;    // Inizializza la password
        $this->punteggi = [];     
        $this->estrapolaRisultatiQuizDalCsv(); // Estrae i risultati dei quiz dal CSV
    }

    // Getter per il nome utente
    public function getUsername() {
        return $this->user;
    }

    // Getter per la password
    public function getPassword() {
        return $this->password;
    }

    // Metodo per verificare le credenziali
    public function verificaCredenziali($username, $password) {
        return $this->user == $username && $this->password == $password; // Confronta username e password
    }

    // Metodo per estrapolare i risultati dei quiz dal file CSV
    public function estrapolaRisultatiQuizDalCsv() {
        $contenuto = file_get_contents("csv/punteggi.csv"); // Legge il contenuto del file CSV
        $righe = explode("\r\n", trim($contenuto));         // Divide le righe del CSV

        foreach ($righe as $riga) {
            $valori = explode(";", $riga);               // Divide ogni riga in valori separati da ';'

            if (count($valori) >= 4) {                   // Controlla se ci sono almeno 4 valori
                $username = $valori[0];                   // Estrae il nome utente dalla riga           

                if ($username == $this->user) {           // Confronta il nome utente corrente
                    $this->punteggi[] = new Punteggio($valori[1],$valori[2],$valori[3]); 
                }
            }
        }
    }

    public function getPunteggi() {
        return $this->punteggi;
    }

}
?>
