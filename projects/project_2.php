<?php
// Connessione al database
include_once 'db_connection.php';

// Eseguiamo la query per ottenere i dati per idPortfolio = 5
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 76) AS str13,
            SUBSTRING(prgh, 77, 63) AS str14,
            SUBSTRING(prgh, 140, 59) AS str15
        FROM portfolio p
        WHERE p.idPortfolio = 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <h2 class="transparent-title"><?php echo $row['title']; ?></h2>
        <div class="box-set">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
                    <p class="transparent-prgh"><?php echo $row["str13"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str14"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str15"]; ?></p>
                </div>

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
<?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 5.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamoamo la query per ottenere i dati per idPortfolio = 6
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 70) AS str16,
            SUBSTRING(prgh, 72, 63) AS str17,
            SUBSTRING(prgh, 135, 59) AS str18
        FROM portfolio p
        WHERE p.idPortfolio = 6";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
                    <p class="transparent-prgh"><?php echo $row["str16"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str17"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str18"]; ?></p>
                </div>

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

        <?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 6.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 7
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 79) AS str19,
            SUBSTRING(prgh, 81, 63) AS str20,
            SUBSTRING(prgh, 144, 59) AS str21
        FROM portfolio p
        WHERE p.idPortfolio = 7";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set2">
    <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">
    
    <div class="content">
        <div class="content-text">
        <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
            <p class="transparent-prgh"><?php echo $row['str19'];?></p>
            <p class="transparent-prgh"><?php echo $row['str20'];?></p>
            <p class="transparent-prgh"><?php echo $row['str21'];?><p>
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
    echo "Nessun risultato trovato per il paragrafo con ID 7.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 8
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 66) AS str22,
            SUBSTRING(prgh, 68, 62) AS str23,
            SUBSTRING(prgh, 130, 60) AS str24
        FROM portfolio p
        WHERE p.idPortfolio = 8";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set3">
    <img class="img2" src="<?php echo $row['img']?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']?>')">
    
    <div class="content">
        <div class="content-text">
            <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
            <p class="transparent-prgh"><?php echo $row['str22']; ?></p>
            <p class="transparent-prgh"><?php echo $row['str23']; ?></p>
            <p class="transparent-prgh"><?php echo $row['str24']; ?></p>
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
    echo "Nessun risultato trovato per il paragrafo con ID 8.";
}
?>