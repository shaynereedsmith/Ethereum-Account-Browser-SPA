<section>
  <div>
    <?php
      if (is_array($eth->results)) { ?>
        <div class="resultsContainer">
          <h2>Address: <?php echo ($eth->address);?> - Balance: <?php echo ($eth->format_value($eth->results['balance'])); ?> ETH</h2>
          <div>
            <h3>Recent Transactions:</h3>
          </div>
          <div>
            <?php
            if (is_array($eth->results['transactions']->result)) {
              foreach($eth->results['transactions']->result as $result){ ?>
                <div>
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
      <?php }else{
        echo 'Please submit an Ethereum address.';
      }
    ?>
  </div>
</section>
