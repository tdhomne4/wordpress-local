jQuery( document ).ready(function() {

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() >  150){  
            jQuery('.main_header').addClass("sticky");
        }
        else{
            jQuery('.main_header').removeClass("sticky");
        }
    }); 

    jQuery(".megamenu").on("click", function(e) {
        e.stopPropagation();
    });
     jQuery('.btn_search').click(function(){
         jQuery('.cust_search').toggle();
     });
     
     jQuery('.navbar-toggler').click(function(){
         jQuery('.cust_search').hide();
     });

    jQuery('.treeview > a').click(function(){
        jQuery(this).parent('.treeview').siblings().removeClass('active');
        jQuery(this).parent('.treeview').toggleClass('active');
        jQuery(this).parent('.treeview').siblings().children('.treeview > ul').slideUp();
        jQuery(this).parent('.treeview').children('.treeview > ul').slideToggle();
    });

    var  owl_hero = jQuery('.hero_slider').owlCarousel({
        loop:true, nav:false, dots:true, items:1, autoplay:true, rewind:true, smartSpeed:1000, autoplayTimeout:4000, mouseDrag: false, animateOut: 'fadeOut'
    });

    owl_hero.on('changed.owl.carousel', function(e) {
        new WOW().init();
    });

    jQuery('.impact_slider').owlCarousel({
        loop:true, nav:false, dots:true, autoplay:true, rewind:false, smartSpeed:1000, autoplayTimeout:3000, responsive: {0:{items: 1 }, 480:{items: 2 }, 768:{items: 3 }, 1024:{items: 4 } } 
    });
    jQuery('.blog_slider').owlCarousel({
        loop:true, margin: 0, nav:false, dots:false, autoplay:true, smartSpeed:1000, autoplayTimeout:3000, dotsEach: true, responsive: {0:{items: 1, center: false, dots:true }, 567:{items: 2, center: false, dots:true }, 767:{items: 3, center: true }, 1199:{items: 5, center: true } } 
    });
 
});

