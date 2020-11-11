(function($) {
    showToast = function(type, msg) {
      'use strict';
      $.toast({
        text: msg,
        showHideTransition: 'slide',
        loaderBg: '#f96868',
        icon: type,
        position: 'bottom-left',
        hideAfter: 5000
      })
    };


    //copy text
    $(document).on('click','#copyboard', function(e) {
      e.preventDefault();
      var copyText = $(this).attr('data-text');
      var textarea = document.createElement("textarea");
      textarea.textContent = copyText;
      textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand("copy");
      document.body.removeChild(textarea);
      showToast("info","Copy Success");
    });


     //tool tip
     /* Code for attribute data-custom-class for adding custom class to tooltip */
     if (typeof $.fn.tooltip.Constructor === 'undefined') {
       throw new Error('Bootstrap Tooltip must be included first!');
     }

     var Tooltip = $.fn.tooltip.Constructor;

     // add customClass option to Bootstrap Tooltip
     $.extend(Tooltip.Default, {
       customClass: ''
     });

     var _show = Tooltip.prototype.show;

     Tooltip.prototype.show = function() {

       // invoke parent method
       _show.apply(this, Array.prototype.slice.apply(arguments));

       if (this.config.customClass) {
         var tip = this.getTipElement();
         $(tip).addClass(this.config.customClass);
       }

     };
     $('[data-toggle="tooltip"]').tooltip();
})(jQuery);
