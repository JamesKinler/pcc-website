(function($){
  $(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    });
    // this adds a img class to the top ad banner
    $('#asbC2820_1').find('img').addClass('img-fluid');
    // this adds a img class to the side ad banner
    $('#asbC2821_1').find('img').addClass('img-fluid');

  });
})(jQuery);
