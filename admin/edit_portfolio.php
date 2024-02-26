<?php
include_once '../db_connection.php';
session_start(); // Teniamo traccia l'admin

// Verifichiamo se l'utente è un amministratore, altrimenti reindirizza alla home page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
    echo "<h1>Error 403: Forbidden.</h1>";
    exit();
}

// Controlliamo se esiste l'elemento
if(isset($_POST['submit_edit_portfolio'])) {
    // Se sì, riceviamo i dati dal modulo di modifica
    $idPortfolio = $_POST['idPortfolio'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $prgh = $_POST['prgh'];
    $pathImg = $_POST['pathImg'];
    $icon1 = $_POST['icon1'];
    $descIcon1 = $_POST['icon1desc'];
    $icon2 = $_POST['icon2'];
    $descIcon2 = $_POST['icon2desc'];

    // Eseguiamo un'operazione di aggiornamento nel database
    $sql_update = "UPDATE portfolio SET title = ?, subtitle = ?, prgh = ?, img = ?, icon1 = ?, iconDesc1 = ?, icon2 = ?, iconDesc2 = ? WHERE idPortfolio = ?";
    $stmt_update = $conn->prepare($sql_update); // Prepariamo la query
    $stmt_update->bind_param("ssssssssi", $title, $subtitle, $prgh, $pathImg, $icon1, $descIcon1, $icon2, $descIcon2, $idPortfolio); // Bindiamo i dati
    $stmt_update->execute(); // E poi la eseguiamo

    // Controlliamo se l'aggiornamento ha avuto successo
    if($stmt_update->affected_rows > 0) {
        // Se sì, messaggio di successo
        $success_message_update = "Progetto aggiornato con successo.";
    } else {
        // Altrimenti messaggio d'errore
        $error_message_update = "Si è verificato un errore durante l'aggiornamento del progetto.";
    }
}

// Riceviamo l'ID del progetto dalla richiesta GET
$idPortfolio = $_GET['idPortfolio'];

// Eseguiamp una query per ottenere le informazioni del progetto corrispondente all'ID
$sql_select_portfolio = "SELECT title, subtitle, prgh, img, icon1, iconDesc1, icon2, iconDesc2 FROM portfolio WHERE idPortfolio = ?";
$stmt_select_portfolio = $conn->prepare($sql_select_portfolio); // Prepariamo la query
$stmt_select_portfolio->bind_param("i", $idPortfolio); // Bindiamo la query
$stmt_select_portfolio->execute(); // Eseguiamo la query
$result_portfolio = $stmt_select_portfolio->get_result(); // E infine otteniamo i risultati

// Verifichiamo se il progetto esiste nel DB
if($result_portfolio->num_rows > 0) {
    // Se sì, estraiamo tutte le colonne esistenti per poi trasformarli in array
    $row_portfolio = $result_portfolio->fetch_assoc();
    $title = $row_portfolio['title'];
    $subtitle = $row_portfolio['subtitle'];
    $prgh = $row_portfolio['prgh'];
    $pathImg = $row_portfolio['img'];
    $icon1 = $row_portfolio['icon1'];
    $descIcon1 = $row_portfolio['iconDesc1'];
    $icon2 = $row_portfolio['icon2'];
    $descIcon2 = $row_portfolio['iconDesc2'];
    

} else {
    // Altrimenti mostra un messaggio di errore se il progetto non esiste nel DB
    $error_message_portfolio_not_found = "Project not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Progetto</title>
    <link href="../css/styleAdminmin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h2>Modifica Progetto</h2>
    <?php if(isset($error_message_portfolio_not_found)): ?>
        <div><?php echo $error_message_portfolio_not_found; ?></div>
    <?php else: ?>
        <form method="post" action="">
        
        <p style="color: red;"><em>The symbol * means that are obligatory.</em></p>

        <input type="hidden" name="idPortfolio" value="<?php echo $idPortfolio; ?>">

        <div class="form-portfolio">
            <label for="titolo">Title:<span> *</span></label>
            <input type="text" id="titolo" name="title" value="<?php echo $title; ?>" placeholder="Insert the title"><br>
            <div class="error-title"></div>
        </div>
        
        <div class="form-portfolio">
            <label for="sottotitolo">Subtitle:<span> *</span></label>
            <input type="text" id="sottotitolo" name="subtitle" value="<?php echo $subtitle; ?>" placeholder="Insert the subtitle"><br>
            <div class="error-subtitle"></div>
        </div>

        <div class="form-portfolio">
            <label for="paragrafo">Paragraph:<span> *</span></label>
            <textarea id="paragrafo" name="prgh" placeholder="Insert the paragraph"><?php echo $prgh; ?></textarea><br>
            <div class="error-paragraph"></div>
        </div>

        <div class="form-portfolio">
            <label for="percorsoImmagine">Path Img:<span> *</span></label>
            <input type="text" id="percorsoImmagine" value="<?php echo $pathImg; ?>" name="pathImg" placeholder="Insert the path of the img"><br>
            <div class="error-pathImg"></div>    
        </div>

        <label for="icona1">Icon (number 1):</label>
        <input type="text" id="icona1" name="icon1" value="<?php echo $icon1; ?>" placeholder="Insert the first icon"><br>

        <label for="icona1descrizione">Icon Description (number 1):</label>
        <input type="text" id="icona1descrizione" value="<?php echo $descIcon1; ?>" name="icon1desc" placeholder="Insert the desc of the first icon (MAX: 20 characters)"><br>

        <label for="icona2">Icon (number 2):</label>
        <input type="text" id="icona2" name="icon2" value="<?php echo $icon2; ?>" placeholder="Insert the second icon"><br>

        <label for="icona2descrizione">Icon Description (number 2):</label>
        <input type="text" id="icona2descrizione" value="<?php echo $descIcon2; ?>" name="icon2desc" placeholder="Insert the desc of the second icon (MAX: 20 characters)"><br>
        
        <button class="user-button" type="submit" name="submit_edit_portfolio">Edit project portfolio</button>
    </form>
    <?php endif; ?>

    <script>
        // Funzione per mostrare l'alert e reindirizzare alla pagina del portfolio
        function showAlertAndRedirect(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }

        // Verifichiamo se è stato inviato il modulo di modifica progetto
        <?php if(isset($_POST['submit_edit_portfolio'])): ?>
            <?php if(isset($success_message_update)): ?>
                // Mostra l'alert e reindirizza
                showAlertAndRedirect("<?php echo $success_message_update; ?>", "manage_portfolio.php");
            <?php endif; ?>
        <?php endif; ?>
    </script>
</body>
</html>
