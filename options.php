<?php

//Retrieve the data from our text file.
$fileContents = file_get_contents('sequences.txt');

//Convert the JSON string back into an array.
$sequences = json_decode($fileContents, true);

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Options animation</title>
  <meta name="description" content="La nuit du cirque">
  <meta name="author" content="Pierre Tandille">

  <link rel="stylesheet" href="css/spectre.min.css">
  <link rel="stylesheet" href="css/spectre-exp.min.css">
  <link rel="stylesheet" href="css/spectre-icons.min.css">
  <link rel="stylesheet" href="css/styles-options.css">

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/html5sortable.min.js"></script>

</head>

<body>

  <div class="container m-2">

    <div id="sequences">

      <?php foreach ($sequences as $sequence): ?>

        <div class="card card-sequence m-2">

          <div class="card-body">

            <form>

              <div class="form-group">
                <label class="form-label label-sm" for="input-text">Texte</label>
                <input class="form-input input-sm input-texte" type="text" placeholder="Texte" value="<?= $sequence['texte'] ?>">
              </div>

              <div class="form-group">
                <label class="form-label label-sm" for="input-length">Durée</label>
                <input class="form-input input-sm input-duree" type="number" placeholder="en secondes" value="<?= $sequence['duree'] ?>">
              </div>

              <div class="vitesses form-group">
                <label class="form-label label-sm" for="">Vitesses</label>
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][0] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][1] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][2] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][3] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][4] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][5] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][6] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][7] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][8] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][9] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][10] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][11] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][12] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][13] ?>">
                <input class="form-input input-sm" type="range" max="1" min="-1" step=".001" value="<?= $sequence['vitesses'][14] ?>">
              </div>

              <div class="form-group">
                <label class="form-label label-sm" for="input-coef">Coefficient</label>
                <input class="form-input input-sm input-coef" type="range" value="5" max="10" min="0" step=".5" value="<?= $sequence['coef'] ?>">
              </div>

              <br>

              <div class="form-group">
                <div class="btn-group btn-group-block">
                  <button class="btn btn-sm" type="reset" value="Reset">Reset</button>
                  <button class="btn btn-sm btn-delete">Supprimer</button>
                  <button class="btn btn-sm btn-primary btn-save">Enregistrer</button>
                </div>
              </div>

            </form>

          </div>

        </div>

    <?php endforeach; ?>

      <div class="card card-add-sequence m-2">
        <div class="card-body">
          <button class="btn btn-primary btn-add-sequence s-circle p-centered"><i class="icon icon-plus"></i></button>
        </div>
      </div>

    </div>

  </div>

  <script src="js/script-options.js"></script>
</body>
</html>
