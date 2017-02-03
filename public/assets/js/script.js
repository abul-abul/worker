$(document).ready(function () {

    
    //Index page counter
    
    $('.stat-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    
    
    
    // //Mobile menu
    
    // $('.mobile-menu a').click(function () {
    //     $('body').toggleClass('menu-show');
    // });

    
    
    
    //Category remove
    
    $('img.remove-category').on('click' , function(){
        $(this).parents('.toclose').css('display', 'none');
    });
  
    var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

       if(dd<10) {
           dd='0'+dd
       }

       if(mm<10) {
           mm='0'+mm
       }

        today = mm+'/'+dd+'/'+yyyy;

       $('#dtpick').datepicker({
           startDate: today,
           todayBtn: true,
           keyboardNavigation: false,
           forceParse: false,
           todayHighlight: true
       });

     $('.glyphicon-calendar').click(function(){
          $("#dtpick").trigger("focus");
     })
});