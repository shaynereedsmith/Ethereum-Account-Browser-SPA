<?php

  include 'class.php';
  $eth = new eth();

  $key = $eth->private_key;

  function fetch_more(){
    $return;

    print_r( $eth->process_request(json_encode($return)) );
  }

  // print_r($_POST);
?>
