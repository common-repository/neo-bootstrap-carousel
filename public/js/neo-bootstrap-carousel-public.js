/*!
 * NEO Bootstrap Carousl Gutenberg Block
 * 
 * Description: NEO Bootstrap Carousl Admin Gutenberg Block
 * Version: 1.0.0
 * Author: PixelsPress <support@pixelspress.com>
 *
 */

/*!
 * Plugin Name: NEO Bootstrap Carousl
 * Plugin URI: https://wordpress.org/plugins/neo-bootstrap-carousel/
 * Author: PixelsPress <support@pixelspress.com>, Mohsin Rafique
 * Author URI: https://pixelspress.com/
 * Description: A clean, simple & robust implementation of the Twitter Bootstrap Carousel in WordPress site in elegant way.
 * Version: 1.4.2
 * License: GNU General Public License v2 or later
 * License URI: LICENSE
*/

/* -----------------------------------------------------------------------------
 * Bootstrap v3.4.1
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under the MIT license
 * ---------------------------------------------------------------------------*/
if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
+function ($) {
  'use strict';
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1) || (version[0] > 3)) {
    throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4')
  }
}(jQuery);

/* -----------------------------------------------------------------------------
 * Bootstrap: carousel.js v3.4.1
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under the MIT license
 * ---------------------------------------------------------------------------*/
+ function ($) {
    'use strict';

    // CAROUSEL CLASS DEFINITION
    // =========================

    var Carousel = function (element, options) {
        this.$element = $(element)
        this.$indicators = this.$element.find('.carousel-indicators')
        this.options = options
        this.paused = null
        this.sliding = null
        this.interval = null
        this.$active = null
        this.$items = null

        this.options.keyboard && this.$element.on('keydown.bs.carousel', $.proxy(this.keydown, this))

        this.options.pause == 'hover' && !('ontouchstart' in document.documentElement) && this.$element
            .on('mouseenter.bs.carousel', $.proxy(this.pause, this))
            .on('mouseleave.bs.carousel', $.proxy(this.cycle, this))
    }

    Carousel.VERSION = '3.4.1'

    Carousel.TRANSITION_DURATION = 600

    Carousel.DEFAULTS = {
        interval: 5000,
        pause: 'hover',
        wrap: true,
        keyboard: true
    }

    Carousel.prototype.keydown = function (e) {
        if (/input|textarea/i.test(e.target.tagName)) return
        switch (e.which) {
            case 37:
                this.prev();
                break
            case 39:
                this.next();
                break
            default:
                return
        }

        e.preventDefault()
    }

    Carousel.prototype.cycle = function (e) {
        e || (this.paused = false)

        this.interval && clearInterval(this.interval)

        this.options.interval &&
            !this.paused &&
            (this.interval = setInterval($.proxy(this.next, this), this.options.interval))

        return this
    }

    Carousel.prototype.getItemIndex = function (item) {
        this.$items = item.parent().children('.item')
        return this.$items.index(item || this.$active)
    }

    Carousel.prototype.getItemForDirection = function (direction, active) {
        var activeIndex = this.getItemIndex(active)
        var willWrap = (direction == 'prev' && activeIndex === 0) ||
            (direction == 'next' && activeIndex == (this.$items.length - 1))
        if (willWrap && !this.options.wrap) return active
        var delta = direction == 'prev' ? -1 : 1
        var itemIndex = (activeIndex + delta) % this.$items.length
        return this.$items.eq(itemIndex)
    }

    Carousel.prototype.to = function (pos) {
        var that = this
        var activeIndex = this.getItemIndex(this.$active = this.$element.find('.item.active'))

        if (pos > (this.$items.length - 1) || pos < 0) return

        if (this.sliding) return this.$element.one('slid.bs.carousel', function () {
            that.to(pos)
        }) // yes, "slid"
        if (activeIndex == pos) return this.pause().cycle()

        return this.slide(pos > activeIndex ? 'next' : 'prev', this.$items.eq(pos))
    }

    Carousel.prototype.pause = function (e) {
        e || (this.paused = true)

        if (this.$element.find('.next, .prev').length && $.support.transition) {
            this.$element.trigger($.support.transition.end)
            this.cycle(true)
        }

        this.interval = clearInterval(this.interval)

        return this
    }

    Carousel.prototype.next = function () {
        if (this.sliding) return
        return this.slide('next')
    }

    Carousel.prototype.prev = function () {
        if (this.sliding) return
        return this.slide('prev')
    }

    Carousel.prototype.slide = function (type, next) {
        var $active = this.$element.find('.item.active')
        var $next = next || this.getItemForDirection(type, $active)
        var isCycling = this.interval
        var direction = type == 'next' ? 'left' : 'right'
        var that = this

        if ($next.hasClass('active')) return (this.sliding = false)

        var relatedTarget = $next[0]
        var slideEvent = $.Event('slide.bs.carousel', {
            relatedTarget: relatedTarget,
            direction: direction
        })
        this.$element.trigger(slideEvent)
        if (slideEvent.isDefaultPrevented()) return

        this.sliding = true

        isCycling && this.pause()

        if (this.$indicators.length) {
            this.$indicators.find('.active').removeClass('active')
            var $nextIndicator = $(this.$indicators.children()[this.getItemIndex($next)])
            $nextIndicator && $nextIndicator.addClass('active')
        }

        var slidEvent = $.Event('slid.bs.carousel', {
            relatedTarget: relatedTarget,
            direction: direction
        }) // yes, "slid"
        if ($.support.transition && this.$element.hasClass('slide')) {
            $next.addClass(type)
            if (typeof $next === 'object' && $next.length) {
                $next[0].offsetWidth // force reflow
            }
            $active.addClass(direction)
            $next.addClass(direction)
            $active
                .one('bsTransitionEnd', function () {
                    $next.removeClass([type, direction].join(' ')).addClass('active')
                    $active.removeClass(['active', direction].join(' '))
                    that.sliding = false
                    setTimeout(function () {
                        that.$element.trigger(slidEvent)
                    }, 0)
                })
                .emulateTransitionEnd(Carousel.TRANSITION_DURATION)
        } else {
            $active.removeClass('active')
            $next.addClass('active')
            this.sliding = false
            this.$element.trigger(slidEvent)
        }

        isCycling && this.cycle()

        return this
    }


    // CAROUSEL PLUGIN DEFINITION
    // ==========================

    function Plugin(option) {
        return this.each(function () {
            var $this = $(this)
            var data = $this.data('bs.carousel')
            var options = $.extend({}, Carousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
            var action = typeof option == 'string' ? option : options.slide

            if (!data) $this.data('bs.carousel', (data = new Carousel(this, options)))
            if (typeof option == 'number') data.to(option)
            else if (action) data[action]()
            else if (options.interval) data.pause().cycle()
        })
    }

    var old = $.fn.carousel

    $.fn.carousel = Plugin
    $.fn.carousel.Constructor = Carousel


    // CAROUSEL NO CONFLICT
    // ====================

    $.fn.carousel.noConflict = function () {
        $.fn.carousel = old
        return this
    }


    // CAROUSEL DATA-API
    // =================

    var clickHandler = function (e) {
        var $this = $(this)
        var href = $this.attr('href')
        if (href) {
            href = href.replace(/.*(?=#[^\s]+$)/, '') // strip for ie7
        }

        var target = $this.attr('data-target') || href
        var $target = $(document).find(target)

        if (!$target.hasClass('carousel')) return

        var options = $.extend({}, $target.data(), $this.data())
        var slideIndex = $this.attr('data-slide-to')
        if (slideIndex) options.interval = false

        Plugin.call($target, options)

        if (slideIndex) {
            $target.data('bs.carousel').to(slideIndex)
        }

        e.preventDefault()
    }

    $(document)
        .on('click.bs.carousel.data-api', '[data-slide]', clickHandler)
        .on('click.bs.carousel.data-api', '[data-slide-to]', clickHandler)

    $(window).on('load', function () {
        $('[data-ride="carousel"]').each(function () {
            var $carousel = $(this)
            Plugin.call($carousel, $carousel.data())
        })
    })

}(jQuery);



/*! 
 * bootstrap-touch-carousel v0.8.0
 * https://github.com/ixisio/bootstrap-touch-carousel.git 
 * 
 * Copyright (c) 2014 (ixisio) Andreas Klein
 * Licensed under the MIT license
 * 
 * 
 * Including Hammer.js@1.0.6dev, http://eightmedia.github.com/hammer.js 
 */ 
+function(a){"use strict";function b(a,b){var c=document.createElement("div").style;for(var d in a)if(void 0!==c[a[d]])return"pfx"==b?a[d]:!0;return!1}function c(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]}}function d(){var a=["transformProperty","WebkitTransform","MozTransform","msTransform"];return!!b(a)}function e(){return"WebKitCSSMatrix"in window&&"m11"in new WebKitCSSMatrix}if(!("ontouchstart"in window||navigator.msMaxTouchPoints))return!1;a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one(a.support.transition.end,function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=c(),a.support.csstransforms=d(),a.support.csstransforms3d=e()});var f="touch-carousel",g=function(b,c){return this.$element=a(b),this.$itemsWrapper=this.$element.find(".carousel-inner"),this.$items=this.$element.find(".item"),this.$indicators=this.$element.find(".carousel-indicators"),this.pane_width=this.pane_count=this.current_pane=0,this.onGesture=!1,this.options=c,this._setPaneDimensions(),this.$items.length<=1?this.disable():(this._regTouchGestures(),void a(window).on("orientationchange resize",a.proxy(this._setPaneDimensions,this)))};g.DEFAULTS={interval:!1,toughness:.25},g.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},g.prototype.to=function(a){return a>this.$items.length-1||0>a?void 0:this._showPane(a)},g.prototype.pause=function(a){return a||(this.paused=!0),clearInterval(this.interval),this.interval=null,this},g.prototype._regTouchGestures=function(){this.$itemsWrapper.add(this.$indicators).hammer({drag_lock_to_axis:!0,preventDefault:!0}).on("release dragleft dragright swipeleft swiperight",a.proxy(this._handleGestures,this))},g.prototype._setPaneDimensions=function(){this.pane_width=this.$element.width(),this.pane_count=this.$items.length,this.$itemsWrapper.width(this.pane_width*this.pane_count),this.$items.width(this.pane_width)},g.prototype._showPane=function(a){this.$items.eq(this.current_pane).toggleClass("active"),a>=this.pane_count&&this.pause(),a=Math.max(0,Math.min(a,this.pane_count-1));this.$items.eq(a).toggleClass("active");this.current_pane=a;var b=-(100/this.pane_count*this.current_pane);return this._setContainerOffset(b,!0,a),this},g.prototype._setContainerOffset=function(b,c,d){var e=this;if(this.$itemsWrapper.removeClass("animate"),c&&this.$itemsWrapper.addClass("animate"),a.support.csstransforms3d)this.onGesture=!0,this.$itemsWrapper.css("transform","translate3d("+b+"%,0,0) scale3d(1,1,1)");else if(a.support.csstransforms)this.onGesture=!0,this.$itemsWrapper.css("transform","translate("+b+"%,0)");else{var f=this.pane_width*this.pane_count/100*b;this.$itemsWrapper.css("left",f+"px")}a.support.transition?this.$itemsWrapper.one(a.support.transition.end,function(){e.$itemsWrapper.removeClass("animate"),e.onGesture=!1,e._updateIndicators(d)}):(this.$itemsWrapper.removeClass("animate"),this.onGesture=!1,this._updateIndicators(d))},g.prototype.next=function(){return this._showPane(this.current_pane+1)},g.prototype.prev=function(){return this._showPane(this.current_pane-1)},g.prototype._handleGestures=function(a){if(!this.sliding)switch(this.pause(),a.type){case"dragright":case"dragleft":var b=-(100/this.pane_count)*this.current_pane,c=100/this.pane_width*a.gesture.deltaX/this.pane_count;(0===this.current_pane&&a.gesture.direction==Hammer.DIRECTION_RIGHT||this.current_pane==this.pane_count-1&&a.gesture.direction==Hammer.DIRECTION_LEFT)&&(c*=this.options.toughness),this._setContainerOffset(c+b);break;case"swipeleft":this.next(),a.gesture.stopDetect();break;case"swiperight":this.prev(),a.gesture.stopDetect();break;case"release":Math.abs(a.gesture.deltaX)>this.pane_width/2?"right"==a.gesture.direction?this.prev():this.next():this._showPane(this.current_pane,!0)}},g.prototype.disable=function(){return this.$indicators.hide(),this.$element.removeData(f),!1},g.prototype._updateIndicators=function(a){return this.$indicators.length&&(this.$indicators.find(".active").removeClass("active"),this.$indicators.children().eq(a).addClass("active")),this.$element.trigger("slid.bs.carousel"),this};var h=a.fn.carousel;a.fn.carousel=function(b){return this.each(function(){var c=a(this),d=c.data(f),e=a.extend({},g.DEFAULTS,c.data(),"object"==typeof b&&b),h="string"==typeof b?b:e.slide;d||c.data(f,d=new g(this,e)).addClass(f),"number"==typeof b?d.to(b):h?d[h]():e.interval&&d.pause().cycle()})},a.fn.carousel.Constructor=g,a.fn.carousel.noConflict=function(){return a.fn.carousel=h,this},a(document).off("click.bs.carousel").on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",function(b){var c,d=a(this),e=a(d.attr("data-target")||(c=d.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"")),g=a.extend({},e.data(),d.data()),h=d.attr("data-slide-to");h&&(g.interval=!1),e.carousel(g),(h=d.attr("data-slide-to"))&&e.data(f).to(h),b.preventDefault()})}(window.jQuery),function(a,b){"use strict";function c(){if(!d.READY){d.event.determineEventTypes();for(var a in d.gestures)d.gestures.hasOwnProperty(a)&&d.detection.register(d.gestures[a]);d.event.onTouch(d.DOCUMENT,d.EVENT_MOVE,d.detection.detect),d.event.onTouch(d.DOCUMENT,d.EVENT_END,d.detection.detect),d.READY=!0}}var d=function(a,b){return new d.Instance(a,b||{})};d.defaults={stop_browser_behavior:{userSelect:"none",touchAction:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}},d.HAS_POINTEREVENTS=a.navigator.pointerEnabled||a.navigator.msPointerEnabled,d.HAS_TOUCHEVENTS="ontouchstart"in a,d.MOBILE_REGEX=/mobile|tablet|ip(ad|hone|od)|android|silk/i,d.NO_MOUSEEVENTS=d.HAS_TOUCHEVENTS&&a.navigator.userAgent.match(d.MOBILE_REGEX),d.EVENT_TYPES={},d.DIRECTION_DOWN="down",d.DIRECTION_LEFT="left",d.DIRECTION_UP="up",d.DIRECTION_RIGHT="right",d.POINTER_MOUSE="mouse",d.POINTER_TOUCH="touch",d.POINTER_PEN="pen",d.EVENT_START="start",d.EVENT_MOVE="move",d.EVENT_END="end",d.DOCUMENT=a.document,d.plugins={},d.READY=!1,d.Instance=function(a,b){var e=this;return c(),this.element=a,this.enabled=!0,this.options=d.utils.extend(d.utils.extend({},d.defaults),b||{}),this.options.stop_browser_behavior&&d.utils.stopDefaultBrowserBehavior(this.element,this.options.stop_browser_behavior),d.event.onTouch(a,d.EVENT_START,function(a){e.enabled&&d.detection.startDetect(e,a)}),this},d.Instance.prototype={on:function(a,b){for(var c=a.split(" "),d=0;d<c.length;d++)this.element.addEventListener(c[d],b,!1);return this},off:function(a,b){for(var c=a.split(" "),d=0;d<c.length;d++)this.element.removeEventListener(c[d],b,!1);return this},trigger:function(a,b){b||(b={});var c=d.DOCUMENT.createEvent("Event");c.initEvent(a,!0,!0),c.gesture=b;var e=this.element;return d.utils.hasParent(b.target,e)&&(e=b.target),e.dispatchEvent(c),this},enable:function(a){return this.enabled=a,this}};var e=null,f=!1,g=!1;d.event={bindDom:function(a,b,c){for(var d=b.split(" "),e=0;e<d.length;e++)a.addEventListener(d[e],c,!1)},onTouch:function(a,b,c){var h=this;this.bindDom(a,d.EVENT_TYPES[b],function(i){var j=i.type.toLowerCase();if(!j.match(/mouse/)||!g){j.match(/touch/)||j.match(/pointerdown/)||j.match(/mouse/)&&1===i.which?f=!0:j.match(/mouse/)&&1!==i.which&&(f=!1),j.match(/touch|pointer/)&&(g=!0);var k=0;f&&(d.HAS_POINTEREVENTS&&b!=d.EVENT_END?k=d.PointerEvent.updatePointer(b,i):j.match(/touch/)?k=i.touches.length:g||(k=j.match(/up/)?0:1),k>0&&b==d.EVENT_END?b=d.EVENT_MOVE:k||(b=d.EVENT_END),(k||null===e)&&(e=i),c.call(d.detection,h.collectEventData(a,b,h.getTouchList(e,b),i)),d.HAS_POINTEREVENTS&&b==d.EVENT_END&&(k=d.PointerEvent.updatePointer(b,i))),k||(e=null,f=!1,g=!1,d.PointerEvent.reset())}})},determineEventTypes:function(){var a;a=d.HAS_POINTEREVENTS?d.PointerEvent.getEvents():d.NO_MOUSEEVENTS?["touchstart","touchmove","touchend touchcancel"]:["touchstart mousedown","touchmove mousemove","touchend touchcancel mouseup"],d.EVENT_TYPES[d.EVENT_START]=a[0],d.EVENT_TYPES[d.EVENT_MOVE]=a[1],d.EVENT_TYPES[d.EVENT_END]=a[2]},getTouchList:function(a){return d.HAS_POINTEREVENTS?d.PointerEvent.getTouchList():a.touches?a.touches:(a.indentifier=1,[a])},collectEventData:function(a,b,c,e){var f=d.POINTER_TOUCH;return(e.type.match(/mouse/)||d.PointerEvent.matchType(d.POINTER_MOUSE,e))&&(f=d.POINTER_MOUSE),{center:d.utils.getCenter(c),timeStamp:(new Date).getTime(),target:e.target,touches:c,eventType:b,pointerType:f,srcEvent:e,preventDefault:function(){this.srcEvent.preventManipulation&&this.srcEvent.preventManipulation(),this.srcEvent.preventDefault&&this.srcEvent.preventDefault()},stopPropagation:function(){this.srcEvent.stopPropagation()},stopDetect:function(){return d.detection.stopDetect()}}}},d.PointerEvent={pointers:{},getTouchList:function(){var a=this,b=[];return Object.keys(a.pointers).sort().forEach(function(c){b.push(a.pointers[c])}),b},updatePointer:function(a,b){return a==d.EVENT_END?this.pointers={}:(b.identifier=b.pointerId,this.pointers[b.pointerId]=b),Object.keys(this.pointers).length},matchType:function(a,b){if(!b.pointerType)return!1;var c={};return c[d.POINTER_MOUSE]=b.pointerType==b.MSPOINTER_TYPE_MOUSE||b.pointerType==d.POINTER_MOUSE,c[d.POINTER_TOUCH]=b.pointerType==b.MSPOINTER_TYPE_TOUCH||b.pointerType==d.POINTER_TOUCH,c[d.POINTER_PEN]=b.pointerType==b.MSPOINTER_TYPE_PEN||b.pointerType==d.POINTER_PEN,c[a]},getEvents:function(){return["pointerdown MSPointerDown","pointermove MSPointerMove","pointerup pointercancel MSPointerUp MSPointerCancel"]},reset:function(){this.pointers={}}},d.utils={extend:function(a,c,d){for(var e in c)a[e]!==b&&d||(a[e]=c[e]);return a},hasParent:function(a,b){for(;a;){if(a==b)return!0;a=a.parentNode}return!1},getCenter:function(a){for(var b=[],c=[],d=0,e=a.length;e>d;d++)b.push(a[d].pageX),c.push(a[d].pageY);return{pageX:(Math.min.apply(Math,b)+Math.max.apply(Math,b))/2,pageY:(Math.min.apply(Math,c)+Math.max.apply(Math,c))/2}},getVelocity:function(a,b,c){return{x:Math.abs(b/a)||0,y:Math.abs(c/a)||0}},getAngle:function(a,b){var c=b.pageY-a.pageY,d=b.pageX-a.pageX;return 180*Math.atan2(c,d)/Math.PI},getDirection:function(a,b){var c=Math.abs(a.pageX-b.pageX),e=Math.abs(a.pageY-b.pageY);return c>=e?a.pageX-b.pageX>0?d.DIRECTION_LEFT:d.DIRECTION_RIGHT:a.pageY-b.pageY>0?d.DIRECTION_UP:d.DIRECTION_DOWN},getDistance:function(a,b){var c=b.pageX-a.pageX,d=b.pageY-a.pageY;return Math.sqrt(c*c+d*d)},getScale:function(a,b){return a.length>=2&&b.length>=2?this.getDistance(b[0],b[1])/this.getDistance(a[0],a[1]):1},getRotation:function(a,b){return a.length>=2&&b.length>=2?this.getAngle(b[1],b[0])-this.getAngle(a[1],a[0]):0},isVertical:function(a){return a==d.DIRECTION_UP||a==d.DIRECTION_DOWN},stopDefaultBrowserBehavior:function(a,b){var c,d=["webkit","khtml","moz","Moz","ms","o",""];if(b&&a.style){for(var e=0;e<d.length;e++)for(var f in b)b.hasOwnProperty(f)&&(c=f,d[e]&&(c=d[e]+c.substring(0,1).toUpperCase()+c.substring(1)),a.style[c]=b[f]);"none"==b.userSelect&&(a.onselectstart=function(){return!1}),"none"==b.userDrag&&(a.ondragstart=function(){return!1})}}},d.detection={gestures:[],current:null,previous:null,stopped:!1,startDetect:function(a,b){this.current||(this.stopped=!1,this.current={inst:a,startEvent:d.utils.extend({},b),lastEvent:!1,name:""},this.detect(b))},detect:function(a){if(this.current&&!this.stopped){a=this.extendEventData(a);for(var b=this.current.inst.options,c=0,e=this.gestures.length;e>c;c++){var f=this.gestures[c];if(!this.stopped&&b[f.name]!==!1&&f.handler.call(f,a,this.current.inst)===!1){this.stopDetect();break}}return this.current&&(this.current.lastEvent=a),a.eventType==d.EVENT_END&&!a.touches.length-1&&this.stopDetect(),a}},stopDetect:function(){this.previous=d.utils.extend({},this.current),this.current=null,this.stopped=!0},extendEventData:function(a){var b=this.current.startEvent;if(b&&(a.touches.length!=b.touches.length||a.touches===b.touches)){b.touches=[];for(var c=0,e=a.touches.length;e>c;c++)b.touches.push(d.utils.extend({},a.touches[c]))}var f=a.timeStamp-b.timeStamp,g=a.center.pageX-b.center.pageX,h=a.center.pageY-b.center.pageY,i=d.utils.getVelocity(f,g,h);return d.utils.extend(a,{deltaTime:f,deltaX:g,deltaY:h,velocityX:i.x,velocityY:i.y,distance:d.utils.getDistance(b.center,a.center),angle:d.utils.getAngle(b.center,a.center),interimAngle:this.current.lastEvent&&d.utils.getAngle(this.current.lastEvent.center,a.center),direction:d.utils.getDirection(b.center,a.center),interimDirection:this.current.lastEvent&&d.utils.getDirection(this.current.lastEvent.center,a.center),scale:d.utils.getScale(b.touches,a.touches),rotation:d.utils.getRotation(b.touches,a.touches),startEvent:b}),a},register:function(a){var c=a.defaults||{};return c[a.name]===b&&(c[a.name]=!0),d.utils.extend(d.defaults,c,!0),a.index=a.index||1e3,this.gestures.push(a),this.gestures.sort(function(a,b){return a.index<b.index?-1:a.index>b.index?1:0}),this.gestures}},d.gestures=d.gestures||{},d.gestures.Hold={name:"hold",index:10,defaults:{hold_timeout:500,hold_threshold:1},timer:null,handler:function(a,b){switch(a.eventType){case d.EVENT_START:clearTimeout(this.timer),d.detection.current.name=this.name,this.timer=setTimeout(function(){"hold"==d.detection.current.name&&b.trigger("hold",a)},b.options.hold_timeout);break;case d.EVENT_MOVE:a.distance>b.options.hold_threshold&&clearTimeout(this.timer);break;case d.EVENT_END:clearTimeout(this.timer)}}},d.gestures.Tap={name:"tap",index:100,defaults:{tap_max_touchtime:250,tap_max_distance:10,tap_always:!0,doubletap_distance:20,doubletap_interval:300},handler:function(a,b){if(a.eventType==d.EVENT_END&&"touchcancel"!=a.srcEvent.type){var c=d.detection.previous,e=!1;if(a.deltaTime>b.options.tap_max_touchtime||a.distance>b.options.tap_max_distance)return;c&&"tap"==c.name&&a.timeStamp-c.lastEvent.timeStamp<b.options.doubletap_interval&&a.distance<b.options.doubletap_distance&&(b.trigger("doubletap",a),e=!0),(!e||b.options.tap_always)&&(d.detection.current.name="tap",b.trigger(d.detection.current.name,a))}}},d.gestures.Swipe={name:"swipe",index:40,defaults:{swipe_max_touches:1,swipe_velocity:.7},handler:function(a,b){if(a.eventType==d.EVENT_END){if(b.options.swipe_max_touches>0&&a.touches.length>b.options.swipe_max_touches)return;(a.velocityX>b.options.swipe_velocity||a.velocityY>b.options.swipe_velocity)&&(b.trigger(this.name,a),b.trigger(this.name+a.direction,a))}}},d.gestures.Drag={name:"drag",index:50,defaults:{drag_min_distance:10,correct_for_drag_min_distance:!0,drag_max_touches:1,drag_block_horizontal:!1,drag_block_vertical:!1,drag_lock_to_axis:!1,drag_lock_min_distance:25},triggered:!1,handler:function(a,b){if(d.detection.current.name!=this.name&&this.triggered)return b.trigger(this.name+"end",a),void(this.triggered=!1);if(!(b.options.drag_max_touches>0&&a.touches.length>b.options.drag_max_touches))switch(a.eventType){case d.EVENT_START:this.triggered=!1;break;case d.EVENT_MOVE:if(a.distance<b.options.drag_min_distance&&d.detection.current.name!=this.name)return;if(d.detection.current.name!=this.name&&(d.detection.current.name=this.name,b.options.correct_for_drag_min_distance)){var c=Math.abs(b.options.drag_min_distance/a.distance);d.detection.current.startEvent.center.pageX+=a.deltaX*c,d.detection.current.startEvent.center.pageY+=a.deltaY*c,a=d.detection.extendEventData(a)}(d.detection.current.lastEvent.drag_locked_to_axis||b.options.drag_lock_to_axis&&b.options.drag_lock_min_distance<=a.distance)&&(a.drag_locked_to_axis=!0);var e=d.detection.current.lastEvent.direction;a.drag_locked_to_axis&&e!==a.direction&&(a.direction=d.utils.isVertical(e)?a.deltaY<0?d.DIRECTION_UP:d.DIRECTION_DOWN:a.deltaX<0?d.DIRECTION_LEFT:d.DIRECTION_RIGHT),this.triggered||(b.trigger(this.name+"start",a),this.triggered=!0),b.trigger(this.name,a),b.trigger(this.name+a.direction,a),(b.options.drag_block_vertical&&d.utils.isVertical(a.direction)||b.options.drag_block_horizontal&&!d.utils.isVertical(a.direction))&&a.preventDefault();break;case d.EVENT_END:this.triggered&&b.trigger(this.name+"end",a),this.triggered=!1}}},d.gestures.Transform={name:"transform",index:45,defaults:{transform_min_scale:.01,transform_min_rotation:1,transform_always_block:!1},triggered:!1,handler:function(a,b){if(d.detection.current.name!=this.name&&this.triggered)return b.trigger(this.name+"end",a),void(this.triggered=!1);if(!(a.touches.length<2))switch(b.options.transform_always_block&&a.preventDefault(),a.eventType){case d.EVENT_START:this.triggered=!1;break;case d.EVENT_MOVE:var c=Math.abs(1-a.scale),e=Math.abs(a.rotation);if(c<b.options.transform_min_scale&&e<b.options.transform_min_rotation)return;d.detection.current.name=this.name,this.triggered||(b.trigger(this.name+"start",a),this.triggered=!0),b.trigger(this.name,a),e>b.options.transform_min_rotation&&b.trigger("rotate",a),c>b.options.transform_min_scale&&(b.trigger("pinch",a),b.trigger("pinch"+(a.scale<1?"in":"out"),a));break;case d.EVENT_END:this.triggered&&b.trigger(this.name+"end",a),this.triggered=!1}}},d.gestures.Touch={name:"touch",index:-1/0,defaults:{prevent_default:!1,prevent_mouseevents:!1},handler:function(a,b){return b.options.prevent_mouseevents&&a.pointerType==d.POINTER_MOUSE?void a.stopDetect():(b.options.prevent_default&&a.preventDefault(),void(a.eventType==d.EVENT_START&&b.trigger(this.name,a)))}},d.gestures.Release={name:"release",index:1/0,handler:function(a,b){a.eventType==d.EVENT_END&&b.trigger(this.name,a)}},"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return d}):"object"==typeof module&&"object"==typeof module.exports?module.exports=d:a.Hammer=d}(this),function(a){"use strict";var b=function(b,c){return c===a?b:(b.event.bindDom=function(b,d,e){c(b).on(d,function(b){var c=b.originalEvent||b;c.pageX===a&&(c.pageX=b.pageX,c.pageY=b.pageY),c.target||(c.target=b.target),c.which===a&&(c.which=c.button),c.preventDefault||(c.preventDefault=b.preventDefault),c.stopPropagation||(c.stopPropagation=b.stopPropagation),e.call(this,c)})},b.Instance.prototype.on=function(a,b){return c(this.element).on(a,b)},b.Instance.prototype.off=function(a,b){return c(this.element).off(a,b)},b.Instance.prototype.trigger=function(a,b){var d=c(this.element);return d.has(b.target).length&&(d=c(b.target)),d.trigger({type:a,gesture:b})},c.fn.hammer=function(a){return this.each(function(){var d=c(this),e=d.data("hammer");e?e&&a&&b.utils.extend(e.options,a):d.data("hammer",new b(this,a||{}))})},b)};"function"==typeof define&&"object"==typeof define.amd&&define.amd?define("hammer-jquery",["hammer","jquery"],b):b(window.Hammer,window.jQuery||window.Zepto)}();