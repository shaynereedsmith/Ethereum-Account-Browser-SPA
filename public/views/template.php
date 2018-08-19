<?php
  require 'controller/class.php';
  $eth = new eth();
  echo '<pre>';print_r($eth);
?>

<header class="gradeOne">
  <img src="images/ethereum.svg" alt="ethereum logo" width="100px"/>
  <h1>ethereum</h1>
  <h2>Account Browser SPA</h2>
</header>

<div class="formContainer">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <h3 class="inputHeader">Input Ethereum Address:</h3>
    <br>
    <input class="input" placeholder="Enter address here..." type="text" name="eth_address" required><br><br>
    <input type="hidden" name="action" value="address_submit">
    <input id="submit" type="submit" value="Submit">
  </form>
</div>

<section>
  <div>
    <?php
      if ($eth->results) { ?>
        <div class="resultsContainer">
          <span class="trasHistory">Address: <?php echo ($eth->address);?> - Balance: <?php echo ($eth->results['balance']);?> ETH</span>
          <div>
            <?php
              foreach($eth->results['transactions']->result as $result){ ?>
                <div>
                  Balance: <?php echo ($eth->get_results_balance($result->from));?>
                </div>

              <?php }
            ?>
          </div>
        </div>
      <?php }
    ?>
  </div>
</section>
<footer>
  <p class="footerPara">This is an arbitrary footer
  <br><br>
  <img class="footerImg" width="40px" src="images/ethereum.svg" alt="ethereum logo" />
  </p>
</footer>
