<?php
class Utente {
    private $username;
    private $password;
    private $ruolo;

    public function __construct($username, $password, $ruolo) {
        $this->username = $username;
        $this->password = $password;
        $this->ruolo = $ruolo;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRuolo() {
        return $this->ruolo;
    }

    public function setRuolo($ruolo) {
        $this->ruolo=$ruolo;
    }

    public function verificaCredenziali($username, $password) {
        return $this->username == $username && $this->password == $password;
    }
    
    public function toCSV(){
        $riga=$this->getUsername().";".$this->getPassword().";".$this->getRuolo();
        return $riga;
    }
}
?>
