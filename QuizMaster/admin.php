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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
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
                    <a href="gestoreEliminaQuiz.php?nome=<?php echo $quiz2->getNomeQuiz(); ?>">Rimuovi Quiz</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Torna alla home</a> <!-- Link per tornare alla pagina utente -->
</body>
</html>
