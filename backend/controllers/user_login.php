<?php
    require 'backend/config/db.php';
    session_start();

    $Email = "";
    $Gebruikersnaam= "";
    $Wachtwoord= "";
    $Level = "";
    // $_SESSION['loggedin'] = false;
    $errors=[];

    if (isset($_POST['login'])) {

        if (empty($_POST['naam'])) {
            $errors['naam'] = 'Vul een gebruikersnaam in';
        }

        if (empty($_POST['wachtwoord'])) {
            $errors['wachtwoord'] = 'Vul een Wachtwoord in';
        }

        $Gebruikersnaam = $_POST['naam'];
        // $Wachtwoord = $_POST['wachtwoord'];
        $Wachtwoord = sha1($_POST['wachtwoord']);

        

        // $usersql = "SELECT * FROM users WHERE gebruikersnaam='$Wachtwoord' LIMIT 1";
        // $userresult = mysqli_query($link, $usersql);
        // if (mysqli_num_rows($userresult) > 0) {
        //     $errors['naam'] = "Gebruikersnaam is al gebruikt";
        // }

        if (count($errors) === 0) {
            $sql = "SELECT * FROM users WHERE gebruikersnaam='$Gebruikersnaam' AND wachtwoord='$Wachtwoord' LIMIT 1";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $Gebruikersnaam;
                $_SESSION['level'] = $row['level'];
                header('location: ./band_uitlees.php');
                exit(0);
            } else {
                $errors['naam'] = "Gebruikersnaam of wachtword is verkeerd";
            }
        }
    }
?>