<section>
  <div class="resultsSection">
    <?php
      if (is_array($eth->results)) { ?>
        <div class="eyeContainer">
          <h4 class="resultsHeader"><i class="fas fa-eye fa-2x"></i></h4>
        </div>
        <div class="resultsContainer">
          <div class="primaryResult">
            <h2><span>Address:</span>
            <br /><?php echo ($eth->address);?>
            <br />
            <span>Balance:</span>
            <br /><?php echo ($eth->format_value($eth->results['balance'])); ?> ETH</h2>
            <a href="https://etherscan.io/address/<?php echo ($eth->address); ?>" class="mainItemLink" target="_blank">learn more ></a>
          </div>
          <h3>Recent Transactions:</h3>
          <div id="internalResults">
            <?php
            if (is_array($eth->results['transactions']->result)) {
              $i = 0;
              foreach($eth->results['transactions']->result as $result){
                $style = $i%2 ? 'style="background-color:#e1f3ff;"' : 'style="background-color:#fbfbfb;"'
                ?>
                <div class="resultItem" <?php echo ($style); ?>>
                  <div>
                    <span class="resultItmeHilight">Sent</span>
                    <br class="showLarge" /><?php echo ($eth->format_value($result->value));?> ETH
                  </div>
                  <div>
                    <span class="resultItmeHilight">from address:</span>
                    <br class="showLarge" /><?php echo ($result->from); ?>
                    <br class="showLarge" /><span class="balance">(Balance: <?php echo ($eth->get_results_balance($result->from)); ?></span> ETH)
                  </div>
                  <div>
                    <span class="resultItmeHilight">to address:</span>
                    <br class="showLarge" /><?php echo ($result->to); ?>
                  </div>
                  <div>
                    <span class="resultItmeHilight">on:</span>
                    <br class="showLarge" /><?php echo (date('Y/m/d, h:i:sa',$result->timeStamp)); ?>
                  </div>
                  <div>
                    <span class="resultItmeHilight">Hash:</span>
                    <br class="showLarge" /><?php echo ($result->hash); ?>
                  </div>
                  <div>
                    <a href="https://etherscan.io/address/<?php echo ($result->from);?>" class="itemLink" target="_blank">learn more</a>
                  </div>
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
            <?php } ?>
          </div>
        </div>
        <div style="text-align: center;">
            <div data="<?php echo ($eth->address); ?>,<?php echo ($eth->private_key); ?>" id="loadMore" class="mainItemLink" style="font-family: 'Poiret One', cursive;" >load next 10 results</div>
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
