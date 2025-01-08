<?php
    include_once "classi/CatalogoQuiz.php"; // Include la classe CatalogoQuiz

    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già stata avviata
    }

    // Verifica se il nome del quiz è stato passato tramite GET
    if (!isset($_GET["nome"])) {
        header('Location: admin.php?messaggio=Nome del quiz non fornito!');
        exit();
    }

    // Creazione del catalogo dei quiz
    $catalogoQuiz = new CatalogoQuiz(); 

    // Tentativo di eliminazione del quiz
    $nomeQuiz = $_GET["nome"];
    $flag = $catalogoQuiz->eliminaQuizTramiteNome($nomeQuiz);

    if ($flag) {
        header('Location: admin.php?messaggio=Hai eliminato correttamente un quiz!');
    } else {
        header('Location: admin.php?messaggio=Errore: il quiz non è stato trovato o non è stato eliminato.');
    }
    exit();
?>
