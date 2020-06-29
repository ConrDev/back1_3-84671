<?php
    require 'backend/config/db.php';

    $bandid = $_GET['id'];
    $bandnaam = $_GET['naam'];

    $query = "DELETE FROM bands WHERE id = '$bandid'";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Band</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  </head>
  <body style="background-color: lightgray;">
      <div class="modal-content col-5 mx-auto p-5">
        <?php
        if(mysqli_query($link, $query)) {
        ?>
            <p class="p-3 mb-2 text-white text-center bg-success"><?=$bandnaam; ?> is succesvol verwijded!</p>
        <?php
        } else {
        ?>
            <p class="p-3 mb-2 text-white text-center bg-success">Fout bij het verwijderen van de band <?=$bandnaam; ?>!</p>
            <p class="p-3 mb-2 text-white text-center bg-info">Fout bij het verwijderen van de band <?=mysqli_error($link); ?>!</p>
        <?php
        }
        ?>
        <a href="band_uitlees.php" name="bands" class="float-right btn btn-primary">Terug</a>
      </div>
  </body>
</html>