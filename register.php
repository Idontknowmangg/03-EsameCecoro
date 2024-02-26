<?php

include 'db_connection.php';


// Funzione per registrare un nuovo utente
function registerUser($conn, $nome, $cognome, $data_di_nascita, $email, $password) {
    // Cifriamo la password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Prepariamo la query per l'inserimento dei dati
    $stmt = $conn->prepare("INSERT INTO registration (nome, cognome, dataNascita, email, pwd) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $cognome, $data_di_nascita, $email, $hashed_password);
    // Eseguiamo la query
    if ($stmt->execute()) { // Se la query è inserita bene ed eseguita senza errori
        return true; // Registrazione riuscita
    } else { // Altrimenti
        return false; // Registrazione fallita
    }
}

// Verifichiamo se il tipo di modulo dati è POST
// Verifichiamo se il tipo di modulo dati è POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se sì recuperiamo i dati inviati dal modulo e li sanifichiamo
    $nome = htmlspecialchars($_POST["nome"]);
    $cognome = htmlspecialchars($_POST["cognome"]);
    $data_di_nascita = htmlspecialchars($_POST["data_di_nascita"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Registriamo l'utente nel database
    if (registerUser($conn, $nome, $cognome, $data_di_nascita, $email, $password)) {
        // Se ha avuto successo stampa il messaggio
        echo "Registrazione avvenuta con successo!";
    } else {
        // Se ha fallito stampa il messaggio di errore
        echo "Registrazione fallita. Si prega di riprovare.";
    }
}


// Chiudiamo la connessione al database
$conn->close();
?>

<!-- STRUTTURA DEL REGISTER -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="css/styleRegistermin.css" type="text/css" rel="stylesheet">
</head>
<body>

<div class="register-container">
    <h2>Registration</h2>
    <div id="error-message" class="error" style="display: none;"></div>

    <form id="register-form" method="post" action="register.php">
        <label id="nome-label" for="nome">Name</label><br>
        <input type="text" name="nome" id="nome" minlength="2" maxlength="100" placeholder="Insert your name"><br>
        <div class="error-name"></div>

        <label id="cognome-label" for="cognome">Surname</label><br>
        <input type="text" name="cognome" id="cognome" minlength="2" maxlength="100" placeholder="Insert your surname"><br>
        <div class="error-surname"></div>

        <label id="data_di_nascita-label" for="data_di_nascita">Date of Birth</label><br>
        <input type="text" name="data_di_nascita" id="data_di_nascita" minlength="8" maxlength="10" placeholder="DD-MM-YYYY" pattern="[0-9.-/]{8,10}" title="Please enter a valid date of birth (DD-MM-YYYY format)" required><br>
        <div class="error-born"></div>

        <label id="email-label" for="email">Email</label><br>
        <input type="email" name="email" id="email" minlength="2" maxlength="100" placeholder="Insert your email"><br>
        <div class="error-email"></div>
        
        <label id="password-label" for="password">Password</label><br>
        <input type="password" name="password" id="password" maxlength="50" placeholder="Insert your password"><br>
        <div class="error-pwd"></div>
        <p style="font-size: 0.8em; margin-bottom: 20px;">(Remember your password)</p>

        <button type="submit">Register</button>
    </form>
    <a href="login.php" class="login-link">Do you have an account? Login here</a>
</div>

<script src="js/scriptRegister.js"></script> 




</body>
</html>
