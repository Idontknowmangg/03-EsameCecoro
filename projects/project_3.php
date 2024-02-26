<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 9
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 58) AS str25,
            SUBSTRING(prgh, 59, 63) AS str26,
            SUBSTRING(prgh, 122, 59) AS str27
        FROM portfolio p
        WHERE p.idPortfolio = 9";

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
                    <p class="transparent-prgh"><?php echo $row["str25"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str26"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str27"]; ?></p>
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
    echo "Nessun risultato trovato per il paragrafo con ID 9.";
}
?>



<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 10
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 62) AS str28,
            SUBSTRING(prgh, 63, 63) AS str29,
            SUBSTRING(prgh, 127, 59) AS str30
        FROM portfolio p
        WHERE p.idPortfolio = 10";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="box-set">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
                    <p class="transparent-prgh"><?php echo $row["str28"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str29"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str30"]; ?></p>
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
    echo "Nessun risultato trovato per il paragrafo con ID 10.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo la query per ottenere i dati per idPortfolio = 11
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 70) AS str31,
            SUBSTRING(prgh, 72, 63) AS str32,
            SUBSTRING(prgh, 135, 59) AS str33
        FROM portfolio p
        WHERE p.idPortfolio = 11";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set2">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
                    <p class="transparent-prgh"><?php echo $row["str31"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str32"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str33"]; ?></p>
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


    <?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 11.";
}
?>


<?php
include_once 'db_connection.php';
// Eseguiamo l'ultima query per ottenere i dati per idPortfolio = 12
$sql = "SELECT 
            p.title,
            p.subtitle,
            p.img,
            p.icon1,
            p.iconDesc1,
            p.icon2,
            p.iconDesc2,
            SUBSTRING(prgh, 1, 60) AS str34,
            SUBSTRING(prgh, 62, 63) AS str35,
            SUBSTRING(prgh, 125, 59) AS str36
        FROM portfolio p
        WHERE p.idPortfolio = 12";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="box-set4">
            <img class="img2" src="<?php echo $row['img']; ?>" alt="Description of the image" onclick="showImage('<?php echo $row['img']; ?>')">

            <div class="content">
                <div class="content-text">
                    <h3 class="transparent-subtitle"><?php echo $row['subtitle']; ?></h3>
                    <p class="transparent-prgh"><?php echo $row["str34"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str35"]; ?></p>
                    <p class="transparent-prgh"><?php echo $row["str36"]; ?></p>
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
    }
} else {
    echo "Nessun risultato trovato per il paragrafo con ID 12.";
}
?>