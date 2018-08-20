<section>
  <div class="resultsSection">
    <h4 class="resultsHeader">Results</h4>
    <?php
      if (is_array($eth->results)) { ?>
        <div class="resultsContainer">
          <div class="primaryResult">
            <h2><span>Address:</span> <?php echo ($eth->address);?> - <span>Balance:</span> <?php echo ($eth->format_value($eth->results['balance'])); ?> ETH</h2>
            <a href="https://etherscan.io/address/<?php echo ($eth->address); ?>" target="_blank">learn more ></a>
          </div>
          <h3>Recent Transactions:</h3>
          <div>
            <?php
            if (is_array($eth->results['transactions']->result)) {
              foreach($eth->results['transactions']->result as $result){ ?>
                <div class="resultItem">
                  Sent <?php echo ($eth->format_value($result->value));?> ETH from address: <?php echo ($result->from); ?> (Balance: <?php echo ($eth->get_results_balance($result->from)); ?> ETH)
                  <br/>
                  to address: <?php echo ($result->to); ?>
                  <br/>
                  on: <?php echo (date('Y/m/d, h:i:sa',$result->timeStamp)); ?>
                  <br/>
                  Hash: <?php echo ($result->hash); ?>
                  <br/>
                  <a href="https://etherscan.io/address/<?php echo ($result->from);?>" target="_blank">learn more</a>
                </div>

              <?php }
            }else{ ?>
              <div>
                <?php
                if (!empty($eth->results['transactions'])) {
                  echo ($eth->results['transactions']);
                } ?>
              </div>
            <?php }

            ?>
          </div>
        </div>
      <?php }elseif ($eth->results) {?>
        <div class="resultsContainer">
          <?php echo $eth->results?>
        </div>
      <?php }else{ ?>
        <div class="resultsContainer">
        <?php echo 'Please submit an Ethereum address.'; ?>
      </div>
      <?php }
    ?>
  </div>
</section>
