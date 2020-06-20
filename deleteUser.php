<?php

session_start();

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("#navigationMenu").load("navigationMenu.php");
            $("#footer").load("footer.html");
        });
    </script>
</head>

<body>
<header>
    <div id="navigationMenu"></div>
    <nav id="login">
        <!-Logowanie-->
        <?php
        if (isset($_SESSION['logged'])) {
            echo '<a href="scripts/logout.php" class="header-login">Wyloguj się!</a>';
            echo '<a href="profile.php" class="header-loggedin">Witaj ' . $_SESSION['name'] . '</a>';
        } else {
            echo '<a href="signUp.php" class="header-login">Załóż konto</a>';
            echo '<a href="signIn.php" class="header-login">Zaloguj się</a>';
        }
        ?>

    </nav>
</header>
<main>
    <div class="wrapper">
        <h2>Potwierdzenie</h2>
            <div class="deleteUser">
                <form action="scripts/updateProfile.php" method="post">
                    <div class="data">
                        <h4>Czy na pewno chcesz usunąć z bazy danych użytkownika</h4> <p><?php echo $_SESSION['name'] . " " . $_SESSION['lastname'] . "?"?></p>
                    </div>

                    <input type="submit" name="deleteYes" value="Tak">
                    <input type="submit" name="deleteNo" value="Nie">
                </form>
            </div>

    </div>

</main>
<div id="footer"></div>
</body>

</html>