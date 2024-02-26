<!-- INDEX -->
<?php
session_start(); // Startiamo la sessione per tenere traccia il visitatore

// Se l'utente non è autenticato, reindirizza alla pagina di login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) { // Verfichiamo se loggedIn è false, se sì manda il visitatore a fare il login
    header('Location: login.php');
    exit;
}

// Controlliamo se l'utente è autenticato
if (isset($_SESSION['idUser'])) {
    // Se sì, otteniamo il suo ID
    $userId = $_SESSION['idUser'];
} else {
    // In caso contrario, ci dice che non è autenticato, quindi FALSE
    echo "L'utente non è autenticato.";
}

// Questa parte di condizione era per debuggare


$email = $_SESSION['email']; // Otteniamo la sua email
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Rise - Welcome</title>
    <link href="css/stylemin.css" type="text/css" rel="stylesheet">
    <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {"askConsentAtCookiePolicyUpdate":true,"enableFadp":true,"enableLgpd":true,"enableUspr":true,"fadpApplies":true,"floatingPreferencesButtonDisplay":"anchored-top-right","perPurposeConsent":true,"siteId":3500146,"showBannerForUS":true,"usprApplies":true,"usprPurposes":"s,sh,adv","whitelabel":false,"cookiePolicyId":63069702,"lang":"it","floatingPreferencesButtonCaption":true, "banner":{ "acceptButtonDisplay":true,"backgroundOverlay":true,"closeButtonRejects":true,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"rejectButtonDisplay":true,"showPurposesToggles":true,"showTitle":false }};
        </script>
        <script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3500146.js"></script>
        <script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
        <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
</head>
<body>

<!-- Facciamo una serie di include_once perché riduciamo le dimensioni di codice -->

<div class="navigation">
    <?php include_once 'menu.php'; ?> <!-- Chiamiamo la struttura del menù -->
</div>

<!-- Questa parte, contiene dentro al <div> che identifica l'utente -->
<div class="welcome-message">
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){ // Inanzittutto verifichiamo se loggedin è TRUE
        
        $nome = $_SESSION['nome']; // Se TRUE prendiamo il nome e il cognome ricavato dal login
        $cognome = $_SESSION['cognome'];
            echo "<p style='font-size: 0.4em; color: red;'>First of all this is an experiment website, I repeat again, I do not want to collect any personal data but simply is a test where I create, explore and more but obviously will have his final build. Thank you for reading - Chris";
        echo "<p style='font-size: 0.4em;'>(At this moment no settings have been made available for modifying your preferences, if you deem it necessary to leave the site without being tracked, simply click the button below.)</p><br>";
        echo "<form method='post' action='delete.php' onsubmit='return confirmAction();'><button style='width:40%; background-color: red;'>DELETE</button></form>";
        echo "<h2 class='link'>Hello! $nome $cognome! "; // E poi un testo di benvenuto
    } else {
        echo "<p>Benvenuto!</p>"; // Se non abbiamo nessuna delle credenziali, gli diciamo solamente benvenuto
    }

    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) { // Se l'utente è un admin, gli compare il link per accedere al pannello del sito
        echo "<a class='link' href=\"admin/index.php\">If you want to go into control panel click here.</a></h2>";
    }
    ?>
</div>

<div class="box">
    <?php include_once 'box.php'; ?> <!-- Chiamiamo la struttura del contenuto di una box -->
</div>

<div class="box2">
    <?php include_once 'content.php'; ?> <!-- Chiamiamo la struttura del contenuto di una seconda box che contiene delle immagini e testi -->
</div>

<div class="box-title2">
    <h1 id="projects" class="title-body">My best projects<ion-icon class="custom-icon" name="diamond-outline"></ion-icon></h1> <!-- Un div che ha il titolo e un'icona che ne descrive il titolo -->
</div>

<div id="imageModal" class="modal">
    <span class="close" title="Click me if you want to close!" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="fullImage">
</div>

<!-- 
    Questo div contiene una modalità, sostanzialmente, questa modalità consiste nel vedere in modo intero un immagine, ossia:

    Vediamo un immagine, solitamente si tende a cliccare per vederla meglio, quindi compare questa finestra che visualizza meglio.

    Infatti questo div, attiva questa modalità e c'è l'icona di chiusura. Un tip comodo è che con il tasto Escape possiamo chiudere l'immagine invece di cliccare l'icona
-->


<div class="transparent-box">
    <?php include_once 'projects/project_1.php'; ?>
</div>

<div class="transparent-box2">
    <?php include_once 'projects/project_2.php'; ?>
</div>

<div class="transparent-box2">
    <?php include_once 'projects/project_3.php'; ?>
</div>

<!-- 
    Questi tre div chiamano diversi progetti che contengono ciascuna di loro delle categorie e diverse immagini e testi che ne descrivono il contenuto
-->


<div class="form-set">
    <h2 id="form" class="title-body">Form Contacts</h2>
    <p class="prgh">If you are encountering something that is going wrong, just message here and your positive feedback help me to improve.</p><br>
</div>

<!-- 
    Questo div mostra il titolo e testo del form
-->

<div class="box-form">
    <?php include_once 'form.php'; ?> <!-- Questo div chiama la struttura del form -->
</div>

<div class="form-set2">
    <p class="prgh">(I'm sorry that it is not present the footer that adds more info).</p>
    <p class="prgh">First of all consults in Privacy and Cookie Policy that are present in high.</p>
    <p class="prgh">And my contacts are: <em>Email: info@example.com</em> and <em>Phone Number: 333.123.4567.</em></p>
    <p>REMEMBER THAT THIS WEBSITE IS ONLY INFORMATIONAL PURPOSES.</p>
</div>

<!-- 
    Infine questo div mostra dei testi che descrive che non è presente il footer ma ci sono dei link e collegamenti, quindi
    un footer creato al volo se vogliamo definirlo.
-->

<script src="js/script.js"></script> <!-- Chiamiamo lo script -->


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<a href="https://www.iubenda.com/privacy-policy/63069702" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
<a href="https://www.iubenda.com/privacy-policy/63069702/cookie-policy" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Cookie Policy ">Cookie Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
<a href="https://www.iubenda.com/termini-e-condizioni/63069702" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Termini e Condizioni ">Termini e Condizioni</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

    <!-- 
    Grazie a questi script (testati da Me per migliorare la visibilità del sito), possiamo includere delle icone che ne descrivono
    il contenuto. E ovviamente devono essere presenti delle normative per rispettare gli utenti.
-->

</body>
</html>
