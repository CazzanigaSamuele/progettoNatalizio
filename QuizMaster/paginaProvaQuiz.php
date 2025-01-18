<?php
    include_once "classi/CatalogoQuiz.php"; // Inclusione della classe CatalogoQuiz
    if (!isset($_SESSION)) {
        session_start(); // Avvio sessione se non è già avviata
    }
    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit();
    }
    $c = new CatalogoQuiz(); // Creazione di un'istanza di CatalogoQuiz

    $nomeQuiz = $_GET["nome"]; // Recupero del nome del quiz tramite GET
    $quizScelto = $c->ottieniQuizTramiteNome($nomeQuiz); // Ottiene il quiz selezionato tramite nome
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">

</head>
<body>
    <h1>Quiz: <?php echo $quizScelto->getNomeQuiz(); ?></h1> <!-- Nome del quiz -->
    <form action="PaginaValutaQuiz.php" method="get">
        <?php 
            $indice = 0; 
            foreach ($quizScelto->getDomande() as $domanda) {
                echo '<p>' . ($indice + 1) . '. ' . $domanda->getRichiesta() . '</p>'; // Mostra domanda
                $opzioni = $domanda->getOpzioni(); // Recupera le opzioni
                echo '<select name="risposta' . $indice . '">'; // Selezione per risposte
                foreach ($opzioni as $opzione) {
                    echo '<option value="' . $opzione . '">' . $opzione . '</option>'; // Ogni opzione è un elemento dell'elenco a discesa
                }
                echo "</select><br>"; // Chiude il select
                $indice++;
            }
        ?>
        <input type="hidden" name="nomeQuiz" value="<?php echo $nomeQuiz ?>"> <!-- Nasconde il nome del quiz -->
        <button type="submit">Invia quiz</button> <!-- Pulsante per inviare il quiz -->
    </form>

    <a href="paginaQuizDisponibili.php">Torna ai quiz</a> <!-- Link per tornare alla pagina dei quiz -->
</body>
</html>
