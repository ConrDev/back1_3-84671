<?php 
    include "backend/controllers/band_toevoeg_verwerk.php"; 

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
            <form class="form" method="POST" action="band_toevoegen.php">
                <h1 for="" class="text-center">Welkom <?=$_SESSION['user']; ?>!</h1><br>
                <p for="" class="text-center">Voeg een Band toe!</p><br>
                <div class="form-group">
                    <label for="">Bandnaam</label>
                    <input type="text" class="form-control" name="band" id="band" placeholder="">
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
                    <input type="text" class="form-control" name="land" id="land" placeholder="">
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
                    <input type="number" class="form-control" name="leden" id="leden" placeholder="">
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
                    <input type="text" class="form-control" name="muzieksoort" id="muzieksoort" placeholder="">
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
                    <textarea class="form-control" name="info" id="info" rows="3"></textarea>
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
                <button name="submit" type="submit" class="btn btn-primary">Voeg toe</button>
                    <small name="succes" id="succes" class="form-text text-muted">
                        <?php if (!empty($succes) && count($errors) === 0) : ?>
                            <div class="alert alert-success">
                                <li>
                                <?php echo $succes; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                    <a href="band_uitlees.php" name="bands" class="float-left btn btn-secondary">Alle Bands</a>
            </form>

            
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>