<?php

class utente {
    // Proprietà private dell'utente
    private $user;
    private $password;
    private $percentualePunteggi = []; // Array per memorizzare le percentuali di punteggio

    // Costruttore della classe
    public function __construct($user, $pass) {
        $this->user = $user;         // Inizializza il nome utente
        $this->password = $pass;     // Inizializza la password
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
                $percentualeQuiz = $valori[3];           // Estrae la percentuale di punteggio

                if ($username == $this->user) {           // Confronta il nome utente corrente
                    $this->percentualePunteggi[] = $percentualeQuiz; // Aggiunge la percentuale alla lista
                }
            }
        }
    }

    // Getter per i punteggi estrapolati
    public function getPercentualePunteggi() {
        return $this->percentualePunteggi;
    }
}
?>
