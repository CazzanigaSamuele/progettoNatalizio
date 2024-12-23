<?php
    include_once "classi/CatalogoQuiz.php";

    if (!isset($_SESSION)) {
        session_start();
    }
    $catalogoQuiz= new catalogoQuiz();
    $quiz= $catalogoQuiz->getQuiz();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Quiz disponibili</h1>
    <table>
        <thead>
            <tr>
                <th>Nome Quiz</th>
                <th>Difficoltà</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quiz as $quiz2): ?>
                <tr>
                    <td><?php echo $quiz2->getNomeQuiz() ?></td>
                    <td><?php echo $quiz2->getDifficoltàQuiz() ?></td>
                    <td>
                        <a href="paginaProvaQuiz.php?nome=<?php echo $quiz2->getNomeQuiz(); ?>">Prova quiz</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
