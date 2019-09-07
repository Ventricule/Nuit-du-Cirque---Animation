<?php

if(array_key_exists('sequences', $_POST)):
  $json_sequences = $_POST['sequences'];
  file_put_contents('sequences.txt', $json_sequences);
  print('{}');
endif;
