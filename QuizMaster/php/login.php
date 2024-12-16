<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    if (isset($_GET["messaggio"])) {
        echo $_GET["messaggio"];
    }
    ?>
    <form action="gestoreLogin.php" method="get">
        User: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="registrazione.php">registrati</a>
    <a href="index.php">Torna index</a>
</body>
</html>
