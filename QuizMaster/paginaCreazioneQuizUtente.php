<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    // Se l'utente non è loggato, reindirizzalo alla pagina di login
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione Quiz</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function mostraDomande() {
            let numeroDomande = document.getElementById("numDomande").value;
            let contenitoreDomande = document.getElementById("contenitoreDomande");
            contenitoreDomande.innerHTML = ""; // Svuota il contenitore

            for (let i = 1; i <= numeroDomande; i++) {
                contenitoreDomande.innerHTML += `
                    <fieldset>
                        <legend>Domanda ${i}</legend>
                        <label for="domanda${i}">Testo della domanda:</label><br>
                        <textarea name="domanda${i}" id="domanda${i}" required></textarea><br><br>
                        
                        <label>Opzioni:</label><br>
                        <input type="text" name="opzione${i}1" placeholder="Opzione 1" required>
                        <input type="text" name="opzione${i}2" placeholder="Opzione 2" required>
                        <input type="text" name="opzione${i}3" placeholder="Opzione 3" required>
                        <input type="text" name="opzione${i}4" placeholder="Opzione 4" required><br><br>
                        
                        <label for="opzioneCorretta${i}">Risposta corretta (scegli da 1 a 4):</label>
                        <input type="number" name="opzioneCorretta${i}" id="opzioneCorretta${i}" min="1" max="4" required>
                    </fieldset><br>
                `;
            }
        }
    </script>
</head>
<body>
    <h1>Creazione di un nuovo Quiz</h1>
    <form action="gestoreCreazioneQuiz.php" method="GET">
        <label for="nomeQuiz">Nome del Quiz:</label>
        <input type="text" name="nomeQuiz" id="nomeQuiz" required>

        <label for="livelloDifficolta">Livello di difficoltà:</label>
        <select name="livelloDifficolta" id="livelloDifficolta" required>
            <option value="Facile">Facile</option>
            <option value="Medio">Medio</option>
            <option value="Difficile">Difficile</option>
        </select>

        <label for="numDomande">Numero di domande (da 1 a 10):</label>
        <input type="number" name="numDomande" id="numDomande" min="1" max="10" required onchange="mostraDomande()">

        <div id="contenitoreDomande"></div>

        <button type="submit">Salva Quiz</button>
        
    </form>
    <br>
    <form action="paginaUtente.php">
        <button>Torna Indietro</button>
    </form>
</body>
</html>
