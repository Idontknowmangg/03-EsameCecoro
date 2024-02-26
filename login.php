<!-- Questa parte è veramente importante, perché gestisce gli utenti e la visualizzazione tale della pagina -->
<?php
session_start(); // Innanzittutto startiamo la sessione

// Controlliamo se il server invia i dati di tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se sì, esegue questo blocco

    include 'db_connection.php'; // Includiamo la connessione

    // Ottieniamo l'email e password dal form di login
    $email = htmlspecialchars($_POST['email']);
    $password_input = $_POST['password'];
    
    // Eseguiamo il trim del dato per rimuovere spazi vuoti
    $email = trim($email);    

    // Ho escluso il trim() quella della password perché se vogliamo creare delle password complesse, abbiamo la possibilità di farlo

    // Prepariamo ed eseguiamo la query per ottenere l'hash della password (perché è importante tenere la sicurezza delle pwd)
    $sql = "SELECT pwd FROM registration WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) { // Controlliamo se la var (dove ha la query preparata) è diversa da TRUE, il motivo è che vediamo se la query scritta è giusta nel linguaggio SQL
        // Se sì, stampa il messaggio d'errore ed esce il codice
        printf("Errore durante la preparazione della query: %s\n", $conn->error);
        exit();
    }
    // Se invece è il contrario, continua il codice

    $stmt->bind_param("s", $email); // Facciamo il binding (associazione nel contesto delle query parametrizzate) e utilizziamo il tipo di valore e la var o valore che vogliamo associare alla query con il segnaposto immesso.

    if ($stmt->execute()) { // Verifichiamo se l'execute ha avuto effetto, quindi prima prepare() per poi farlo su execute(). E' importante per sicurezza e per dettagli importanti come i segnaposti.

        $result = $stmt->get_result(); // Se ha avuto effetto estraiamo i risultati memorizzandoli in una var.

        if ($result->num_rows == 1) { // Verifichiamo se la var ha solamente 1 riga

            $row = $result->fetch_assoc(); // Se sì trasforma in array questo risultato in una var
            $hash = $row['pwd']; // Per poi prendere la password dalla colonna della var che ha memorizzato i risultati

            // Verifichiamo se la password è hashata (grazie dal file register)
            if (password_verify($password_input, $hash)) {
                // Verifichiamo se l'email è esattamente come scritto
                if ($email === 'admin@email.com') {
                    $_SESSION['isAdmin'] = true; // Se sì diventa true
                    echo "L'utente è un amministratore."; // E poi stampa il messaggio
                } else {
                    $_SESSION['isAdmin'] = false; // Se no, diventa false
                    echo "L'utente non è un amministratore."; // E poi stampa il messaggio
                }
                // Se la password è hashata, il loggedin è true
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email; // E poi la var globale memorizza l'email inserita dall'utente

                // Recuperiamo il nome, il cognome e l'id dell'utente dal database e memorizzarlo nella sessione
                $sql_user_info = "SELECT idUser, nome, cognome FROM registration WHERE email = ?";
                
                // Prepariamo la query dalla var della connessione del DB ($conn)
                $stmt_user_info = $conn->prepare($sql_user_info);

                // Bindiamo l'email
                $stmt_user_info->bind_param("s", $email);

                // Eseguiamo la query
                $stmt_user_info->execute();

                // Prendiamo i risultati
                $result_user_info = $stmt_user_info->get_result();

                // E trasformiamoli in array
                $user_info = $result_user_info->fetch_assoc();


                $_SESSION['idUser'] = $user_info['idUser']; // Memorizziamo: L'id dell'utente nella sessione
                $_SESSION['nome'] = $user_info['nome']; // il nome
                $_SESSION['cognome'] = $user_info['cognome']; // e il cognome

                // Se l'utente è admin, verrà reindirizzato in index dell'admin
                if ($_SESSION['isAdmin'] === true) {
                    header('Location: admin/index.php');
                } else {
                    // Se non lo è, reindirizza all'index
                    header('Location: index.php'); 
                    exit;
                }
                exit;
            } else {
                // Se le credenziali non corrispondono, semplicemente stampa che non sono validi perché immessi male
                $error = "Email o password non validi";
            }
        } else {
            // Se le credenziali non esistono, semplicemente stampa che non esistono e manda all'utente di fare il register
            $error = "Email o password non esistenti";
        }
    } else {
        // Se la query di registrazione è sbagliata, stampa il messaggio d'errore e i dettagli d'errore
        printf("Errore durante l'esecuzione della query: %s\n", $stmt->error);
        exit();
    }
    // Chiudiamo la connessione al database
    $conn->close();
}
?>

<!-- Infine struttura del Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/styleLoginmin.css" type="text/css" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php if(isset($error)): // Qua semplicemente inizializziamo la var per verificare se esiste, il motivo è che così generiamo il form senza errori ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="login.php">
        <input type="email" name="email" placeholder="Insert your email" required><br>
        <input type="password" name="password" placeholder="Insert your password" required><br>
        <button type="submit">Login</button>
        <p style="font-size: 0.8em;">Welcome to my website, I am warning to you that this website is only for informational and visual purposes only, and I have no intention of collecting data. You simply login, if you have moments of discouragement that you want exit, just logout and your data will be destroyed. Enjoy!<br>- From Chris</p>
    </form>
    <a href="register.php" class="register-link">Don't have an account? Register here</a>
</div>

</body>
</html>
