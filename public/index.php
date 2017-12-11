<!DOCTYPE html>
<html>
  <head>
    <title>thereum Account Browser SPA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One|Quicksand|Source+Sans+Pro" rel="stylesheet">
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
      <img src="images/ethereum.svg" alt="ethereum logo" width="100px"/>
      <h1>ethereum</h1>
      <h2>Account Browser SPA</h2>
    </header>

    <div class="formContainer">
      <form action="index.php" method="get">
        <h3 class="inputHeader">Input Ethereum Address:</h3>
        <br>
        <input class="input" placeholder="Enter address here..." type="text" name="eth_address" required><br><br>
        <input id="submit" type="submit" value="Submit"></input>
      </form>
    </div>

    <section>
      <div>
        <?php
          if(array_key_exists('eth_address',$_GET)){

            echo '<div class="resultsContainer"><span class="trasHistory">Transaction History for: </span><span class="currentAddress">'
            .$_GET['eth_address'];
            $address = $_GET['eth_address'];
            $result = file_get_contents(
                    'https://api.etherscan.io/api?module=account&action=txlist&address='
                    .$address
                    .'&startblock=0&endblock=99999999&page=1&offset=10&sort=asc&apikey='
                    .$key);
            echo '</span>';
            $result = json_decode($result,true);

            //Loads Results
            foreach ($result['result'] as $acct){
              $to = $acct['to'];
              $from = $acct['from'];
              print '<div class="accounts">
                    To:
                    <a class="to" href="index.php?eth_address='.$to.'">'
                    .$to.'
                    <br></a>
                    From:
                    <a class="from" href="index.php?eth_address='.$from.'">'
                    .$from.'
                    </a>
                    <p class="block">Block: '.$acct['blockNumber']
                    .'</p>
                    <p class="value">Value: '.$acct['value'].'</p>
                    </div>';
            }
            echo '</div>';
          }
        ?>
      </div>
    </section>
    <footer>
      <p class="footerPara">This is an arbitrary footer
      <br><br>
      <img class="footerImg" width="40px" src="images/ethereum.svg" alt="ethereum logo" />
      </p>
    </footer>


  </body>

</html>
