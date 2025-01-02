<?php

class utente {
    private $user;
    private $password;

    public function __construct($user, $pass) {
        $this->user = $user;
        $this->password = $pass;
    }
    public function getUsername(){

        return $this->user;

    }
    public function getPassword(){

        return $this->password;

    }
}
?>
