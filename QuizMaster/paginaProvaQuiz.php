<?php
    include_once "classi/CatalogoQuiz.php";
    if (!isset($_SESSION)) {
        session_start();
    }

    $c = new CatalogoQuiz();

    $nomeQuiz = $_GET["nome"];
    $quizScelto = $c->ottieniQuizTramiteNome($nomeQuiz);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Quiz: <?php echo $quizScelto->getNomeQuiz(); ?></h1>
    <form action="PaginaValutaQuiz.php" method="get">
        <?php 
            $indice = 0; 
            foreach ($quizScelto->getDomande() as $domanda) {
                echo '<p>' . ($indice + 1) . '. ' . $domanda->getRichiesta() . '</p>';
                $opzioni = $domanda->getOpzioni();
                echo '<select name="risposta' . $indice . '">';
                foreach ($opzioni as $opzione) {
                    echo '<option value="' . $opzione . '">' . $opzione . '</option>';
                }
                echo "</select><br>";
                $indice++;
            }
        ?>
        <input type="hidden" name="nomeQuiz" value="<?php echo $nomeQuiz ?>">
        <button type="submit">Invia quiz</button>
    </form>

    <a href="paginaQuizDisponibili.php">Torna ai quiz</a>
</body>
</html>
