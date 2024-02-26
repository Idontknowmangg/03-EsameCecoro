<?php
    include 'db_connection.php';
    // Startiamo anche qui la sessione per tenere traccia l'utente
    session_start();
    // Creiamo due query che cancella i dati dell'utente e il feedback se fornito
    $idUser = $_SESSION['idUser'];
    $query = "DELETE FROM feedback WHERE idUser = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idUser); 
    $stmt->execute();

    $query_2 = "DELETE FROM registration WHERE idUser = ?";
    $stmt_2 = $conn->prepare($query_2);
    $stmt_2->bind_param("i", $idUser);
    $stmt_2->execute();

    $stmt->close();
    $stmt_2->close();
    $conn->close();

    // Prendiamo la var globale e la distruggiamo
    $_SESSION = array();
    // Per poi distruggere la sessione
    session_destroy();
    // E poi rimandiamo al login
    header("location: login.php");
    exit;

    // Cancella i dati definitivamente, perciò se proviamo ad riutilizzare la nostra mail memorizzata, semplicemente dice che è inesistente.
?>
