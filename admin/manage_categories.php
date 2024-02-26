<?php
include_once '../db_connection.php';

// Verifichiamo se l'utente è un amministratore, altrimenti reindirizza alla home page
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

// Messaggi di successo e di errore
$success_message_insert = $error_message_insert = '';

// Verifichiamo se l'elemento esiste
if(isset($_POST['submit_add_category'])) {
    // Riceviamo i dati dal modulo di inserimento
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];
    $category_image = $_POST['category_image'];

    // Eseguiamo un'operazione di inserimento nel database
    $sql_insert = "INSERT INTO categorie (name, description, imagePath) VALUES (?, ?, ?)"; // Facciamo una riga SQL per l'inserimento dei dati
    $stmt_insert = $conn->prepare($sql_insert); // Prepariamo la query
    $stmt_insert->bind_param("ssss", $category_name, $category_description, $category_image,$category_video); // Bindiamo gli elementi
    $stmt_insert->execute(); // Eseguiamo la query
    // Controlliamo se l'inserimento ha avuto successo
    if($stmt_insert->affected_rows > 0) {
        // Se sì, stampa il mesaggio di successo
        $success_message_insert = "<p style=\"text-align: center;\">Categoria inserita con successo.</p>";
    } else {
        // Se no, stampa il messaggio d'errore
        $error_message_insert = "Si è verificato un errore durante l'inserimento della categoria.";
    }
}

// Verifichiamo l'elemento se esiste
if(isset($_POST['submit_delete_category'])) {
    // Se sì, riceviamo l'ID della categoria da eliminare
    $category_id = $_POST['category_id'];

    // Eseguiamo un'operazione di eliminazione nel database
    $sql_delete = "DELETE FROM categorie WHERE idCategory = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $category_id);
    $stmt_delete->execute();
    // Stesso procedimento a quello precedente

    // Controlliamo se l'eliminazione ha avuto successo
    if($stmt_delete->affected_rows > 0) {
        // Se sì, stampa il mesaggio di successo
        $success_message_delete = "Categoria eliminata con successo.";
    } else {
        // Se no, stampa il messaggio d'errore
        $error_message_delete = "Si è verificato un errore durante l'eliminazione della categoria.";
    }
}

// Verichiamo se l'elemento esiste
if(isset($_POST['logout'])) {
    // Se sì, termina la sessione
    session_unset();
    session_destroy();
    // Poi reindirizza alla pagina di login
    header('Location: ../login.php');
    exit;
}

?>
<!-- STRUTTURA DELLA TABELLA DI CATEGORIE, CREAZIONE, MODIFICA ED ELIMINAZIONE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Insert Category</h2>
    <?php if(isset($success_message_insert)): ?>
        <div><?php echo $success_message_insert; ?></div>
    <?php endif; ?>
    <?php if(isset($error_message_insert)): ?>
        <div><?php echo $error_message_insert; ?></div>
    <?php endif; ?>
    <form id="formCategory" method="post" onsubmit="return validateCategory();" action="">

        <div class="form-category">
        <label for="category_name">Name Category:</label>
        <input type="text" id="category_name" name="category_name" placeholder="Inserisci il nome della categoria"><br>
        <div class="error-nameCategory"></div>
        </div>

        <div class="form-category">
        <label for="category_description">Description Category:</label>
        <textarea id="category_description" name="category_description" placeholder="Inserisci la descrizione della categoria"></textarea><br>
        <div class="error-desc"></div>
        </div>

        <div class="form-category">
        <label for="category_image">Path of the image:</label>
        <input type="text" id="category_image" name="category_image" placeholder="Inserisci il path immagine della categoria"><br>
        <div class="error-pathImg"></div>
        </div>
        
        <button class="user-button" type="submit" name="submit_add_category">Insert category</button>
    </form>

    <!-- Tabella delle categorie -->
    <h2>Existent Categories</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name Category</th>
            <th>Description</th>
            <th>Path of image</th>
            <th>Actions</th>
        </tr>
        <?php
        // Eseguiamo una query per ottenere la lista degli utenti registrati
        $sql_select = "SELECT idCategory, name, description, imagePath FROM categorie";
        $result = $conn->query($sql_select); // Eseguiamo direttamente

        if($result->num_rows > 0) { // Verifichiamo se avuto successo
            // Se sì, facciamo un ciclo WHILE dove la sua var memorizza la var del risultato che verrà poi trasformata in array
            while($row = $result->fetch_assoc()) {
                // Strutturiamo la tabella estraendo i dati dal DB
                echo "<tr>";
                echo "<td>" . $row['idCategory'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['imagePath'] . "</td>";
                echo "<td>
                        <form id='deleteCategory' method='post' action='' onsubmit='return confirmDelete();'>
                            <input type='hidden' name='category_id' value='" . $row['idCategory'] . "'>
                            <button class='button-actions2' type='submit' name='submit_delete_category'>Delete</button>
                        </form>
            
                        <form id='editCategory' method='get' action='edit_categories.php'>
                            <input type='hidden' name='idCategory' value='" . $row['idCategory'] . "'>
                            <button class='button-actions2' type='submit'>Edit</button>
                        </form>
                      </td>";
                echo "</tr>";
                // Poi infine due pulsanti d'azione
            }
        } else {
            echo "<tr><td colspan='5'>Nessun utente trovato.</td></tr>";
        }
        ?>
    </table>
    <!-- LINKS -->
    <a class="link-styled" href="manage_portfolio.php">Click here to go at portfolio</a>
    <a class="link-styled" href="manage_user.php">Click here to go at users</a>
    <a class="link-styled" href="../index.php">Click here to go at index</a>

    <!-- Logout -->
    <form method="post" action="">
        <button class="logout-button" type="submit" name="logout">Esci</button>
    </form>
    <!-- Script -->
    <script src="js/scriptAdmin.js"></script>
</body>
</html>
