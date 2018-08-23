'use strict'

$(document).ready(function(){

  // var split = window.location.href.split('/');
  // var url = split[0] + '//' + split[1] + '/' + split[2] + '/';

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

  var page = 1;

  $('#loadMore').on('click', function(){

    var data = $('#loadMore').attr('data');
    var address = data.split(',')[0];
    var key = data.split(',')[1];

    // $.ajax({ type: 'POST', data: { address: address, page: page }, url: 'controller/fetch_more.php', success: function(result){
    //   console.log(result);
    // }});

    $.post('http://api.etherscan.io/api?module=account&action=txlistinternal&address='+address+'&startblock=0&endblock=2702578&page='+page+'&offset=10&sort=asc&apikey='+key, function(result) {
      if (result.status && result.message === 'OK') {
        var style;
        var i = 0;
        var delayer = 0;
        result.result.forEach(function(item){
          style = i%2 ? 'style="background-color:#e1f3ff; opacity:0"' : 'style="background-color:#fbfbfb; opacity:0;"'
          $('#internalResults').append(
            '<div class="resultItem item_'+item.blockNumber+'" '+style+'>'
                  +'<div>'
                    +'<span class="resultItmeHilight">Sent</span>'
                    +'<br class="showLarge" > '+formatValue(item.value)+' ETH'
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
                +'</div>');i++; delayer = delayer + 200; $('.item_'+item.blockNumber).delay(delayer).animate({opacity: '1'},'fast');}); page++;}});

  });

  function formatValue(value) {

    var result;

    var length = value.length;
    var dif = length - 18;

    if (length >= 19) {
      result = insertDecimal(value);
    }else{
      for (var i = 0; length < 19; i++) {
        value = '0' + value;
      }
      result = insertDecimal(value);
    }

    return result;

  }

  function insertDecimal(num) {

    var newNum = num.split('').reverse().join('');
    var last = newNum.substring(0,18).split('');

    for (var i = 0; i < 3; i++) {
      last = stripper(last);
    }

    last = last.reverse().join('');
    var first = newNum.substring(18).split('').reverse().join('');
    return first + '.' + last;
  }

  function stripper(array){
    array.forEach(function(value){
      if (value === '0') {
        array.shift();
      }else{
        return array;
      }
    });
    return array;
  }

});
