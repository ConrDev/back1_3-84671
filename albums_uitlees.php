<?php
    require 'backend/config/db.php';
    session_start();

    $query = "SELECT * FROM albums";

    $resultaat = mysqli_query($link, $query);

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('location: ./index.php');
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Albums</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  </head>
  <body style="background-color: lightgray;">
      <div class="modal-content col-10 mx-auto p-5">
        <!-- <h1 for="" class="text-center">Welkom <?=$_SESSION['user']; ?>!</h1><br> -->
        <p for="" class="text-center">Alle albums</p><br>
        <table class="table table-striped table-hover">
        <?php
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Sorry! geen artiesten gevonden in de database</p>
        <?php
            } else {
        ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Titel</th>
                    <th scope="col">Jaar</th>
                    <th scope="col">Band</th>
                    <th scope="col">Info</th>
                    <th scope="col"> </th>
                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                    <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
        <?php
                while ($rij = mysqli_fetch_array($resultaat)) {
                    $albumBand = $rij['id_Band'];
                    $queryBands = "SELECT * FROM bands WHERE id='$albumBand'";
                    $resultaatBands = mysqli_query($link, $queryBands);
        ?> 
                <tr>
                    <th scope="row"><?=$rij['id']; ?></th>
                    <th><img src="<?=$rij['afbeelding']; ?>" width="200" height="200"></td>
                    <td><?=$rij['titel']; ?></td>
                    <td><?=$rij['jaar']; ?></td>
                    <?php
                        while ($band = mysqli_fetch_array($resultaatBands)) {
                    ?>
                            <td><a href='band_details.php?id=<?=$albumBand;?>'><?=$band['naam']; ?></a></td>
                    <?php
                        }
                    ?>
                    <td><?=$rij['info']; ?></td>
                    <td> </td>
                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <td><a href='album_wijzig_verwerk.php?id=<?=$rij['id'];?>'>Pas aan</a></td>
                        <td><a href='album_verwijder.php?id=<?=$rij['id'];?>'>Verwijder</a></td>
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
        <a href="album_toevoegen.php" name="albums" class="float-left btn btn-primary">Album Toevoegen</a>
        <a href="band_uitlees.php" name="bands" class="float-left btn btn-secondary">Terug</a>
      </div>
  </body>
</html>