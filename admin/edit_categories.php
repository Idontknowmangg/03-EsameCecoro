<?php
include_once '../db_connection.php';

session_start(); // Teniamo traccia l'admin
// Verifichiamo se l'utente è un amministratore, altrimenti reindirizza alla home page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

if(isset($_POST['submit_edit_category'])) { // Verifichiamo se esiste questo elemento

    // Se sì, estraiamo i dati ricavati dal POST
    $idCategory = $_POST['idCategory'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $imagePath = $_POST['imagePath'];
    $videoPath = $_POST['videoPath'];

    // Creiamo una query che aggiorna
    $sql_update = "UPDATE categorie SET name = ?, description = ?, imagePath = ? WHERE idCategory = ?";
    $stmt_update = $conn->prepare($sql_update); // Prepariamo la query
    $stmt_update->bind_param("ssssi", $name, $description, $imagePath, $videoPath, $idCategory); // Bindiamo la query
    $stmt_update->execute(); // E la eseguiamo

    if ($stmt_update->affected_rows > 0) { // Se il risultato ha avuto successo
        // Stampa il messaggio di successo
        $success_message_update = "Categoria aggiornata con successo";
    } else {
        // Altrimenti d'errore
        $error_message_update = "Si è verificato un'errore durante l'aggiornamento della categoria";
    }
}

$idCategory = $_GET['idCategory']; // Estraiamo l'id

$sql_select_category = "SELECT name, description, imagePath FROM categorie WHERE idCategory = ?"; // Selezioniamo le colonne esistenti
$stmt_select_category = $conn->prepare($sql_select_category); // Prepariamo la query
$stmt_select_category->bind_param("i", $idCategory); // Bindiamo l'id
$stmt_select_category->execute(); // La eseguiamo
$result_category = $stmt_select_category->get_result(); // E otteniamo il risultato

if ($result_category->num_rows > 0) { // Se ha avuto successo
    // I risultati diverranno array e ricaviamo le colonne esistenti per poi essere messi nella pagina
    $row_category = $result_category->fetch_assoc();
    $name = $row_category['name'];
    $description = $row_category['description'];
    $imagePath = $row_category['imagePath'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Categoria</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Modifica Categoria</h2>
    <?php if (isset($error_message_update)): ?>
        <div><?php echo $error_message_update; ?></div>
    <?php else: ?>
        <form method="post" action="">
            <input type="hidden" name="idCategory" value="<?php echo $idCategory; ?>">

            <label for="nome">Name:</label>
            <input type="text" id="nome" name="name" value="<?php echo $name; ?>"><br>

            <label for="descrizione">Description:</label>
            <textarea cols="40" rows="3" id="descrizione" name="description"><?php echo $description; ?></textarea><br>

            <label for="percorso">Percorso dell'immagine:</label>
            <input type="text" id="percorso" name="imagePath" value="<?php echo $imagePath; ?>"><br>

            <button class="user-button" type="submit" name="submit_edit_category">Save Edit</button>
        </form>
    <?php endif; ?>
    <script>
        // Funzione per mostrare l'alert e reindirizzare alla pagina delle categorie
        function showAlertAndRedirect(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }

        // Verifica se è stato inviato il modulo di modifica categoria
        <?php if(isset($_POST['submit_edit_category'])): ?>
            <?php if(isset($success_message_update)): ?>
                // Mostra l'alert e reindirizza
                showAlertAndRedirect("<?php echo $success_message_update; ?>", "manage_categories.php");
            <?php endif; ?>
        <?php endif; ?>
    </script>
</body>
</html>
