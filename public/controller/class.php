
<?php

  class eth {

    var $private_key;
    var $action;
    var $address;
    var $results;
    var $segment;




    function __construct( ){
      $this->private_key = 'MEW5TTTTJKGBAG5VZRGVA12WK9PSP16PM6';
      $this->segment = $this->run_link($_SERVER['REQUEST_URI']);

      if ($_POST) {
        $this->action = $_POST['action'];
        $this->address = $_POST['eth_address'];
        $this->results = $this->process_request();
        if ($this->action === 'link') {
          // header('Location: /');
        }
      }
    }





    function process_request($sent_address = 0){

      $result;

      $address = $sent_address ? $sent_address : $this->address;

      if ($address) {
        $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
                .$address.
                '&tag=latest&apikey='
                .$this->private_key));

        if ($balance->status) {
          $result = array();
          $result['balance'] = $balance->result;
          $transactions = json_decode(
              file_get_contents(
                'http://api.etherscan.io/api?module=account&action=txlistinternal&address='
                .$address
                .'&startblock=0&endblock=2702578&page=1&offset=10&sort=asc&apikey='
                .$this->private_key
                ));
          if ($transactions->status) {
            $result['transactions'] = $transactions;
          }else {
            $result['transactions'] = 'There are no transactions for this address.';
          }

        }else{
          $result = 'You did not give a correct ETH address.';
        }

        if ($sent_address) {
          return $result;
        }else{
          return $this->results = $result;
        }
      }else{
        return false;
      }


    }





    function get_results_balance($eth_add){

      $result;

      $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
              .$eth_add.
              '&tag=latest&apikey='
              .$this->private_key));

      if ($balance->status) {
        $result = array();
        $result = $this->format_value($balance->result);
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
        $return = $this->make_value_pretty($value, $dif);
      }else{
        $return = $length;
        for($i = 1; strlen($value) < 19; $i++){
          $value = '0' . $value;
        }
        $return = $this->make_value_pretty($value, strlen($value) - 18);
      }

      return $return;

    }





    function make_value_pretty($value, $dif){

      $new_array = explode('.', substr_replace($value, '.', $dif,-18));
      $seg_one = number_format($new_array[0]);
      return $seg_one . '.' . rtrim($new_array[1],'0');

    }


    function run_link($uri){

      $split = explode('/', $uri);
      foreach ($split as $segment) {
        $result = $this->get_results_balance($segment);
        if($result !== 'You did not give a correct ETH address.'){

          $_POST['action'] = 'link';
          $_POST['eth_address'] = $segment;

        }

      }

    }


  }
