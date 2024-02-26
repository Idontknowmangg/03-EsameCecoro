<!-- STRUTTURA DELL'INDEX DELLA PAGINA ADMIN -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }

        p {
            color: #666;
            margin-bottom: 40px;
            animation: fadeInUp 1s ease-out;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #8FCEA0; /* Colore accattivante */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            animation: fadeInUp 1s ease-out;
        }

        a:hover {
            background-color: #6ca382; /* Colore accattivante al passaggio del mouse */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <?php
    session_start(); 
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['isAdmin']) {
        echo "<h1>Error 403: Forbidden.</h1>";
        exit();
    }
    ?>
    <h1>Welcome to the Admin Page</h1>
    <p>Select one of these buttons</p>
    
    <a href="manage_user.php">User</a>
    <a href="manage_categories.php">Categories</a>
    <a href="manage_portfolio.php">Portfolio</a>

</body>
</html>