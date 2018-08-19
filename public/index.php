<!DOCTYPE html>
<html>
  <head>
    <title>thereum Account Browser SPA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>

  <body>
    <?php
      $token = 'MEW5TTTTJKGBAG5VZRGVA12WK9PSP16PM6';
    ?>
    <form action="<?php echo 'https://api.etherscan.io/api?module=account&action=balance&address=0xddbd2b932c763ba5b1b7ae3b362eac3e8d40121a&tag=latest&apikey='.$token">
      ETH Address:
      <br>
      <input placeholder="Enter address here..." type="text" name="eth_address"><br><br>
      <input type="submit" value="Submit"></input>
      <?php
        echo '<pre>';print_r($token);die;
      ?>

    </form>
  </body>

</html>
