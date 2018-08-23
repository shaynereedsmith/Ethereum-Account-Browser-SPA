'use strict'

$(document).ready(function(){

  if ($('.primaryResult').length) {
    var results = $('.primaryResult');
    $('html,body').animate({scrollTop: results.offset().top - 200}, 1000);
  }

  $('.myName').on('click',function(e){
    e.preventDefault();
    var down = $('.aboutMe');
    var up = $('.footerPara');
    if($('.up').css('display') === 'none'){
      $('.aboutMe').fadeIn();
      $('html,body').animate({scrollTop: down.offset().top}, 1500);
      $('.down').hide()
      $('.up').fadeIn();
    }else{
      $('html,body').animate({scrollTop: up.offset().top - 320}, 1500);
      $('.aboutMe').delay(1500).fadeOut();
      $('.up').hide();
      $('.down').fadeIn()
    }

  });

  var page = 2;

  $('#loadMore').on('click', function(){

    $(this).empty().html(' loading more results, please stand by <i class="fas fa-spinner fa-spin "></i>');
    console.log($(this));
    var data = $('#loadMore').attr('data');
    var address = data.split(',')[0];
    // var key = data.split(',')[1];

    $.ajax({ type: 'POST', data: { address: address, page: page }, url: 'controller/fetch_more.php', success: function(result){
      var data = JSON.parse(result);
      var style;
      var i = 0;
      var delayer = 0;
      data.transactions.forEach(function(item){
        style = i%2 ? 'style="background-color:#e1f3ff; opacity:0"' : 'style="background-color:#fbfbfb; opacity:0;"'

        $('#internalResults').append(
          '<div class="resultItem item_'+item.blockNumber+'" '+style+'>'
            +'<div>'
              +'<span class="resultItmeHilight">Sent</span>'
              +'<br class="showLarge" > '+item.value+' ETH'
            +'</div>'
            +'<div>'
              +'<span class="resultItmeHilight">from address:</span>'
              +'<br class="showLarge" /> '+item.from
              +'<br class="showLarge" /><span class="balance">(Balance: '+item.cleanballance+' </span> ETH)'
            +'</div>'
            +'<div>'
              +'<span class="resultItmeHilight">to address:</span>'
              +'<br class="showLarge" /> '+item.to+
            +'</div>'
            +'<div>'
              +'<span class="resultItmeHilight">on:</span>'
              +'<br class="showLarge" /> '+item.timeStamp+
            +'</div>'
            +'<div>'
              +'<span class="resultItmeHilight">Hash:</span>'
              +'<br class="showLarge" /> '+ item.hash +
            +'</div>'
            +'<div>'
              +'<a href="https://etherscan.io/address/'+item.from+'" class="itemLink" target="_blank">learn more</a>'
              +' <a href="/'+item.to+'" class="itemSearch">serach this address</a>'
            +'</div?'
          +'</div>');
        i++;
        delayer = delayer + 200;
        $('.item_'+item.blockNumber)
          .delay(delayer)
          .animate(
            {opacity: '1'},
            'slow');
      });
      page++;
      $('#loadMore').empty().html('load next 10 results');
    }});

  });

});
