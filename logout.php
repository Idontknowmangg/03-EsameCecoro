<?php
    include 'db_connection.php';
    // Startiamo anche qui la sessione per tenere traccia l'utente
    session_start();

    // Prendiamo la var globale e la distruggiamo
    $_SESSION = array();
    // Per poi distruggere la sessione
    session_destroy();
    // E poi rimandiamo al login
    header("location: login.php");
    exit;

    // Semplicemente, ho ridotto il codice del logout, sì, è vero che il logout solitamente cancella dati e ti reindirizza al login ma, delete.php è più corretto perché è più percepibile e logout, hai la possibilità di riaccedere.
?>
