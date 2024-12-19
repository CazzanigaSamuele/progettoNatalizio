<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <h1>Registrazione Utente</h1>
    <?php if (isset($_GET['messaggio']))
        echo ($_GET['messaggio'])
    ?>
    <form action="gestoreRegistrazione.php" method="GET">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Registrati</button>
    </form>
    <p><a href="login.php">Torna al login</a></p>
    <a href="index.php">Torna all'index</a>
</body>
</html>
