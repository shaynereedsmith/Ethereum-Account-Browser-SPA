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

    $.ajax({ type: 'POST', data: { address: address, page: page }, url: 'controller/fetch_more.php', success: function(result){
      console.log(result);
    }});

  });

  // function formatValue(value) {
  //
  //   var result;
  //
  //   var length = value.length;
  //   var dif = length - 18;
  //
  //   if (length >= 19) {
  //     result = 'value: '+value+' and length: '+length+' -- '+insertDecimal(value);
  //   }else{
  //     result = 'less than 18';
  //   }
  //
  //   return result;
  //
  // }
  //
  // function insertDecimal(num) {
  //
  //   var newNum = num.split('').reverse().join('');
  //   var last = newNum.substring(0,18).split('').reverse().join('');
  //   var first = newNum.substring(18).split('').reverse().join('');
  //   console.log(last.toLocaleString('en', {maximumSignificantDigits : 21}));
  //
  //   console.log(first,last);
  //
  //   return (num / 100);
  // }

});
