<?php // Questo file è indispensabile per il processo del form che otterremo i dati inviati dal form

session_start(); // Teniamo traccia l'utente
include_once 'db_connection.php'; // Includiamo la connessione del DB


// Verifichiamo che $_SESSION['idUser'] sia stato inizializzato correttamente
if (!isset($_SESSION['idUser'])) {
    // Se true esce il codice
    echo "Errore: idUser non è stato inizializzato correttamente nella sessione."; // Stampiamo il messaggio
    exit;
}

$userId = $_SESSION['idUser']; // Estraiamo l'id

// Recuperiamo i dati dal form

$titleMsg = isset($_POST['title-msg']) ? $_POST['title-msg'] : '';
$message = isset($_POST['msg']) ? $_POST['msg'] : '';
$gdprConsent = isset($_POST['gdpr']) ? 1 : 0;

// Inizializziamo e utilizziamo l'operazione ternaria, qundi un "?" che funge da IF al volo, il primo mini-blocco verrà stampata se true e ":" verrà stampato il false

// Prepariamo ed eseguiamo la query per inserire i dati nel database
$sql = "INSERT INTO feedback (idUser, title_msg, message, gdpr_consent) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $userId, $titleMsg, $message, $gdprConsent);

$stmt->execute(); // Eseguiamo la query preparata

if ($stmt->affected_rows > 0) { // Verifichiamo se ha avuto più di 0 righe il risultato effettuato
    // Se sì, allora ha effettivamente inserito i dati nel DB
    echo "Dati inseriti correttamente nel database.";
} else {
    // Al contrario no se per mal inserimento di query o altro
    echo "Errore durante l'inserimento dei dati nel database.";
}

$stmt->close(); // Chiudiamo il prepared statement
$conn->close(); // Chiudiamo la connessione al database
?>
