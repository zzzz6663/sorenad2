(function($){$(document).ready(function(){

    $(window).scroll(function(){
        if ($(this).scrollTop() > 10) {
           $("#header").addClass("head_shadow");
        } else {
           $("#header").removeClass("head_shadow");
        }
    });

    $('body').click(function(event) {
      if (!$('.alert_conntent_top').is(event.target) && $('.alert_conntent_top').has(event.target).length === 0) {
        $('.alert_conntent_top').slideUp();
        $('.notific_item').removeClass('active');
      }
    });
    $('.notific_item').click(function(event) {
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".alert_conntent_top").slideToggle();
    });
    $('body').click(function(event) {
      if (!$('.alert_conntent_top').is(event.target) && $('.alert_conntent_top').has(event.target).length === 0) {
        $('.alert_conntent_top').slideUp();
        $('.alert_num').removeClass('active');
      }
    });
    $('.alert_num').click(function(event) {
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".alert_conntent_top").slideToggle();
    });


    $('body').click(function(event) {
      if (!$('.account_info_box').is(event.target) && $('.account_info_box').has(event.target).length === 0) {
        $('.account_info_box').slideUp();
        $('.account_show').removeClass('active');
      }
    });
    $('.account_show').click(function(event) {
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".account_info_box").slideToggle();
    });


    $(document).scroll(function(){
    var y = $(this).scrollTop();
    if (y > 600){ $('.top_page').fadeIn(); } else{ $('.top_page').fadeOut(); }});
    $('.top_page').click( function(){ $('body,html').animate({ scrollTop: 0 },600); return false; });

    $(".navicon").click(function(){ $("#sidebar_right").animate({marginRight:"0px"},200,"linear"); });
    $(".bodydeactive").click(function(){ $("#sidebar_right").animate({marginRight:"-1500px"},200,"linear"); });


    //box_c1
    $('body').click(function(event) {
      if (!$('.popuup_c_box1').is(event.target) && $('.popuup_c_box1').has(event.target).length === 0) {
        $('.popup_c_bg1').removeClass('show_c_box1');
        $("body").removeClass("hidde_c_box1");
      }
     });
    $(".show_c_box1").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg1").addClass("show_c_box1");
      $("body").addClass("hidde_c_box1");
    });
    $(".close_c_box1").click(function(){
        $('.popup_c_bg1').removeClass('show_c_box1');
        $("body").removeClass("hidde_c_box1");
    });
    //box_c1
    //box_c2
    $('body').click(function(event) {
      if (!$('.popuup_c_box2').is(event.target) && $('.popuup_c_box2').has(event.target).length === 0) {
        $('.popup_c_bg2').removeClass('show_c_box2');
        $("body").removeClass("hidde_c_box2");
      }
     });
    $(".show_c_box2").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg2").addClass("show_c_box2");
      $("body").addClass("hidde_c_box2");
    });
    $(".close_c_box2").click(function(){
        $('.popup_c_bg2').removeClass('show_c_box2');
        $("body").removeClass("hidde_c_box2");
    });
    //box_c2
    //box_c3
    $('body').click(function(event) {
      if (!$('.popuup_c_box3').is(event.target) && $('.popuup_c_box3').has(event.target).length === 0) {
        $('.popup_c_bg3').removeClass('show_c_box3');
        $("body").removeClass("hidde_c_box3");
      }
     });
    $(".show_c_box3").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg3").addClass("show_c_box3");
      $("body").addClass("hidde_c_box3");
    });
    $(".close_c_box3").click(function(){
        $('.popup_c_bg3').removeClass('show_c_box3');
        $("body").removeClass("hidde_c_box3");
    });
    //box_c3
    //box_c4
    $('body').click(function(event) {
      if (!$('.popuup_c_box4').is(event.target) && $('.popuup_c_box4').has(event.target).length === 0) {
        $('.popup_c_bg4').removeClass('show_c_box4');
        $("body").removeClass("hidde_c_box4");
      }
     });
    $(".show_c_box4").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg4").addClass("show_c_box4");
      $("body").addClass("hidde_c_box4");
    });
    $(".close_c_box4").click(function(){
        $('.popup_c_bg4').removeClass('show_c_box4');
        $("body").removeClass("hidde_c_box4");
    });
    //box_c4
    //box_c5
    $('body').click(function(event) {
      if (!$('.popuup_c_box5').is(event.target) && $('.popuup_c_box5').has(event.target).length === 0) {
        $('.popup_c_bg5').removeClass('show_c_box5');
        $("body").removeClass("hidde_c_box5");
      }
     });
    $(".show_c_box5").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg5").addClass("show_c_box5");
      $("body").addClass("hidde_c_box5");
    });
    $(".close_c_box5").click(function(){
        $('.popup_c_bg5').removeClass('show_c_box5');
        $("body").removeClass("hidde_c_box5");
    });
    //box_c5
    //box_c6
    $('body').click(function(event) {
      if (!$('.popuup_c_box6').is(event.target) && $('.popuup_c_box6').has(event.target).length === 0) {
        $('.popup_c_bg6').removeClass('show_c_box6');
        $("body").removeClass("hidde_c_box6");
      }
     });
    $(".show_c_box6").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg6").addClass("show_c_box6");
      $("body").addClass("hidde_c_box6");
    });
    $(".close_c_box6").click(function(){
        $('.popup_c_bg6').removeClass('show_c_box6');
        $("body").removeClass("hidde_c_box6");
    });
    //box_c6
    //box_c7
    $('body').click(function(event) {
      if (!$('.popuup_c_box7').is(event.target) && $('.popuup_c_box7').has(event.target).length === 0) {
        $('.popup_c_bg7').removeClass('show_c_box7');
        $("body").removeClass("hidde_c_box7");
      }
     });
    $(".show_c_box7").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg7").addClass("show_c_box7");
      $("body").addClass("hidde_c_box7");
    });
    $(".close_c_box7").click(function(){
        $('.popup_c_bg7').removeClass('show_c_box7');
        $("body").removeClass("hidde_c_box7");
    });
    //box_c7
    //box_c8
    $('body').click(function(event) {
      if (!$('.popuup_c_box8').is(event.target) && $('.popuup_c_box8').has(event.target).length === 0) {
        $('.popup_c_bg8').removeClass('show_c_box8');
        $("body").removeClass("hidde_c_box8");
      }
     });
    $(".show_c_box8").click(function(event){
      event.stopPropagation()
      $(this).toggleClass('active');
      $(".popup_c_bg8").addClass("show_c_box8");
      $("body").addClass("hidde_c_box8");
    });
    $(".close_c_box8").click(function(){
        $('.popup_c_bg8').removeClass('show_c_box8');
        $("body").removeClass("hidde_c_box8");
    });
    //box_c8


      /*  FAQ */
      var parent = $( '.h3-to-tab' );
      var allh3 = parent.find( 'h3' );
      if( allh3.length ) {
        parent
          .attr( 'itemscope', '' )
          .attr( 'itemtype', 'https://schema.org/FAQPage' );
      }
      allh3.addClass( 'accordion-header closed' );
      allh3.each( function( i, h3 ) {
        var questionBody = $( '<div>' )
          .attr( 'itemscope', '' )
          .attr( 'itemprop', 'mainEntity' )
          .attr( 'itemtype', 'https://schema.org/Question' )
          [ 0 ]; // get real DOM object no jQuery one
        var accordionBody = $( '<div>' )
          .hide()
          .attr( 'itemscope', '' )
          .attr( 'itemprop', 'acceptedAnswer' )
          .attr( 'itemtype', 'https://schema.org/Answer' )
          .addClass( 'accordion-body closed' );
        accordionBody.appendTo( questionBody )
        h3.setAttribute( 'itemprop', 'name' );
        var bodyInner = $( '<div>' )
            .attr( 'itemprop', 'text' )
            .appendTo( accordionBody );
        $( h3 ).nextUntil( 'h3' ).appendTo( bodyInner );

        h3.parentNode.insertBefore( questionBody, h3.nextSibling );
        questionBody.insertBefore( h3, accordionBody[ 0 ] );
      } );
      parent.on( 'click', 'h3', function( evt ) {
        $( this ).toggleClass( 'closed' );
        $( this ).next( '.accordion-body' ).slideToggle();
      } );



      
    });}(jQuery));
