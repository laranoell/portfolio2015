var $ = require('jquery');
var jQuery = $;

(function ($, window, document) {
 'use strict';
  // var timerStart = +new Date();
  
 function Navigation(pageId, navHeight, navId, linkClass, targets){
    this.topoffset = navHeight || 70;
    this.isTouch   = 'ontouchstart' in document.documentElement;
    this.wheight   = window.innerHeight;
    this.nav       = document.querySelector(navId || 'nav');
    this.jqNav     = $(navId);
    this.navtab    = document.getElementById('navtab');
    this.navlinks  = document.querySelectorAll(linkClass || 'nav li a');
    this.numLinks  = this.navlinks.length;
    this.targets   = targets || [];
    this.animated  = (window.matchMedia('(min-width: 1088px)').matches) ? true : false;
    var self = this;

    for (var i = 0; i < this.targets.length; i++) {
      this.targets[i] = document.getElementById(targets[i]);
    }

    this.init = function(){
      // add scroll event listener on screens bigger than 1088, to keep mob performance nice and quick
      if(this.animated){
        window.addEventListener('scroll', function () {
          window.requestAnimationFrame(self.scrollHandler);
        });
      }
    }
    // close nav etc on scroll ** more animations to come
    this.scrollHandler = function(){    
      if( window.scrollY > 10 && !self.jqNav.hasClass('closed')){ 
        self.jqNav.addClass("closed");
      }
    }

    this.nav.addEventListener("click", function(e){
      if(e.target.className === 'navlink'){
        e.preventDefault();
        var targetSection = $(e.target.hash).offset().top - (self.topoffset/2);
        $('html,body').animate({scrollTop: targetSection}, 1000);
      }
    });

    //open and close menu when hovering over logo
    this.navtab.addEventListener('click', function(){
       var windowpos = window.scrollY + self.topoffset || 0;
       //remove active class from all links  
       for(var j = 0; j < self.numLinks; j++) {
         self.navlinks[j].classList.remove("active");
         
         //then add 'active' to the right link, depending on what target is being viewed.
         if( self.numLinks !== j + 1 ) {
           if ( windowpos > self.targets[j].offsetTop && windowpos < self.targets[(j+1)].offsetTop) {
            self.navlinks[j].classList.add("active");
           }
         //last loop only has one condition (no need to check for targets beyond the last target)
         }else{
           if ( windowpos > self.targets[j].offsetTop ){
             self.navlinks[j].classList.add("active");
           }
         }
         self.jqNav.toggleClass("closed");
       } 
    }, false);
    
  };

  var portfolioNav = new Navigation('portfolio', 70, '#navbar', '.navlink' , ['work-ex', 'tools', 'contact']);
  portfolioNav.init();


})(jQuery, window, window.document);

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
 
// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
 
// MIT license
 
(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());