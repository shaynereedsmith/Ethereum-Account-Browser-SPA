'use strict'

$(document).ready(function(){

  if ($('.primaryResult').length) {
    var results = $('.primaryResult');
    $('html,body').animate({scrollTop: results.offset().top - 100}, 1000);
  }

  $('.myName').on('click',function(e){
    e.preventDefault();
    var down = $('.aboutMe');
    var up = $('.footerPara');
    if($('.up').css('display') === 'none'){
      $('.aboutMe').fadeIn();
      $('html,body').animate({scrollTop: down.offset().top}, 1500);
      $('.down').hide()
      $('.up').show();
    }else{
      $('html,body').animate({scrollTop: up.offset().top}, 'slow');
      $('.aboutMe').hide();
      $('.down').show()
      $('.up').hide();
    }

  });

});
