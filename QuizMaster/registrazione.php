<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <!-- Collegamento al file CSS per la formattazione estetica -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Registrazione Utente</h1>

    <!-- Verifica se c'è un messaggio nel GET e lo mostra -->
    <?php if (isset($_GET['messaggio'])) echo ($_GET['messaggio']); ?>

    <!-- Form di registrazione -->
    <form action="gestoreRegistrazione.php" method="GET">
        <!-- Campo per l'inserimento del nome utente -->
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <!-- Campo per l'inserimento della password -->
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <!-- Bottone per inviare il modulo -->
        <button type="submit">Registrati</button>
    </form>

    <!-- Link per tornare alla pagina di login -->
    <p><a href="login.php">Torna al login</a></p>

    <!-- Link per tornare alla home -->
    <a href="index.php">Torna all'index</a>
</body>
</html>
