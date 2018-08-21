<section>
  <div class="resultsSection">
    <?php
      if (is_array($eth->results)) { ?>
        <div class="eyeContainer">
          <h4 class="resultsHeader"><i class="fas fa-eye fa-2x"></i></h4>
        </div>
        <div class="resultsContainer">
          <div class="primaryResult">
            <h2><span>Address:</span> <?php echo ($eth->address);?>
            <br />
            <span>Balance:</span>
              <?php echo ($eth->format_value($eth->results['balance'])); ?> ETH</h2>
            <a href="https://etherscan.io/address/<?php echo ($eth->address); ?>" class="mainItemLink" target="_blank">learn more ></a>
          </div>
          <h3>Recent Transactions:</h3>
          <div>
            <?php
            if (is_array($eth->results['transactions']->result)) {
              $i = 0;
              foreach($eth->results['transactions']->result as $result){
                $style = $i%2 ? 'style="background-color:#e1f3ff;"' : 'style="background-color:#fbfbfb;"'
                ?>
                <div class="resultItem" <?php echo ($style); ?>>
                  <span class="resultItmeHilight">Sent</span> <?php echo ($eth->format_value($result->value));?> ETH
                  <br/>
                  <span class="resultItmeHilight">from address:</span> <?php echo ($result->from); ?> (Balance: <?php echo ($eth->get_results_balance($result->from)); ?> ETH)
                  <br/>
                  <span class="resultItmeHilight">to address:</span> <?php echo ($result->to); ?>
                  <br/>
                  <span class="resultItmeHilight">on:</span> <?php echo (date('Y/m/d, h:i:sa',$result->timeStamp)); ?>
                  <br/>
                  <span class="resultItmeHilight">Hash:</span> <?php echo ($result->hash); ?>
                  <br/>
                  <a href="https://etherscan.io/address/<?php echo ($result->from);?>" class="itemLink" target="_blank">learn more</a>
                </div>

              <?php
              $i++;
            }
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
          Please submit an Ethereum address.
      </div>
      <?php }
    ?>
  </div>
</section>
