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

  <title>La nuit du cirque</title>
  <meta name="description" content="La nuit du cirque">
  <meta name="author" content="Pierre Tandille">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <script src="js/jquery-3.4.1.min.js"></script>

  <script>
  var sequences = <?= $fileContents ?>;
  </script>

</head>

<body>
  <div id="poster"></div>
  <video class="animated-moon secondary left" autoplay src="video/moon.webm#t=0" loop muted playsinline></video>
  <video class="animated-moon main" autoplay src="video/moon.webm#t=3" loop muted playsinline></video>
  <video class="animated-moon secondary right" autoplay src="video/moon.webm#t=6" loop muted playsinline></video>
  <span class="dummy-load-font">A</span>
  <script src="js/script.js"></script>
</body>
</html>
