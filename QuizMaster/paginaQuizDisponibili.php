<?php
    include_once "classi/CatalogoQuiz.php"; // Inclusione della classe 'CatalogoQuiz'

    if (!isset($_SESSION)) {
        session_start(); // Avvio della sessione se non è già avviata
    }

    if (!isset($_SESSION['autenticato'])) {
        header('Location: login.php'); // Reindirizza a login.php se non autenticato
        exit();
    }

    $catalogoQuiz = new CatalogoQuiz(); // Creazione di un'istanza della classe 'CatalogoQuiz'
    $quiz = $catalogoQuiz->getQuiz(); // Ottiene tutti i quiz dal catalogo
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Stile CSS -->
</head>
<body>
    <h1>Quiz disponibili</h1>
    <table>
        <tr>
            <td><strong>Nome Quiz</strong></td>
            <td><strong>Difficoltà</strong></td>
            <td><strong>Link</strong></td>
        </tr>
        <?php foreach ($quiz as $quiz2): ?> <!-- Ciclo attraverso tutti i quiz ottenuti -->
            <tr>
                <td><?php echo $quiz2->getNomeQuiz(); ?></td> <!-- Nome del quiz -->
                <td><?php echo $quiz2->getDifficoltàQuiz(); ?></td> <!-- Difficoltà del quiz -->
                <td>
                    <a href="paginaProvaQuiz.php?nome=<?php echo $quiz2->getNomeQuiz(); ?>">Prova quiz</a>
                </td> <!-- Link per accedere al quiz -->
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="paginaUtente.php">Torna alla pagina utente</a> <!-- Link per tornare alla pagina utente -->
</body>
</html>
