'use strict'

$(document).ready(function(){

  var split = window.location.href.split('/');
  var url = split[0] + '//' + split[1] + '/' + split[2] + '/';

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

  $('#loadMore').on('click', function(){
    var offset = $('data').val();
    var data = $('#loadMore').attr('data');
    var address = data.split(',')[0];
    var key = data.split(',')[1];

    $.post('http://api.etherscan.io/api?module=account&action=txlistinternal&address='
    +address
    +'&startblock=0&endblock=2702578&page=1&offset='
    +offset
    +'&sort=asc&apikey='
    +key, function(result) {
      if (result.status && result.message === 'OK') {
        var style;
        var i = 0;
        var delayer = 0;
        result.result.forEach(function(item){

          style = i%2 ? 'style="background-color:#e1f3ff; opacity:0"' : 'style="background-color:#fbfbfb; opacity:0;"'
          $('#internalResults').append(
            '<div class="resultItem item_'+item.block+'" '+style+'>'
              +'<div>'+
                +'<span class="resultItmeHilight">Sent</span>'
                +'<br class="showLarge" />'+item.value+' ETH'
              +'</div>'
              +'<div>'
                +'<span class="resultItmeHilight">from address:</span>'
                +'<br class="showLarge" />'+item.from
                +'<br class="showLarge" /><span class="balance">(Balance: BALANCE </span> ETH)'
              +'</div>'
              +'<div>'
                +'<span class="resultItmeHilight">to address:</span>'
                +'<br class="showLarge" />'+item.to+
              +'</div>'
              +'<div>'
                +'<span class="resultItmeHilight">on:</span>'
                +'<br class="showLarge" />'+item.timeStamp+
              +'</div>'
              +'<div>'
                +'<span class="resultItmeHilight">Hash:</span>'
                +'<br class="showLarge" />'+ item.hash +
              +'</div>'
              +'<div>'
                +'<a href="https://etherscan.io/address/'+item.from+'" class="itemLink" target="_blank">learn more</a>'
              +'</div?'
            +'</div>');
          i++;
          delayer = delayer + 200;
          $('.item_'+item.block).delay(delayer).animate({opacity: '1'},'fast');
        });

        offset + 10;
      }

    });
  });

});
