<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Registrazione Utente</h1>
    <?php if (isset($_GET['messaggio']))
        echo ($_GET['messaggio'])
    ?>
    <form action="gestoreRegistrazione.php" method="GET">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Registrati</button>
    </form>
    <br>
    <form action="login.php">
        <button>Torna al Login</button>
    </form>
</body>
</html>
