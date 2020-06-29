<?php
include 'backend/controllers/band_wijzig.php';

$bandid = $_GET['id'];

$query = "SELECT * FROM bands WHERE id='$bandid'";

$resultaat = mysqli_query($link, $query);

$errors=[];
?>

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
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Er is niks te laten zien kom later terug.</p>
        <?php
            } else {
               $rij = mysqli_fetch_array($resultaat);
        ?>
            <form class="form" method="POST" action="band_wijzig_verwerk.php?id=<?=$bandid; ?>">
                <h1 for="" class="text-center">Wijzig <?=$rij['naam'];?> info!</h1><br>
                <div class="form-group">
                    <label class="font-weight-bold" for="">#</label>
                    <input type="text" class="form-control" name="id" id="id disabledInput" value="<?=$rij['id']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Bandnaam</label>
                    <input type="text" class="form-control" name="band" id="band" value="<?=$rij['naam']; ?>">
                    <small name="bandError" id="bandError" class="form-text text-muted">
                        <?php if (!empty($errors['band'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['band']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Land van herkomst</label>
                    <input type="text" class="form-control" name="land" id="land" value="<?=$rij['land']; ?>">
                    <small name="landError" id="landError" class="form-text text-muted">
                        <?php if (!empty($errors['land'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['land']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Aantal leden</label>
                    <input type="number" class="form-control" name="leden" id="leden" value="<?=$rij['aantalLeden']; ?>">
                    <small name="ledenError" id="ledenError" class="form-text text-muted">
                        <?php if (!empty($errors['leden'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['leden']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Soort muziek</label>
                    <input type="text" class="form-control" name="muzieksoort" id="muzieksoort" value="<?=$rij['muzieksoort']; ?>">
                    <small name="muzieksoortError" id="muzieksoortError" class="form-text text-muted">
                        <?php if (!empty($errors['muzieksoort'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['muzieksoort']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Algemene info</label>
                    <textarea class="form-control" name="info" id="info" rows="3"><?=$rij['info']; ?></textarea>
                    <small name="infoError" id="infoError" class="form-text text-muted">
                        <?php if (!empty($errors['info'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['info']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Wijzig</button>
                    <small name="succes" id="succes" class="form-text text-muted">
                        <?php if (!empty($succes) && count($errors) === 0) : ?>
                            <div class="alert alert-success">
                                <li>
                                <?php echo $succes; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                    <a href="band_uitlees.php" name="bands" class="float-left btn btn-secondary">Terug</a>
            </form>
        <?php
            }
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>