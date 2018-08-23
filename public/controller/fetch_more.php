<?php

  $result;
  $address = $_POST['address'];
  $key = $_POST['key'];
  $page = $_POST['page'];

  $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
          .$address.
          '&tag=latest&apikey='
          .$key));

  if ($balance->status) {
    $result = array();
    $result['balance'] = format_value($balance->result);
    $transactions = json_decode(
        file_get_contents(
          'http://api.etherscan.io/api?module=account&action=txlistinternal&address='
          .$address
          .'&startblock=0&endblock=2702578&page='
          .$page
          .'&offset=10&sort=asc&apikey='
          .$key
          ));



    foreach ($transactions->result as $item) {
      $arr = get_object_vars($item);
      $arr['value'] = format_value($arr['value']);
      $arr['timeStamp'] = date('Y/m/d, h:i:sa',$arr['timeStamp']);
      $result['transactions'][] = $arr;
    }
  }else{
    $result = 'You did not give a correct ETH address.';
  }

  print_r($result);





  function get_results_balance($eth_add){

    $result;

    $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
            .$eth_add.
            '&tag=latest&apikey='
            .$key));

    if ($balance->status) {
      $result = array();
      $result = format_value($balance->result);
    }else{
      $result = 'You did not give a correct ETH address.';
    }

    return $result;

  }





  function format_value($value){

    $return;

    $value = strval($value);
    $dif = strlen($value) - 18;
    $length = strlen($value);

    if ($length >= 19) {
      $return = make_value_pretty($value, $dif);
    }else{
      $return = $length;
      for($i = 1; strlen($value) < 19; $i++){
        $value = '0' . $value;
      }
      $return = make_value_pretty($value, strlen($value) - 18);
    }

    return $return;

  }





  function make_value_pretty($value, $dif){

    $new_array = explode('.', substr_replace($value, '.', $dif,-18));
    $seg_one = number_format($new_array[0]);
    return $seg_one . '.' . rtrim($new_array[1],'0');

  }

?>
