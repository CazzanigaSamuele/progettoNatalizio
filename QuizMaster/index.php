<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="float:right">
        <?php 
            if (isset($_SESSION["autenticato"]) && $_SESSION["autenticato"] == true) {
                echo '<a href="stampa.php">Vai a stampare</a>';
                echo ' <a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            
        ?>
    </div>
    <h1>Benvenuto su QuizMaster!</h1>
</body>
</html>
