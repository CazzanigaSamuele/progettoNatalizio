<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-css.css">
</head>
<body>
    <h1>Registrazione Utente</h1>

    <?php if (isset($_GET['messaggio'])) echo ($_GET['messaggio']); ?>

    <form action="gestoreRegistrazione.php" method="GET">
       
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Registrati</button>
    </form>
    <p><a href="login.php">Vai al login</a>  ||  <a href="index.php">Torna all'index</a></p>
    
</body>
</html>
