<?php
// Connessione al database
include_once '../db_connection.php';

// Verifichiamo innanzitutto se l'utente è un amministratore, altrimenti reindirizza alla home page
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

// Messaggio di successo e di errore
$success_message_insert = $error_message_insert = '';

// Verifichiamo se esiste l'elemento
if(isset($_POST['submit_add_user'])) {
    // Se sì, riceviamo i dati dal modulo di inserimento
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birth = $_POST['birth'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Eseguiamo un'operazione di inserimento nel database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashiamo la password
    $sql_insert = "INSERT INTO registration (nome, cognome, dataNascita, email, pwd) VALUES (?, ?, ?, ?, ?)"; // Riga SQL per inserimento di dati
    $stmt_insert = $conn->prepare($sql_insert); // Prepariamo la query
    $stmt_insert->bind_param("sssss", $name, $surname, $birth, $email, $hashed_password); // Bindiamo gli elementi necessari
    $stmt_insert->execute(); // Ed eseguiamo la query
    
    // Verifichiamo se l'utente è stato inserito con successo
    if($stmt_insert->affected_rows > 0) {
        // Se sì, stampiamo il messaggio di successo
        $success_message_insert = "<p style=\"text-align: center;\">Utente inserito con successo.</p>";
    } else {
        // Altrimenti stamperà il messaggio d'errore
        $error_message_insert = "Si è verificato un errore durante l'inserimento dell'utente.";
    }
}

// Verifichiamo se esiste l'elemento successivo
if(isset($_POST['submit_delete_user'])) {
    // Se sì, riceviamo l'ID dell'utente da eliminare
    $idUser = $_POST['idUser'];

    // Eseguiamo un'operazione di eliminazione nel DB
    $sql_delete = "DELETE FROM registration WHERE idUser = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $idUser);
    $stmt_delete->execute();
    // Stessi procedimenti dell'inserimento ma più breve

    // Verifichiamo se l'eliminazione ha avuto successo
    if($stmt_delete->affected_rows > 0) {
        // Se sì, stampiamo il messaggio di successo
        $success_message_delete = "Utente eliminato con successo.";
    } else {
        // Altrimenti stamperà il messaggio d'errore
        $error_message_delete = "Si è verificato un errore durante l'eliminazione dell'utente.";
    }
}

// Verifichiamo se l'elemento successivo è esistente
if(isset($_POST['logout'])) {
    // Se sì, termina la sessione
    session_unset();
    session_destroy();

    // Per poi reindirizzare alla pagina di login
    header('Location: ../login.php');
    exit;
}

?>
<!-- STRUTTURA DELLA TABELLA DI GESTIONE UTENTI, CREAZIONE, MODIFICA ED ELIMINAZIONE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Utenti</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Insert User</h2>
    <?php if(isset($success_message_insert)): ?>
        <div><?php echo $success_message_insert; ?></div>
    <?php endif; ?>
    <?php if(isset($error_message_insert)): ?>
        <div><?php echo $error_message_insert; ?></div>
    <?php endif; ?>
    <form method="post" action="" onsubmit="return validateUser();">

        <div class="form-user">
        <label for="nome">Name:</label>
        <input type="text" id="nome" name="name" placeholder="Insert the name"><br>
        <div class="error-name"></div>
        </div>

        <div class="form-user">
        <label for="cognome">Surname:</label>
        <input type="text" id="cognome" name="surname" placeholder="Insert the surname"><br>
        <div class="error-surname"></div>
        </div>

        <div class="form-user">
        <label for="nascita">Date of Birth:</label>
        <input type="text" id="nascita" name="birth" placeholder="Insert the date of the birth"><br>
        <div class="error-birth"></div>
        </div>

        <div class="form-user">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Insert the email"><br>
        <div class="error-email"></div>
        </div>

        <div class="form-user">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Insert the password"><br>
        <div class="error-pwd"></div>
        </div>      
        
        <button class="user-button" type="submit" name="submit_add_user">Insert user</button>
    </form>

    <!-- Tabella degli utenti regitrati -->
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        // Eseguiamo una query per ottenere la lista degli utenti registrati
        $sql_select = "SELECT idUser, nome, cognome, email FROM registration";
        $result = $conn->query($sql_select);

        if($result->num_rows > 0) { // Verifichiamo se ha avuto delle righe
            // Se sì, la var ha come valore i risultati trasformati in array
            while ($row = $result->fetch_assoc()) { // E il ciclo WHILE funge per quanti utenti sono presenti nel DB
                // Strutturiamo la tabella ed estrapoliamo le colonne esistenti nel DB
                echo "<tr>";
                echo "<td>" . $row['idUser'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['cognome'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                        <form method='post' action='' onsubmit='return confirmDelete();'>
                            <input type='hidden' name='idUser' value='" . $row['idUser'] . "'>
                            <button class='button-actions' type='submit' name='submit_delete_user'>Delete</button>
                        </form>
                        <form method='get' action='edit_user.php'>
                            <input type='hidden' name='idUser' value='" . $row['idUser'] . "'>
                            <button class='button-actions' type='submit'>Edit</button>
                        </form>
                      </td>";
                echo "</tr>";
                // E poi due pulsanti che fanno azione agli utenti
            }
        } else {
            // Se non esistono gli utenti, crea una riga di tabella che avvisa l'errore
            echo "<tr><td colspan='5'>Nessun utente trovato.</td></tr>";
        }
        ?>
    </table>
    <!-- Link per viaggiare nelle gestioni -->
    <a class="link-styled" href="manage_categories.php">Click here to go at categories</a>
    <a class="link-styled" href="../index.php">Click here to go at index</a>
    <a class="link-styled" href="manage_portfolio.php">Click here to go at portfolio</a>

    <!-- Logout -->
    <form method="post" action="">
        <button class="logout-button" type="submit" name="logout">Esci</button>
    </form>
    <!-- Script -->
    <script src="js/scriptAdmin.js"></script>
</body>
</html>
