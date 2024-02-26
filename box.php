<!-- STRUTTURA DEL PRIMO BOX -->
<?php

include_once 'db_connection.php'; // Questa riga chiama il file che contiene la connessione del DB

$idCategory = 1; // Chiamiamo la var che contiene un intero

$sql = "SELECT description FROM categorie WHERE idCategory = $idCategory"; // Questa riga SQL selezioniamo la colonna descrizione con l'ID dichiarato dalla var
$result = $conn->query($sql); // Eseguiamo la query

if ($result->num_rows > 0) { // Condizione se il risultato è maggiore di 0 di righe
    // Se sì:
    $paragraphs = array(); // Array per contenere i paragrafi
    while ($row = $result->fetch_assoc()) { // Prendiamo il ciclo WHILE che la var $row ha il valore dell'array del DB, quindi questa var gestisce la struttura e possiamo chiamare degli oggetti
        $description = $row["description"]; // Dichiariamo una var che ha il valore della var che ha il valore della colonna di nome description
        $paragraphs = explode("\n", $description); // Dichiariamo una var che divide il testo in paragrafi
    }
?>

<div class="content">
    <div class="title">
        <h1 id="home">Welcome!</h1>
    </div>

    <div class="prgh">
        <?php
        // Eseguiamo la query per ottenere le sottostringhe
        $query = "SELECT 
                        SUBSTRING(description, 1, 25) AS substring1,
                        SUBSTRING(description, 26, 26) AS substring2,
                        SUBSTRING(DESCRIPTION, 53, 15) AS substring3,
                        SUBSTRING(DESCRIPTION, 69, 114) AS substring4 -- Facciamo delle sottostringhe per estrapolare dei testi dalla lunghezza definita del testo fino all'estrarre su quanti bit dobbiamo recuperare
                FROM categorie WHERE idCategory = $idCategory";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <p><?php echo $row['substring1']; ?></p> <!-- E poi infine, chiamiamo in modo personalizzato grazie al costrutto AS del SQL, che consente la nominazione di un operazione per rendere semplice la chiamata -->
                <p><?php echo $row['substring2']; ?></p>
                <p><?php echo $row['substring3']; ?></p><br>
                <p><?php echo $row['substring4']; ?></p>
                <?php
            }
        }
        ?>
    </div>
</div>

</div>

<div class="box-title">
    <h1 id="strengths" class="title-body">My best strengths<ion-icon class="custom-icon" name="diamond-outline"></ion-icon></h1>
</div>

<?php
} else {
    echo "Nessun risultato trovato.";
} // Infine se è uguale a 0, non trova nulla, perciò FALSE

$conn->close();
?>