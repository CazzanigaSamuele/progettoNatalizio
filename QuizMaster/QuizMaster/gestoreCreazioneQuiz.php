<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_GET['numDomande'])&& $_GET['numDomande']>0) {

        $numDomande= (int)$_GET['numDomande'];

        header("location: paginaCreazioneQuizUtente.php?numDomande=$numDomande");
        exit();
    }
?>
