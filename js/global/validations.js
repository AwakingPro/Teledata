if (($('#demo-dp-component .input-group.date').size() > 0) || ($('.input-daterange').size() > 0)) {
    if ($.fn.datepicker) {
        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
            daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy"
        };

        $('#demo-dp-component .input-group.date').datepicker({ autoclose: true, format: "yyyy-mm-dd", weekStart: 1, language: 'es' });

        $('.input-daterange').datepicker({
            format: "yyyy/mm/dd",
            weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
    }
}
var ValorUF = 0
$.ajax({
    type: "POST",
    url: "../includes/facturacion/uf/getValue.php",
    success: function(response) {
        $('.ValorUF').text(response)
        ValorUF = response
    }
});

function ValidarCorreo(Correo) {
    var sw1 = 0;
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    if (!emailreg.test(Correo)) {
        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'El correo no es valido ',
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }else if(Correo.trim() == "" ){

        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'Debe llenar el campo Correo',
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }

    if (sw1 == 1) {
        return false;
    } else {
        return true;
    }
};

function ValidarString(Input, Text) {
    var sw1 = 0;
    if (Input.trim() == "") {
        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'Debe llenar el campo '+Text,
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }
    if (sw1 == 1) {
        return false;
    } else {
        return true;
    }
};

$.postFormValues = function (url, form, extras = false, callback) {
    if ($(form).length) {
        var countObjs = 0;
        var countValidates = 0;
        var objs = $(form).find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
        var formValues = new FormData();
        objs.each(function(index, obj) {
            if (obj.hasAttribute('name')) {
                countObjs++;
                if ($.validation(obj)) {
                    formValues.append($(obj).attr('name'), $(obj).val());
                    countValidates++;
                }else{
                    return false;
                }
            }
        });
        if (countObjs == countValidates) {
            if (extras) {
                formValues.append('extras', extras);
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: formValues,
                processData: false,
                contentType: false,
                success: function(data) {
                    callback(data);
                }
            });
        }
    }else{
        return false;
    }
}

$.validation = function(obj) {
    if (obj.hasAttribute('validation')) {
        switch($(obj).attr('validation')) {
            case 'not_null':
                if ($(obj).val() == "") {

                    $.niftyNoty({
                        type: 'danger',
                        icon : 'fa fa-check',
                        message : 'Debe llenar el campo '+$(obj).data('nombre'),
                        container : 'floating',
                        timer : 3000
                    });

                    break;
                }
            default:
                return true;
        }
    }else{
        return true;
    }
}

/*$.post('../ajax/menu/mainMenu.php', {url: window.location.pathname}, function(data) {
    $('#mainnav-menu').html(data);
    $('.effect').attr('attr', '');
    $('.menu-items').hover(function() {
        if ($('.effect').attr('attr') == '') {
            $('.hover-menu').remove()
            var x = $(this).position();
            var top = x.top + 41;
            $('body').append('<span class="hover-menu" style="top:'+top+'px;">'+$(this).html()+'</span>')
        }else{
            $('.menu-items').click(function() {
                if ($(this).find('ul').hasClass('in')){
                    $(this).find('ul').removeClass('in');
                }else{
                    $(this).find('ul').addClass('in');
                }
            });
        }
    }, function(){
        $('.hover-menu').hover(function(){}, function() {
            $('.hover-menu').remove()
        });
    });

});*/

$('.effect').attr('attr', '');
$('.menu-items').hover(function() {
    if ($('.effect').attr('attr') == '') {
        $('.hover-menu').remove()
        var x = $(this).position();
        var top = x.top + 41;
        $('body').append('<span class="hover-menu" style="top:'+top+'px;">'+$(this).html()+'</span>')
    }else{
        $('.menu-items').click(function() {
            if ($(this).find('ul').hasClass('in')){
                $(this).find('ul').removeClass('in');
            }else{
                $(this).find('ul').addClass('in');
            }
        });
    }
}, function(){
    $('.hover-menu').hover(function(){}, function() {
        $('.hover-menu').remove()
    });
});

//$('.containerHeader').load('../ajax/header/mainHeader.php');


$(document).on('click', '.itemsMenu', function() {
    $(this).siblings('.collapse').slideToggle();
});

$(document).on('click', '.tgl-menu-btn', function(event){
    event.preventDefault();
    if ($('.effect').attr('attr') == 1) {
        $('.effect').addClass('mainnav-sm');
        $('.effect').removeClass('mainnav-in');
        $('.effect').attr('attr', '');
    }else{
        $('.effect').addClass('mainnav-in');
        $('.effect').removeClass('mainnav-sm');
        $('.effect').attr('attr', '1');
    }
});


!function(a){return"function"==typeof define&&define.amd?define(["jquery"],function(b){return a(b,window,document)}):"object"==typeof exports?module.exports=a(require("jquery"),window,document):a(jQuery,window,document)}(function(a,b,c){"use strict";var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H;z={paneClass:"nano-pane",sliderClass:"nano-slider",contentClass:"nano-content",iOSNativeScrolling:!1,preventPageScrolling:!1,disableResize:!1,alwaysVisible:!1,flashDelay:1500,sliderMinHeight:20,sliderMaxHeight:null,documentContext:null,windowContext:null},u="scrollbar",t="scroll",l="mousedown",m="mouseenter",n="mousemove",p="mousewheel",o="mouseup",s="resize",h="drag",i="enter",w="up",r="panedown",f="DOMMouseScroll",g="down",x="wheel",j="keydown",k="keyup",v="touchmove",d="Microsoft Internet Explorer"===b.navigator.appName&&/msie 7./i.test(b.navigator.appVersion)&&b.ActiveXObject,e=null,D=b.requestAnimationFrame,y=b.cancelAnimationFrame,F=c.createElement("div").style,H=function(){var a,b,c,d,e,f;for(d=["t","webkitT","MozT","msT","OT"],a=e=0,f=d.length;f>e;a=++e)if(c=d[a],b=d[a]+"ransform",b in F)return d[a].substr(0,d[a].length-1);return!1}(),G=function(a){return H===!1?!1:""===H?a:H+a.charAt(0).toUpperCase()+a.substr(1)},E=G("transform"),B=E!==!1,A=function(){var a,b,d;return a=c.createElement("div"),b=a.style,b.position="absolute",b.width="100px",b.height="100px",b.overflow=t,b.top="-9999px",c.body.appendChild(a),d=a.offsetWidth-a.clientWidth,c.body.removeChild(a),d},C=function(){var a,c,d;return c=b.navigator.userAgent,(a=/(?=.+Mac OS X)(?=.+Firefox)/.test(c))?(d=/Firefox\/\d{2}\./.exec(c),d&&(d=d[0].replace(/\D+/g,"")),a&&+d>23):!1},q=function(){function j(d,f){this.el=d,this.options=f,e||(e=A()),this.$el=a(this.el),this.doc=a(this.options.documentContext||c),this.win=a(this.options.windowContext||b),this.body=this.doc.find("body"),this.$content=this.$el.children("."+this.options.contentClass),this.$content.attr("tabindex",this.options.tabIndex||0),this.content=this.$content[0],this.previousPosition=0,this.options.iOSNativeScrolling&&null!=this.el.style.WebkitOverflowScrolling?this.nativeScrolling():this.generate(),this.createEvents(),this.addEvents(),this.reset()}return j.prototype.preventScrolling=function(a,b){if(this.isActive)if(a.type===f)(b===g&&a.originalEvent.detail>0||b===w&&a.originalEvent.detail<0)&&a.preventDefault();else if(a.type===p){if(!a.originalEvent||!a.originalEvent.wheelDelta)return;(b===g&&a.originalEvent.wheelDelta<0||b===w&&a.originalEvent.wheelDelta>0)&&a.preventDefault()}},j.prototype.nativeScrolling=function(){this.$content.css({WebkitOverflowScrolling:"touch"}),this.iOSNativeScrolling=!0,this.isActive=!0},j.prototype.updateScrollValues=function(){var a,b;a=this.content,this.maxScrollTop=a.scrollHeight-a.clientHeight,this.prevScrollTop=this.contentScrollTop||0,this.contentScrollTop=a.scrollTop,b=this.contentScrollTop>this.previousPosition?"down":this.contentScrollTop<this.previousPosition?"up":"same",this.previousPosition=this.contentScrollTop,"same"!==b&&this.$el.trigger("update",{position:this.contentScrollTop,maximum:this.maxScrollTop,direction:b}),this.iOSNativeScrolling||(this.maxSliderTop=this.paneHeight-this.sliderHeight,this.sliderTop=0===this.maxScrollTop?0:this.contentScrollTop*this.maxSliderTop/this.maxScrollTop)},j.prototype.setOnScrollStyles=function(){var a;B?(a={},a[E]="translate(0, "+this.sliderTop+"px)"):a={top:this.sliderTop},D?(y&&this.scrollRAF&&y(this.scrollRAF),this.scrollRAF=D(function(b){return function(){return b.scrollRAF=null,b.slider.css(a)}}(this))):this.slider.css(a)},j.prototype.createEvents=function(){this.events={down:function(a){return function(b){return a.isBeingDragged=!0,a.offsetY=b.pageY-a.slider.offset().top,a.slider.is(b.target)||(a.offsetY=0),a.pane.addClass("active"),a.doc.bind(n,a.events[h]).bind(o,a.events[w]),a.body.bind(m,a.events[i]),!1}}(this),drag:function(a){return function(b){return a.sliderY=b.pageY-a.$el.offset().top-a.paneTop-(a.offsetY||.5*a.sliderHeight),a.scroll(),a.contentScrollTop>=a.maxScrollTop&&a.prevScrollTop!==a.maxScrollTop?a.$el.trigger("scrollend"):0===a.contentScrollTop&&0!==a.prevScrollTop&&a.$el.trigger("scrolltop"),!1}}(this),up:function(a){return function(b){return a.isBeingDragged=!1,a.pane.removeClass("active"),a.doc.unbind(n,a.events[h]).unbind(o,a.events[w]),a.body.unbind(m,a.events[i]),!1}}(this),resize:function(a){return function(b){a.reset()}}(this),panedown:function(a){return function(b){return a.sliderY=(b.offsetY||b.originalEvent.layerY)-.5*a.sliderHeight,a.scroll(),a.events.down(b),!1}}(this),scroll:function(a){return function(b){a.updateScrollValues(),a.isBeingDragged||(a.iOSNativeScrolling||(a.sliderY=a.sliderTop,a.setOnScrollStyles()),null!=b&&(a.contentScrollTop>=a.maxScrollTop?(a.options.preventPageScrolling&&a.preventScrolling(b,g),a.prevScrollTop!==a.maxScrollTop&&a.$el.trigger("scrollend")):0===a.contentScrollTop&&(a.options.preventPageScrolling&&a.preventScrolling(b,w),0!==a.prevScrollTop&&a.$el.trigger("scrolltop"))))}}(this),wheel:function(a){return function(b){var c;if(null!=b)return c=b.delta||b.wheelDelta||b.originalEvent&&b.originalEvent.wheelDelta||-b.detail||b.originalEvent&&-b.originalEvent.detail,c&&(a.sliderY+=-c/3),a.scroll(),!1}}(this),enter:function(a){return function(b){var c;if(a.isBeingDragged)return 1!==(b.buttons||b.which)?(c=a.events)[w].apply(c,arguments):void 0}}(this)}},j.prototype.addEvents=function(){var a;this.removeEvents(),a=this.events,this.options.disableResize||this.win.bind(s,a[s]),this.iOSNativeScrolling||(this.slider.bind(l,a[g]),this.pane.bind(l,a[r]).bind(""+p+" "+f,a[x])),this.$content.bind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.removeEvents=function(){var a;a=this.events,this.win.unbind(s,a[s]),this.iOSNativeScrolling||(this.slider.unbind(),this.pane.unbind()),this.$content.unbind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.generate=function(){var a,c,d,f,g,h,i;return f=this.options,h=f.paneClass,i=f.sliderClass,a=f.contentClass,(g=this.$el.children("."+h)).length||g.children("."+i).length||this.$el.append('<div class="'+h+'"><div class="'+i+'" /></div>'),this.pane=this.$el.children("."+h),this.slider=this.pane.find("."+i),0===e&&C()?(d=b.getComputedStyle(this.content,null).getPropertyValue("padding-right").replace(/[^0-9.]+/g,""),c={right:-14,paddingRight:+d+14}):e&&(c={right:-e},this.$el.addClass("has-scrollbar")),null!=c&&this.$content.css(c),this},j.prototype.restore=function(){this.stopped=!1,this.iOSNativeScrolling||this.pane.show(),this.addEvents()},j.prototype.reset=function(){var a,b,c,f,g,h,i,j,k,l,m,n;return this.iOSNativeScrolling?void(this.contentHeight=this.content.scrollHeight):(this.$el.find("."+this.options.paneClass).length||this.generate().stop(),this.stopped&&this.restore(),a=this.content,f=a.style,g=f.overflowY,d&&this.$content.css({height:this.$content.height()}),b=a.scrollHeight+e,l=parseInt(this.$el.css("max-height"),10),l>0&&(this.$el.height(""),this.$el.height(a.scrollHeight>l?l:a.scrollHeight)),i=this.pane.outerHeight(!1),k=parseInt(this.pane.css("top"),10),h=parseInt(this.pane.css("bottom"),10),j=i+k+h,n=Math.round(j/b*i),n<this.options.sliderMinHeight?n=this.options.sliderMinHeight:null!=this.options.sliderMaxHeight&&n>this.options.sliderMaxHeight&&(n=this.options.sliderMaxHeight),g===t&&f.overflowX!==t&&(n+=e),this.maxSliderTop=j-n,this.contentHeight=b,this.paneHeight=i,this.paneOuterHeight=j,this.sliderHeight=n,this.paneTop=k,this.slider.height(n),this.events.scroll(),this.pane.show(),this.isActive=!0,a.scrollHeight===a.clientHeight||this.pane.outerHeight(!0)>=a.scrollHeight&&g!==t?(this.pane.hide(),this.isActive=!1):this.el.clientHeight===a.scrollHeight&&g===t?this.slider.hide():this.slider.show(),this.pane.css({opacity:this.options.alwaysVisible?1:"",visibility:this.options.alwaysVisible?"visible":""}),c=this.$content.css("position"),("static"===c||"relative"===c)&&(m=parseInt(this.$content.css("right"),10),m&&this.$content.css({right:"",marginRight:m})),this)},j.prototype.scroll=function(){return this.isActive?(this.sliderY=Math.max(0,this.sliderY),this.sliderY=Math.min(this.maxSliderTop,this.sliderY),this.$content.scrollTop(this.maxScrollTop*this.sliderY/this.maxSliderTop),this.iOSNativeScrolling||(this.updateScrollValues(),this.setOnScrollStyles()),this):void 0},j.prototype.scrollBottom=function(a){return this.isActive?(this.$content.scrollTop(this.contentHeight-this.$content.height()-a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTop=function(a){return this.isActive?(this.$content.scrollTop(+a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTo=function(a){return this.isActive?(this.scrollTop(this.$el.find(a).get(0).offsetTop),this):void 0},j.prototype.stop=function(){return y&&this.scrollRAF&&(y(this.scrollRAF),this.scrollRAF=null),this.stopped=!0,this.removeEvents(),this.iOSNativeScrolling||this.pane.hide(),this},j.prototype.destroy=function(){return this.stopped||this.stop(),!this.iOSNativeScrolling&&this.pane.length&&this.pane.remove(),d&&this.$content.height(""),this.$content.removeAttr("tabindex"),this.$el.hasClass("has-scrollbar")&&(this.$el.removeClass("has-scrollbar"),this.$content.css({right:""})),this},j.prototype.flash=function(){return!this.iOSNativeScrolling&&this.isActive?(this.reset(),this.pane.addClass("flashed"),setTimeout(function(a){return function(){a.pane.removeClass("flashed")}}(this),this.options.flashDelay),this):void 0},j}(),a.fn.nanoScroller=function(b){return this.each(function(){var c,d;if((d=this.nanoscroller)||(c=a.extend({},z,b),this.nanoscroller=d=new q(this,c)),b&&"object"==typeof b){if(a.extend(d.options,b),null!=b.scrollBottom)return d.scrollBottom(b.scrollBottom);if(null!=b.scrollTop)return d.scrollTop(b.scrollTop);if(b.scrollTo)return d.scrollTo(b.scrollTo);if("bottom"===b.scroll)return d.scrollBottom(0);if("top"===b.scroll)return d.scrollTop(0);if(b.scroll&&b.scroll instanceof a)return d.scrollTo(b.scroll);if(b.stop)return d.stop();if(b.destroy)return d.destroy();if(b.flash)return d.flash()}return d.reset()})},a.fn.nanoScroller.Constructor=q});




!function ($) {
    "use strict";

    window.nifty = {
        'container'         : $('#container'),
        'contentContainer'  : $('#content-container'),
        'navbar'            : $('#navbar'),
        'mainNav'           : $('#mainnav-container'),
        'aside'             : $('#aside-container'),
        'footer'            : $('#footer'),
        'scrollTop'         : $('#scroll-top'),

        'window'            : $(window),
        'body'              : $('body'),
        'bodyHtml'          : $('body, html'),
        'document'          : $(document),
        'screenSize'        : '', // return value xs, sm, md, lg
        'isMobile'          : function(){
                return ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
        }(),
        'randomInt'         : function(min,max){
            return Math.floor(Math.random()*(max-min+1)+min);
        },
        'transition'          : function(){
            var thisBody = document.body || document.documentElement,
            thisStyle = thisBody.style,
            support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined;
            return support
        }()
    };

    nifty.document.ready(function(){
        nifty.document.trigger('nifty.ready');
    })

    nifty.document.on('nifty.ready', function(){
        //Activate the Bootstrap tooltips
        var tooltip = $('.add-tooltip');
        if (tooltip.length)tooltip.tooltip();

        var popover = $('.add-popover');
        if (popover.length)popover.popover();


        // STYLEABLE SCROLLBARS
        // =================================================================
        // Require nanoScroller
        // http://jamesflorentino.github.io/nanoScrollerJS/
        // =================================================================
        var nano = $('.nano');
        if(nano.length) nano.nanoScroller({
            preventPageScrolling: true
        });

        // Update nancoscroller
        $('#navbar-container .navbar-top-links').on('shown.bs.dropdown', '.dropdown', function () {
            $(this).find('.nano').nanoScroller({preventPageScrolling: true});
        });


        nifty.body.addClass('nifty-ready');
    });


}(jQuery);

!function ($) {
    "use strict";

    var pageHolder, floatContainer = {}, notyContainer, addNew = false;
    $.niftyNoty = function(options){
        var defaults = {
            type        : 'primary',
            // DESC     : Specify style for the alerts.
            // VALUE    : primary || info || success || warning || danger || mint || purple || pink ||  dark
            // TYPE     : String


            icon        : '',
            // DESC     : Icon class names
            // VALUE    : (Icon Class Name)
            // TYPE     : String


            title       : '',
            // VALUE    : (The title of the alert)
            // TYPE     : String

            message     : '',
            // VALUE    : (Message of the alert.)
            // TYPE     : String


            closeBtn    : true,
            // VALUE    : Show or hide the close button.
            // TYPE     : Boolean



            container   : 'page',
            // DESC     : This option is particularly useful in that it allows you to position the notification.
            // VALUE    : page || floating ||  "specified target name"
            // TYPE     : STRING


            floating    : {
                position    : 'top-right',
                // Floating position.
                // Currently only supports "top-right". We will make further development for the next version.


                animationIn : 'jellyIn',
                // Please use the animated class name from animate.css

                animationOut: 'fadeOut'
                // Please use the animated class name from animate.css

            },

            html        : null,
            // Insert HTML into the notification.  If false, jQuery's text method will be used to insert content into the DOM.


            focus       : true,
            //Scroll to the notification


            timer       : 0,
            // DESC     : To enable the "auto close" alerts, please specify the time to show the alert before it closed.
            // VALUE    : Value is in milliseconds. (0 to disable the autoclose.)
            // TYPE     : Number


            //EVENTS / CALLBACK FUNCTIONS

            onShow      : function(){},
            // This event fires immediately when the show instance method is called.

            onShown     : function(){},
            // This event is fired when the modal has been made visible to the user (will wait for CSS transitions to complete).

            onHide      : function(){},
            // This event is fired immediately when the hide instance method has been called.

            onHidden    : function(){}
            // This event is fired when the notification has finished being hidden from the user (will wait for CSS transitions to complete).


        },
        opt = $.extend({},defaults, options ), el = $('<div class="alert-wrap"></div>'),
        iconTemplate = function(){
            var icon = '';
            if (options && options.icon) {
                icon = '<div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="'+ opt.icon +'"></i></span></div>';
            }
            return icon;
        },
        alertTimer,
        template = function(){
            var clsBtn = opt.closeBtn ? '<button class="close" type="button"><i class="fa fa-times-circle"></i></button>' : '';
            var defTemplate = '<div class="alert alert-'+ opt.type + '" role="alert">'+ clsBtn + '<div class="media">';
            if (!opt.html) {
                return defTemplate + iconTemplate() + '<div class="media-body"><h4 class="alert-title">'+ opt.title +'</h4><p class="alert-message">'+ opt.message +'</p></div></div>';
            }
            return defTemplate + opt.html +'</div></div>';
        }(),
        closeAlert = function(e){
            opt.onHide();
            if (opt.container === 'floating' && opt.floating.animationOut) {
                el.removeClass(opt.floating.animationIn).addClass(opt.floating.animationOut);
                if (!nifty.transition) {
                    opt.onHidden();
                    el.remove();
                }
            }

            el.removeClass('in').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(e){
                if (e.originalEvent.propertyName == "max-height") {
                    opt.onHidden();
                    el.remove();
                }
            });
            clearInterval(alertTimer);
            return null;
        },
        focusElement = function(pos){
            nifty.bodyHtml.animate({scrollTop: pos}, 300, function(){
                el.addClass('in');
            });
        },
        init = function(){
            opt.onShow();
            if (opt.container === 'page') {
                if (!pageHolder) {
                    pageHolder = $('<div id="page-alert"></div>');
                    nifty.contentContainer.prepend(pageHolder);
                };

                notyContainer = pageHolder;
                if (opt.focus) focusElement(0);

            }else if (opt.container === 'floating') {
                if (!floatContainer[opt.floating.position]) {
                    floatContainer[opt.floating.position] = $('<div id="floating-' + opt.floating.position + '" class="floating-container"></div>');
                    nifty.container.append(floatContainer[opt.floating.position]);
                }

                notyContainer = floatContainer[opt.floating.position];

                if (opt.floating.animationIn) el.addClass('in animated ' + opt.floating.animationIn );
                opt.focus = false;
            }else {
                var $ct =  $(opt.container);
                var $panelct = $ct.children('.panel-alert');
                var $panelhd = $ct.children('.panel-heading');

                if (!$ct.length) {
                    addNew = false;
                    return false;
                }


                if(!$panelct.length){
                    notyContainer = $('<div class="panel-alert"></div>');
                    if($panelhd.length){
                        $panelhd.after(notyContainer);
                    }else{
                        $ct.prepend(notyContainer)
                    }
                }else{
                    notyContainer = $panelct;
                }

                if (opt.focus) focusElement($ct.offset().top - 30);

            }
            addNew = true;
            return false;
        }();

        if (addNew) {
            notyContainer.append(el.html(template));
            el.find('[data-dismiss="noty"]').one('click', closeAlert);
            if(opt.closeBtn) el.find('.close').one('click', closeAlert);
            if (opt.timer > 0)alertTimer = setInterval(closeAlert, opt.timer);
            if (!opt.focus) var addIn = setInterval(function(){el.addClass('in');clearInterval(addIn);},200);
            el.one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function(e){
                if ((e.originalEvent.propertyName == "max-height" || e.type == "animationend") && addNew) {
                    opt.onShown();
                    addNew = false;
                }
            });
        }
    };

}(jQuery);



