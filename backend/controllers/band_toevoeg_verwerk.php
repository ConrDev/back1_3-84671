<?php

require 'backend/config/db.php';
session_start();

$bandnaam = "";
$land = "";
$leden = "";
$muziek = "";
$info = "";
$errors=[];
$succes="";

if (isset($_POST['submit'])){

    if (empty($_POST['band'])) {
        $errors['band'] = 'Vul een bandnaam in';
    }

    if (empty($_POST['land'])) {
        $errors['land'] = 'Vul een land in';
    }

    if (empty($_POST['leden'])) {
        $errors['leden'] = 'Vul aantal leden in';
    }

    if (empty($_POST['muzieksoort'])) {
        $errors['muzieksoort'] = 'Vul een muzieksoort in';
    }
    
    $bandnaam = $_POST['band'];
    $land = $_POST['land'];
    $leden = $_POST['leden'];
    $muziek = $_POST['muzieksoort'];
    $info = htmlentities($_POST ['info'], ENT_QUOTES);

    if (count($errors) === 0) {
        $query = "INSERT INTO bands SET naam='$bandnaam', land='$land', aantalLeden='$leden', muzieksoort='$muziek', info='$info'";
        $bandsql = mysqli_query($link, $query);

        if($bandsql) {
            $succes = "$bandnaam is succesvol toegevoegd!";
        } else {
            $errors['tevoegen-gefaald'] = "Gevens zijn verkeerd!";
        }
    }    
} 
?>