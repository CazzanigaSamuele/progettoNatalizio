<?php 
require_once "Utente.php";

class Utenti
{
    public $utenti = []; // Inizializza l'array degli utenti

    public function __construct() {
        $contenuto = file_get_contents("csv/utenti.csv");
        $righe = explode("\r\n", trim($contenuto));

        foreach ($righe as $riga) {
            $colonne = explode(";", $riga);

            if (count($colonne) == 3) {
                $username = $colonne[0];
                $password = $colonne[1];
                $ruolo = $colonne[2];

                $this->utenti[] = new Utente($username, $password, $ruolo);
            }
        }
    }

    public function restituisciUtenti() {
        $nomi = [];
        foreach ($this->utenti as $utente) {
            $nomi[] = $utente;
        }
        return $nomi;
    }

    public function modificaRuoloTramiteUsername($username, $ruolo) {
        foreach ($this->utenti as $utente) {
            if ($utente->getUsername() == $username) {
                $utente->setRuolo($ruolo);
            }
        }
    }
}
?>
