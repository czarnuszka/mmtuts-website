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
            $("#navigationMenu").load("navigationMenu.html");
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
            echo '<a href="profile.php" class="header-loggedin">Witaj ' . $_SESSION['name'] . '</a>';
            echo '<a href="scripts/logout.php" class="header-login">Wyloguj się!</a>';
        } else {
            echo '<a href="signUp.php" class="header-login">Załóż konto</a>';
            echo '<a href="signIn.php" class="header-login">Zaloguj się</a>';
        }
        ?>

    </nav>
</header>
<main>
    <div class="wrapper">
        <section>
           <div class="left">
               <img src="img/avatar.jpg" alt="user">
           </div>
            <div class="right">
                <?php
                    if(isset($_SESSION['profileUpdated'])){
                        if($_SESSION['profileUpdated'] == true) {
                            echo "<div class=\"success\"><p>Dane użytkownika zostały zaktualizowane.</p></div>";
                        } else {
                            echo "Nie udało się zaktualizować profilu.";
                        }
                    }
                    unset($_SESSION['profileUpdated']);
                ?>
                <div class="data">
                    <h4>Imię:</h4><p><?php echo $_SESSION['name']?></p>
                </div>
                <div class="data">
                    <h4>Nazwisko:</h4><p><?php echo $_SESSION['lastname']?></p>
                </div>
                <div class="data">
                    <h4>Data urodzenia:</h4><p><?php echo $_SESSION['bday']?></p>
                </div>
                <div class="data">
                    <h4>Email:</h4><p><?php echo $_SESSION['email']?></p>
                </div>
                <div class="data">
                    <h4>Numer telefonu:</h4><p><?php echo $_SESSION['phonenumber']?></p>
                </div>
            </div>
        </section>
        <a href="editProfile.php"><input type="submit" name="edit_data" value="Edytuj profil"></a>
    </div>

</main>
<div id="footer"></div>
</body>

</html>