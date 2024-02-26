<?php
// Includi il file di connessione al database
include_once '../db_connection.php';

// Verifica se l'utente è un amministratore, altrimenti reindirizza alla home page
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

// Verifichiamo se esiste questo elemento
if(isset($_POST['submit_edit_user'])) {
    // Se sì, riceviamo i dati dal modulo di modifica
    $idUser = $_POST['idUser'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    // Eseguiamo un'operazione di aggiornamento nel DB
    $sql_update = "UPDATE registration SET nome = ?, cognome = ?, email = ? WHERE idUser = ?";
    $stmt_update = $conn->prepare($sql_update); // Prepariamo la query
    $stmt_update->bind_param("sssi", $name, $surname, $email, $idUser); // Bindiamo la query
    $stmt_update->execute(); // E eseguiamo

    // Controlliamo se l'aggiornamento ha avuto successo
    if($stmt_update->affected_rows > 0) {
        // Se sì, stampa il messaggio di successo
        $success_message_update = "Utente aggiornato con successo.";
    } else {
        // Altrimenti quella d'errore
        $error_message_update = "Si è verificato un errore durante l'aggiornamento dell'utente.";
    }
}

// Prendiamo l'ID dell'utente dalla richiesta GET
$idUser = $_GET['idUser'];

// Eseguiamo una query per ottenere le informazioni dell'utente corrispondente all'ID
$sql_select_user = "SELECT nome, cognome, email FROM registration WHERE idUser = ?";
$stmt_select_user = $conn->prepare($sql_select_user); // Prepariamo la query
$stmt_select_user->bind_param("i", $idUser); // Bindiamo la query
$stmt_select_user->execute(); // Eseguiamo
$result_user = $stmt_select_user->get_result(); // E otteniamo il risultato desiderato

// Verifichiamo se l'utente esiste nel DB
if($result_user->num_rows > 0) {
    // Se sì, ottieniamo le informazioni dell'utente
    $row_user = $result_user->fetch_assoc(); // Trasformandolo in array
    $name = $row_user['nome']; // E estrapoliamo tutti i dati presenti
    $surname = $row_user['cognome'];
    $email = $row_user['email'];
} else {
    // Altrimenti mostra un messaggio di errore se l'utente non esiste nel DB
    $error_message_user_not_found = "Utente non trovato.";
}
?>
<!-- STRUTTURA DI MODIFICA DELL'USER -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Utente</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Modifica Utente</h2>
    <?php if(isset($error_message_user_not_found)): ?>
        <div><?php echo $error_message_user_not_found; ?></div>
    <?php else: ?>
        <form method="post" action="">
            <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
            <label for="nome">Name:</label>
            <input type="text" id="nome" name="name" value="<?php echo $name; ?>"><br>
            <label for="cognome">Surname:</label>
            <input type="text" id="cognome" name="surname" value="<?php echo $surname; ?>"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
            <button class="user-button" type="submit" name="submit_edit_user">Salva modifiche</button>
        </form>
    <?php endif; ?>

    <script>
        // Funzione per mostrare l'alert e reindirizzare alla pagina delle categorie
        function showAlertAndRedirect(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }

        // Verifichiamo se è stato inviato il modulo di modifica utente
        <?php if(isset($_POST['submit_edit_user'])): ?>
            <?php if(isset($success_message_update)): ?>
                // Mostra l'alert e reindirizza
                showAlertAndRedirect("<?php echo $success_message_update; ?>", "manage_user.php");
            <?php endif; ?>
        <?php endif; ?>
    </script>
</body>
</html>
