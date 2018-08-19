<div class="formContainer">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <h3 class="inputHeader">Input Ethereum Address:</h3>
    <br>
    <input class="input" placeholder="Enter address here..." type="text" name="eth_address" value="<?php echo ($eth->address ? $eth->address : '');?>" required><br><br>
    <input type="hidden" name="action" value="address_submit">
    <input id="submit" type="submit" value="Submit">
  </form>
</div>
