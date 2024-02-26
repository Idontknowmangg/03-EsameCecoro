<?php
include 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 1
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(p.prgh, 1, 48) AS str1,
            SUBSTRING(p.prgh, 50, 63) AS str2,
            SUBSTRING(p.prgh, 113, 59) AS str3
        FROM portfolio p
        WHERE p.idPortfolio = 1";

// Creiamo la query dove estraiamo l'intero record e, creare delle sottostringhe per poi essere di nuovo prese

$result = $conn->query($sql); // Eseguiamo la query

// Verifichiamo se ci sono delle righe (del DB)
if ($result->num_rows > 0) {
    // Se sì, facciamo unn ciclo while che la var $row prende il valore del risultato che poi viene utilizzato il metodo per estrarre l'array del DB
    while ($row = $result->fetch_assoc()) {
?>
        <h2 class="transparent-title"><?php echo $row['title']; ?></h2> <!-- Nel titolo prendiamo la colonna di nome title -->
        <div class="box-set">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')"> <!-- Invece qui prendiamo la colonna d'immagine (img) --> 

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3> <!-- Prendiamo il sottotitolo -->
                    <p class="transparent-prgh"><?php echo $row["str1"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str2"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str3"]; ?></p>
                </div>

                <!-- E poi ogni riga di paragrafo, viene estratto i nomi della query che sono nominate in seguito grazie al costrutto AS-->

                <div class="icon-set">
                    <div class="icon">
                        <ion-icon class="custom-icon" name="<?php echo $row['icon1'] ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc1']; ?></p>
                    </div>

                    <div class="icon">
                        <ion-icon class="custom-icon" name="<?php echo $row['icon2'] ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc2']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- E invece qui ogni icona estrae due colonne prese dal DB, una il nome dell'icona e l'altra la descrizione -->
<?php
    }
} else {
    // Se non esiste l'ID del portfolio, stampa il messaggio d'errore
    echo "Nessun risultato trovato per il paragrafo con ID 1.";
}

// E così ripete per 12 volte perché sono presenti delle immagini e testi , quindi sono 12 cicli while che estraggono gli array per poi essere utilizzati a seconda della struttura scelta.

?>



<?php

include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 2
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 63) AS str4,
            SUBSTRING(prgh, 64, 63) AS str5,
            SUBSTRING(prgh, 128, 59) AS str6
        FROM portfolio p
        WHERE p.idPortfolio = 2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set">
    <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">
    
    <div class="content">
        <div class="content-text">
            <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
            <p class="transparent-prgh"><?php echo $row['str4'];?></p>
            <p class="transparent-prgh"><?php echo $row['str5'];?></p>
            <p class="transparent-prgh"><?php echo $row['str6'];?><p>
        </div>

        <div class="icon-set">
            <div class="icon">
                <ion-icon class="custom-icon" name="<?php echo $row['icon1']; ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc1']; ?></p>
            </div>

            <div class="icon">
                <ion-icon class="custom-icon" name="<?php echo $row['icon2']; ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc2']; ?></p>
            </div>            
        </div>
    </div>

    <?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 2.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 3
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 59) AS str7,
            SUBSTRING(prgh, 60, 63) AS str8,
            SUBSTRING(prgh, 124, 59) AS str9
        FROM portfolio p
        WHERE p.idPortfolio = 3";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

    <div class="box-set2">
    <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">
    
    <div class="content">
        <div class="content-text">
        <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
            <p class="transparent-prgh"><?php echo $row['str7'];?></p>
            <p class="transparent-prgh"><?php echo $row['str8'];?></p>
            <p class="transparent-prgh"><?php echo $row['str9'];?><p>
        </div>

        <div class="icon-set">
            <div class="icon">
                <ion-icon class="custom-icon" name="<?php echo $row['icon1']?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc1']?></p>
            </div>

            <div class="icon">
            <ion-icon class="custom-icon" name="<?php echo $row['icon2']?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc2']?></p>
            </div>            
        </div>
    </div>

    <?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 3.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 4
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 68) AS str10,
            SUBSTRING(prgh, 70, 63) AS str11,
            SUBSTRING(prgh, 133, 59) AS str12
        FROM portfolio p
        WHERE p.idPortfolio = 4";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

    <div class="box-set3">
    <img class="img2" src="<?php echo $row['img']?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']?>')">
    
    <div class="content">
        <div class="content-text">
            <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
            <p class="transparent-prgh"><?php echo $row['str10']; ?></p>
            <p class="transparent-prgh"><?php echo $row['str11']; ?></p>
            <p class="transparent-prgh"><?php echo $row['str12']; ?></p>
        </div>

        <div class="icon-set">
            <div class="icon">
                <ion-icon class="custom-icon" name="<?php echo $row['icon1']; ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc1']; ?></p>
            </div>

            <div class="icon">
            <ion-icon class="custom-icon" name="<?php echo $row['icon2']; ?>"></ion-icon><p class="icon-paragraph"><?php echo $row['iconDesc2']; ?></p>
            </div>            
        </div>
    </div>
    
    <?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 4.";
}
?>