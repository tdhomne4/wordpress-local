jquery( document ).ready(function() {

    jquery(window).scroll(function() {
        if (jquery(this).scrollTop() >  150){  
            jquery('.main_header').addClass("sticky");
        }
        else{
            jquery('.main_header').removeClass("sticky");
        }
    }); 

    jquery(".megamenu").on("click", function(e) {
        e.stopPropagation();
    });
    jquery('.btn_search').click(function(){
        jquery('.cust_search').toggle();
     });
     
     jquery('.navbar-toggler').click(function(){
        jquery('.cust_search').hide();
     });

     jquery('.treeview > a').click(function(){
        jquery(this).parent('.treeview').siblings().removeClass('active');
        jquery(this).parent('.treeview').toggleClass('active');
        jquery(this).parent('.treeview').siblings().children('.treeview > ul').slideUp();
        jquery(this).parent('.treeview').children('.treeview > ul').slideToggle();
    });

    var  owl_hero = $('.hero_slider').owlCarousel({
        loop:true, nav:false, dots:true, items:1, autoplay:true, rewind:true, smartSpeed:1000, autoplayTimeout:4000, mouseDrag: false, animateOut: 'fadeOut'
    });

    owl_hero.on('changed.owl.carousel', function(e) {
        new WOW().init();
    });

    jquery('.impact_slider').owlCarousel({
        loop:true, nav:false, dots:true, autoplay:true, rewind:false, smartSpeed:1000, autoplayTimeout:3000, responsive: {0:{items: 1 }, 480:{items: 2 }, 768:{items: 3 }, 1024:{items: 4 } } 
    });
    jquery('.blog_slider').owlCarousel({
        loop:true, margin: 0, nav:false, dots:false, autoplay:true, smartSpeed:1000, autoplayTimeout:3000, dotsEach: true, responsive: {0:{items: 1, center: false, dots:true }, 567:{items: 2, center: false, dots:true }, 767:{items: 3, center: true }, 1199:{items: 5, center: true } } 
    });
 
});