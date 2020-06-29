<?php
    require 'backend/config/db.php';
    session_start();

    $query = "SELECT * FROM bands";

    $resultaat = mysqli_query($link, $query);


    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('location: ./index.php');
    }

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
        <h1 for="" class="text-center">Welkom <?=$_SESSION['user']; ?>!</h1><br>
        <p for="" class="text-center">Alle bands</p><br>
        <table class="table table-striped table-hover">
        <?php
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Sorry! geen bands gevonden in de database</p>
        <?php
            } else {
        ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Muzieksoort</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
        <?php
                while ($rij = mysqli_fetch_array($resultaat)) {
        ?> 
                <tr>
                    <th scope="row"><?=$rij['id']; ?></th>
                    <td><?=$rij['naam']; ?></td>
                    <td><?=$rij['muzieksoort']; ?></td>
                    <td><a href='band_details.php?id=<?=$rij['id'];?>'>Detail</a></td>
                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <td><a href='band_wijzig_verwerk.php?id=<?=$rij['id'];?>'>Pas aan</a></td>
                        <td><a href='band_verwijder.php?id=<?=$rij['id'];?>'>Verwijder</a></td>
                    <?php
                        }
                    ?>
                </tr>
        <?php
                } 
        ?>
            </tbody>
        <?php
            }
        ?>
        </table>
        <a href="band_toevoegen.php" name="bands" class="float-left btn btn-primary">Band Toevoegen</a>
        <a href="artiest_uitlees.php" name="artiesten" class="float-left btn btn-primary">Artiesten Weergeven</a>
        <a href="loguit.php" name="bands" class="float-left btn btn-secondary">loguit</a>
      </div>
  </body>
</html>