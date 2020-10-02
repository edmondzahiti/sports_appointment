// VOID CONSOLE
(function() {var method;var noop = function () {};var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error','exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log','markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd','timeStamp', 'trace', 'warn'];var length = methods.length;var console = (window.console = window.console || {});while (length--) {method = methods[length];if (!console[method]) {console[method] = noop;}}}());
// LOAD MASK SPIN
!function(a){a.fn.mask=function(b,c){a(this).each(function(){if(void 0!==c&&c>0){var d=a(this);d.data("_mask_timeout",setTimeout(function(){a.maskElement(d,b)},c))}else a.maskElement(a(this),b)})},a.fn.unmask=function(){a(this).each(function(){a.unmaskElement(a(this))})},a.fn.isMasked=function(){return this.hasClass("masked")},a.maskElement=function(b,c){void 0!==b.data("_mask_timeout")&&(clearTimeout(b.data("_mask_timeout")),b.removeData("_mask_timeout")),b.isMasked()&&a.unmaskElement(b),"static"==b.css("position")&&b.addClass("masked-relative"),b.addClass("masked");var d=a('<div class="loadmask"></div>');if(navigator.userAgent.toLowerCase().indexOf("msie")>-1&&(d.height(b.height()+parseInt(b.css("padding-top"))+parseInt(b.css("padding-bottom"))),d.width(b.width()+parseInt(b.css("padding-left"))+parseInt(b.css("padding-right")))),navigator.userAgent.toLowerCase().indexOf("msie 6")>-1&&b.find("select").addClass("masked-hidden"),b.append(d),void 0!==c){var e=a('<div class="loadmask-msg" style="display:none;"></div>');e.append("<div>"+c+"</div>"),b.append(e),e.css("top",Math.round(b.height()/2-(e.height()-parseInt(e.css("padding-top"))-parseInt(e.css("padding-bottom")))/2)+"px"),e.css("left",Math.round(b.width()/2-(e.width()-parseInt(e.css("padding-left"))-parseInt(e.css("padding-right")))/2)+"px"),e.show()}},a.unmaskElement=function(a){void 0!==a.data("_mask_timeout")&&(clearTimeout(a.data("_mask_timeout")),a.removeData("_mask_timeout")),a.find(".loadmask-msg,.loadmask").remove(),a.removeClass("masked"),a.removeClass("masked-relative"),a.find("select").removeClass("masked-hidden")}}(jQuery);
/**
 * jQuery global Functions 
 *
 * Copyright 2015
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 */
(function($){
  var LUCART = window.LUCART || {};
  // Create cross browser requestAnimationFrame method:
  window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(f) {
      setTimeout(f, 1000 / 60);
  };
  LUCART.DOMInfo = {};
  LUCART.DOMInfo = {

      usingMobileBrowser: (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|BlackBerry|IEMobile|Opera Mini)/)) ? true : false,

      getWindowSize: function() {
          LUCART.Constants.windowHeight = window.innerHeight;
          LUCART.Constants.windowWidth = window.innerWidth;
      },

      scrollPosMouse: function() {
          return $(window).scrollTop();
      },

      scrollPosRAF: function() {
          LUCART.Constants.scrollTop = $(window).scrollTop();
          requestAnimationFrame(LUCART.DOMInfo.scrollPosRAF);
      },

      bindEvents: function() {
          if (!this.usingMobileBrowser) {
              $(window).on('scroll', function() {
                  LUCART.Constants.scrollTop = LUCART.DOMInfo.scrollPosMouse();
              });
          }
          $(window).on('resize', LUCART.DOMInfo.getWindowSize);
      }
  };
  LUCART.Constants = {
      statepageLoading: "is-loading",
      stateClassOpen: "is-open",
      stateClassClosed: "is-closed",
      windowHeight:0,
      windowWidth: 0,
      scrollTop: 0
  };

  LUCART.isTouchDevice = function(){
    return !!('ontouchstart' in window) || !! (window.navigator.maxTouchPoints);
  };

  LUCART.setScrfToken = function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  };

  LUCART.initPlugins = function(){
    if ($.isFunction($.fn.tooltip)) {
      $('[data-toggle="tooltip"]').tooltip();
    }

    if ($.isFunction($.fn.popover)) {
      $('[data-toggle="popover"]').popover();
    }
  };
  // DOCUMENT READY //
  $(document).ready(function() {
    "use strict";
    // used to set SCRF token for ajax calls
    LUCART.setScrfToken();

    if (LUCART.isTouchDevice() && LUCART.DOMInfo.usingMobileBrowser) {
      $('body').addClass('is-mobile');
    } else {
      $('body').addClass('no-mobile no-touch');
    }
    // initialise plugins
    LUCART.initPlugins();
  });
})(jQuery);
