<?php
    // Struttura della connessione al DB

    $indirizzo = 'localhost';
    $db = 'test';
    $utente = 'root';
    $password = '';
    $porta = '3306';

    $conn = new mysqli($indirizzo, $utente, $password, $db, $porta);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
?>
