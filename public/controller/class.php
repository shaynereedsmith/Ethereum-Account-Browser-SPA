
<?php

  class eth {

    var $private_key;
    var $action;
    var $address;
    var $results;

    function __construct( ){
      $this->private_key = 'MEW5TTTTJKGBAG5VZRGVA12WK9PSP16PM6';
      if ($_POST) {
        $this->action = $_POST['action'];
        $this->address = $_POST['eth_address'];
        $this->results = $this->process_request();
      }
    }



    function process_request(){

      $result;

      $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
              .$this->address.
              '&tag=latest&apikey='
              .$this->private_key));

      if ($balance->status) {
        $result = array();
        $result['balance'] = $balance->result;
        $result['transactions'] =   $transactions = json_decode(
            file_get_contents(
              'http://api.etherscan.io/api?module=account&action=txlistinternal&address='
              .$this->address
              .'&startblock=0&endblock=2702578&page=1&offset=10&sort=asc&apikey='
              .$this->private_key
              ));

      }else{
        $result = 'is not an eth address';
      }

      return $this->results = $result;

    }

    function get_results_balance($eth_add){

      $result;

      $balance = json_decode(file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='
              .$eth_add.
              '&tag=latest&apikey='
              .$this->private_key));

      if ($balance->status) {
        $result = array();
        $result = $balance->result;
      }else{
        $result = 'is not an eth address';
      }

      return $result;

    }

  }



?>
