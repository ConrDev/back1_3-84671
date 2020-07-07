<?php
    require 'backend/config/db.php';

    $albumid = $_GET['id'];
    $albumtitel = $_GET['titel'];
    $img = $_GET['img'];

    $query = "DELETE FROM albums WHERE id = '$albumid'";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Album</title>
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
          unlink($img);
        ?>
            <p class="p-3 mb-2 text-white text-center bg-success"><?=$albumtitel; ?> is succesvol verwijded!</p>
        <?php
        } else {
        ?>
            <p class="p-3 mb-2 text-white text-center bg-success">Fout bij het verwijderen van de album <?=$albumtitel; ?>!</p>
            <p class="p-3 mb-2 text-white text-center bg-info">Fout bij het verwijderen van de album <?=mysqli_error($link); ?>!</p>
        <?php
        }
        ?>
        <a href="albums_uitlees.php" name="bands" class="float-right btn btn-primary">Terug</a>
      </div>
  </body>
</html>