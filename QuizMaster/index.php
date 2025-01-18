<?php
    if (!isset($_SESSION)) {
        session_start(); // Avvia la sessione se non è già attiva
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
<h1>Benvenuto su QuizMaster!</h1>
    <div class="top-right-buttons">
        <?php 
            // Verifica se l'utente è autenticato
            if (isset($_SESSION["autenticato"]) && $_SESSION["autenticato"] == true) {
                if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true){
                    echo '<form action="admin.php" method="get">
                            <button type="submit">Vai a pagina admin</button>
                        </form>
                        <br>';
                }else{
                    // Mostra il bottone per accedere alla pagina utente
                    echo '<form action="paginaUtente.php" method="get">
                            <button type="submit">Vai a pagina utente</button>
                        </form>
                        <br>';
                }
                
                // Mostra il bottone per disconnettersi
                echo '<form action="logout.php" method="get">
                        <button type="submit">Logout</button>
                    </form>';
            } else {
                // Mostra il bottone per il login se l'utente non è autenticato
                echo '<form action="login.php" method="get">
                        <button type="submit">Login</button>
                    </form>
                    <br>
                    <form action="registrazione.php">
                    <button>Registrati</button>
                    </form>';
            }
        ?>
    </div>
    
</body>
</html>
