<?php

include 'db_connection.php';

for ($idCategory = 2; $idCategory <= 5; $idCategory++) { // Questo ciclo permette di arrivare la var inizializzata, fino ad arrivare a 5 come valore

    $sql = ""; // Al momento è vuota questa var perché verrà usata spesso
    switch ($idCategory) { // Prendiamo la var inizializzata
        case 2: // Se ha valore come 2
            $sql = "SELECT 
                        SUBSTRING(description, 1, 24) AS str1,
                        SUBSTRING(description, 25, 25) AS str2,
                        SUBSTRING(description, 51, 55) AS str3,
                        imagePath
                    FROM categorie
                    WHERE idCategory = $idCategory"; // Fa una serie di righe SQL che estrapola tre volte delle stringhe a lunghezza definita e inizializzata la posizione, fino a ripetere 5 cicli.
            break;
        case 3:
            $sql = "SELECT 
                        SUBSTRING(description, 1, 23) AS str4,
                        SUBSTRING(description, 24, 32) AS str5,
                        SUBSTRING(description, 56, 55) AS str6,
                        imagePath
                    FROM categorie
                    WHERE idCategory = $idCategory";
            break;
        case 4:
            $sql = "SELECT 
                        SUBSTRING(description, 1, 27) AS str7,
                        SUBSTRING(description, 28, 34) AS str8,
                        SUBSTRING(description, 63, 36) AS str9,
                        imagePath
                    FROM categorie
                    WHERE idCategory = $idCategory";
            break;
        case 5:
            $sql = "SELECT 
                        SUBSTRING(description, 1, 33) AS str10,
                        SUBSTRING(description, 34, 38) AS str11,
                        SUBSTRING(description, 71, 51) AS str12,
                        imagePath
                    FROM categorie
                    WHERE idCategory = $idCategory";
            break;
        default:
            // Se non corrisponde a nessuna di questi valori, dà errore.
            echo "Nessuna query definita per la categoria con ID $idCategory.";
            break;
    }

    // Quindi praticamente, ogni numero incrementato di 1 della var, corrisponde a delle stringhe estratte e a lunghezza definita

    $result = $conn->query($sql); // Eseguiamo la query

    if ($result->num_rows > 0) { // Se ha più di 0 righe
        while ($row = $result->fetch_assoc()) {
            // Stampiamo i risultati all'interno del div 'content'
?>
<div class="content">
    <div class="title2">
        <?php if ($idCategory == 2) { ?>
            <h1 class="creativity">Creativity<ion-icon class="custom-icon" name="flash-outline"></ion-icon></h1>

        <?php } else if ($idCategory == 3) { ?>
            <h1 class="creativity">Critical Thinking<ion-icon class="custom-icon" name="chatbubble-ellipses-outline"></ion-icon></h1>
        
        <?php } else if ($idCategory == 4) { ?>
            <h1 class="creativity">Teamwork<ion-icon class="custom-icon" name="person-outline"></ion-icon></h1>
        
        <?php } else if ($idCategory == 5) { ?>
            <h1 class="creativity">Empathy<ion-icon class="custom-icon" name="bandage-outline"></ion-icon></h1>
        
        <?php } ?>

        <!-- Questo insieme di PHP injection e struttura HTML serve per stampare delle stringhe, quindi nel PHP ci sono delle condizioni e,
             nella struttura HTML ci sono dei titoli con delle classi e delle icone. Ciascuna condizione corrisponde al valore della var ciclata -->

    </div>
    <div class="prgh2"> 
        <?php
        // Stampiamo le sottostringhe ottenute dalla query
        switch ($idCategory) {
            case 2:
                echo "<p>" . $row["str1"] . "</p>";
                echo "<p>" . $row["str2"] . "</p>";
                echo "<p>" . $row["str3"] . "</p>";
                break;
            case 3:
                echo "<p>" . $row["str4"] . "</p>";
                echo "<p>" . $row["str5"] . "</p>";
                echo "<p>" . $row["str6"] . "</p>";
                break;
            case 4:
                echo "<p>" . $row["str7"] . "</p>";
                echo "<p>" . $row["str8"] . "</p>";
                echo "<p>" . $row["str9"] . "</p>";
                break;
            case 5:
                echo "<p>" . $row["str10"] . "</p>";
                echo "<p>" . $row["str11"] . "</p>";
                echo "<p>" . $row["str12"] . "</p>";
                break;
            default:
                // Se idCategory non esiste, ci dà l'errore.
                echo "Nessun risultato trovato per la categoria con ID $idCategory.";
                break;
        }
        ?>
    </div>
    <div class="img">
        <img src="<?php echo $row["imagePath"]; ?>"> <!-- In questa parte invece (sempre parte del ciclo) stampiamo l'immagine che cicla come la var -->
    </div>
</div>
<?php
        }
    } else {
        echo "ID inesistente. $idCategory.";
    }
    // Se non esiste per nulla l'ID, stampa quest'errore
}

$conn->close(); // Chiudiamo la connessione.
?>
