<?php

    require 'backend/config/db.php';
    session_start();

    $Email = "";
    $Gebruikersnaam= "";
    $Wachtwoord= "";
    $Level = "";
    // $_SESSION['loggedin'] = false;
    $errors=[];

    if (isset($_POST['submit'])) {

        if (empty($_POST['email'])) {
            $errors['email'] = 'Vul een E-mail addres in';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "E-mail addres is ongeldig!";
        }

        if (empty($_POST['naam'])) {
            $errors['naam'] = 'Vul een gebruikersnaam in';
        }

        if (empty($_POST['wachtwoord'])) {
            $errors['wachtwoord'] = 'Vul een Wachtwoord in';
        }

        if (empty($_POST['level']) && $_POST['level'] != 0) {
            $errors['level'] = 'Vul een level in';
        }

        $Email = $_POST['email'];
        $Gebruikersnaam = $_POST['naam'];
        // $Wachtwoord = $_POST['wachtwoord'];
        $Wachtwoord = sha1($_POST['wachtwoord']);
        $Level = $_POST['level'];    

        $sql = "SELECT * FROM users WHERE email='$Email' LIMIT 1";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $errors['email'] = "E-mail addres is al gebruikt";
        }

        $usersql = "SELECT * FROM users WHERE gebruikersnaam='$Gebruikersnaam' LIMIT 1";
        $userresult = mysqli_query($link, $usersql);
        if (mysqli_num_rows($userresult) > 0) {
            $errors['naam'] = "Gebruikersnaam is al gebruikt";
        }

        if (count($errors) === 0) {

            $query = "INSERT INTO users SET email='$Email', gebruikersnaam='$Gebruikersnaam', wachtwoord='$Wachtwoord', level='$Level'";
            $addUser = mysqli_query($link, $query);
            if ($addUser) {
                
                // $_SESSION['loggedin'] = true;
                // $_SESSION['user'] = $Email;
                // $_SESSION['level'] = $Level;
                header('location: index.php');
                exit(0);
            } 
        } else {
            $errors['login-failed'] = "Gevens zijn verkeerd";
        }

    }

?>