<!DOCTYPE html>
<html>
  <head>
    <title>thereum Account Browser SPA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grade.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="app.js"></script>

    <?php
      // LOAD KEY
      $key = 'MEW5TTTTJKGBAG5VZRGVA12WK9PSP16PM6';
    ?>

  </head>
  <body>
    <header class="gradeOne">
      <h1>ethereum</h1>
      <h2>Account Browser SPA</h2>
    </header>
    <form action="index.php" method="get">
      ETH Address:
      <br>
      <input placeholder="Enter address here..." type="text" name="eth_address"><br><br>
      <input id="submit" type="submit" value="Submit"></input>
    </form>
    <div>
      <?php
        if(array_key_exists('eth_address',$_GET)){

          echo '<div class="resultsContainer">Transaction History for: '.$_GET['eth_address'];
          $address = $_GET['eth_address'];
          $result = file_get_contents(
                  'https://api.etherscan.io/api?module=account&action=txlist&address='
                  .$address
                  .'&startblock=0&endblock=99999999&page=1&offset=10&sort=asc&apikey='
                  .$key);
          $result = json_decode($result,true);


          foreach ($result['result'] as $acct){

            $to = $acct['to'];
            $from = $acct['from'];
            print '<div class="accounts">
                  To:
                  <a href="index.php?eth_address='.$to.'">'
                  .$to.'
                  <br></a>
                  From:
                  <a href="index.php?eth_address='.$from.'">'
                  .$from.'
                  </a><br>
                  Block Number: '.$acct['blockNumber']
                  .'<br>
                  Value: '.$acct['value'].'</div>';

          }

        }

      ?>

    </div>

  </body>

</html>


<!-- test: 0xde0b295669a9fd93d5f28d9ec85e40f4cb697bae
<br>
0xddbd2b932c763ba5b1b7ae3b362eac3e8d40121a
my test: 0x11bc5901e4f4eCE4ffd5910506d34A25Eb7aAD6D -->
