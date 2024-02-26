<?php
include_once '../db_connection.php';

// Verifichiamo se l'utente è un amministratore, altrimenti reindirizza alla home page
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

// Messaggio di successo e di errore
$success_message_insert = $error_message_insert = '';

if(isset($_POST['submit_add_portfolio'])) { // Verifichiamo se l'elemento esiste
    // Se sì, riceviamo i dati dal modulo di inserimento
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $prgh = $_POST['prgh'];
    $img = $_POST['pathImg'];
    $icon1 = isset($_POST['icon1']) ? $_POST['icon1'] : null;
    $iconDesc1 = isset($_POST['icon1desc']) ? $_POST['icon1desc'] : null;
    $icon2 = isset($_POST['icon2']) ? $_POST['icon2'] : null;
    $iconDesc2 = isset($_POST['icon2desc']) ? $_POST['icon2desc'] : null;

    // Eseguiamo un'operazione di inserimento nel database
    $sql_insert = "INSERT INTO portfolio (title, subtitle, prgh, img, icon1, iconDesc1, icon2, iconDesc2) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; // Riga SQL per l'inserimento di dati
    $stmt_insert = $conn->prepare($sql_insert); // Prepariamo la query
    $stmt_insert->bind_param("ssssssss", $title, $subtitle, $prgh, $img, $icon1, $iconDesc1, $icon2, $iconDesc2); // Bindiamo gli elementi
    $stmt_insert->execute(); // Ed eseguiamo
    
    // Verifichiamo se l'inserimento ha avuto successo
    if($stmt_insert->affected_rows > 0) {
        // Se sì, stampa il messaggio di successo
        $success_message_insert = "<p style=\"text-align: center;\">Progetto inserito con successo.</p>";
    } else {
        // Altrimenti, stampa il messaggio d'errore
        $error_message_insert = "Si è verificato un errore durante l'inserimento del progetto.";
    }
}

// Verifichiamo se l'elemento esiste
if(isset($_POST['submit_delete_portfolio'])) {
    // Se sì, riceviamo l'ID dell'utente da eliminare
    $idPortfolio = $_POST['idPortfolio'];

    // Eseguiamo un'operazione di eliminazione nel database
    $sql_delete = "DELETE FROM portfolio WHERE idPortfolio = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $idPortfolio);
    $stmt_delete->execute();
    // Stessi procedimenti di quelli precedenti
    
    // Controlliamo se l'eliminazione ha avuto successo
    if($stmt_delete->affected_rows > 0) {
        // Se sì, stampa il messaggio di successo
        $success_message_delete = "Progetto eliminato con successo.";
    } else {
        // Altrimenti, stampa il messaggio d'errore
        $error_message_delete = "Si è verificato un errore durante l'eliminazione dell'utente.";
    }
}

// Verifichiamo se l'elemento esiste
if(isset($_POST['logout'])) {
    // Se sì, termina la sessione
    session_unset();
    session_destroy();
    // Per poi reindirizzare alla pagina di login
    header('Location: ../login.php');
    exit;
}

?>
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Utenti</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Inserimento Progetto</h2>
    <?php if(isset($success_message_insert)): ?>
        <div><?php echo $success_message_insert; ?></div>
    <?php endif; ?>
    <?php if(isset($error_message_insert)): ?>
        <div><?php echo $error_message_insert; ?></div>
    <?php endif; ?>
    <form method="post" action="" onsubmit="return validatePortfolio();">
        
        <p style="color: red;"><em>The symbol * means that are obligatory.</em></p>

        <div class="form-portfolio">
            <label for="titolo">Title:<span> *</span></label>
            <input type="text" id="titolo" name="title" placeholder="Insert the title"><br>
            <div class="error-title"></div>
        </div>
        
        <div class="form-portfolio">
            <label for="sottotitolo">Subtitle:<span> *</span></label>
            <input type="text" id="sottotitolo" name="subtitle" placeholder="Insert the subtitle"><br>
            <div class="error-subtitle"></div>
        </div>

        <div class="form-portfolio">
            <label for="paragrafo">Paragraph:<span> *</span></label>
            <textarea id="paragrafo" name="prgh" placeholder="Insert the paragraph"></textarea><br>
            <div class="error-paragraph"></div>
        </div>

        <div class="form-portfolio">
            <label for="percorsoImmagine">Path Img:<span> *</span></label>
            <input type="text" id="percorsoImmagine" name="pathImg" placeholder="Insert the path of the img"><br>
            <div class="error-pathImg"></div>    
        </div>



        <label>These are falcoltative, if you want to add simply type it following the instructions:</label>

        <p>First of all, the icons must be present: outline, and needs obviously a name, but if you want to understand more, consults here: <a href="https://ionic.io/ionicons/usage">How to use the icons</a></p>
        <p>And the subtitle explains that each icon describe his function. Example:</p>

        <p>If present a lock, the first thing is security or privacy. So we use the lock icon and the description: <b>Security</b></p>

        <p>So the icon will be: lock-outline</p>
        <em>(Better consult the link)</em><br><br>

        <label for="icona1">Icon (number 1):</label>
        <input type="text" id="icona1" name="icon1" placeholder="Insert the first icon"><br>

        <label for="icona1descrizione">Icon Description (number 1):</label>
        <input type="text" id="icona1descrizione" name="icon1desc" placeholder="Insert the desc of the first icon (MAX: 20 characters)"><br>

        <label for="icona2">Icon (number 2):</label>
        <input type="text" id="icona2" name="icon2" placeholder="Insert the second icon"><br>

        <label for="icona2descrizione">Icon Description (number 2):</label>
        <input type="text" id="icona2descrizione" name="icon2desc" placeholder="Insert the desc of the second icon (MAX: 20 characters)"><br>
        
        <button class="user-button" type="submit" name="submit_add_portfolio">Insert project portfolio</button>
    </form>

    <!-- Tabella degli utenti -->
    <h2>Existent Projects</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Paragraph</th>
            <th>IMG</th>
            <th>Icon1</th>
            <th>Desc1</th>
            <th>Icon2</th>
            <th>Desc2</th>
            <th>Actions</th>
        </tr>
        <?php
        // Eseguiamo una query per ottenere la lista degli utenti registrati
        $sql_select = "SELECT idPortfolio, title, subtitle, prgh, img, icon1, iconDesc1, icon2, iconDesc2 FROM portfolio";
        $result = $conn->query($sql_select); // Eseguiamo la query direttamente

        if($result->num_rows > 0) { // Se ha avuto un risultato con delle righe presenti
            // Esegue un ciclo WHILE che memorizza i risultati del DB in una var definita dentro al WHILE 
            while ($row = $result->fetch_assoc()) {
                // Prendiamo i valori delle colonne esistenti e li mettiamo dentro alle righe
                echo "<tr>";
                echo "<td>" . $row['idPortfolio'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['subtitle'] . "</td>";
                echo "<td>" . $row['prgh'] . "</td>";
                echo "<td>" . $row['img'] . "</td>";
                echo "<td>" . $row['icon1'] . "</td>";
                echo "<td>" . $row['iconDesc1'] . "</td>";
                echo "<td>" . $row['icon2'] . "</td>";
                echo "<td>" . $row['iconDesc2'] . "</td>";
                echo "<td>
                        <form method='post' action=''>
                            <input type='hidden' name='idPortfolio' value='" . $row['idPortfolio'] . "'>
                            <button id='buttonDeletePortfolio' class='button-actions' type='submit' name='submit_delete_portfolio'>Delete</button>
                        </form>
                        <form method='get' action='edit_portfolio.php'>
                            <input type='hidden' name='idPortfolio' value='" . $row['idPortfolio'] . "'>
                            <button class='button-actions' type='submit'>Edit</button>
                        </form>
                      </td>";
                echo "</tr>";
                // E poi dei pulsanti d'azione
            }
        } else {
            echo "<tr><td colspan='5'>Nessun utente trovato.</td></tr>";
        }
        ?>
    </table>
    <a class="link-styled" href="manage_user.php">Click here to go at users</a>
    <a class="link-styled" href="manage_categories.php">Click here to go at categories</a>
    <a class="link-styled" href="../index.php">Click here to go at index</a>

    <!-- Logout -->
    <form method="post" action="">
        <button class="logout-button" type="submit" name="logout">Esci</button>
    </form>
    <!-- Script -->
    <script src="js/scriptAdmin.js"></script>
</body>
</html>
