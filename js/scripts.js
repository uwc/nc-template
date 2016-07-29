!function(){var t=navigator.userAgent.toLowerCase().indexOf("webkit")>-1,e=navigator.userAgent.toLowerCase().indexOf("opera")>-1,n=navigator.userAgent.toLowerCase().indexOf("msie")>-1;(t||e||n)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e),t&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus()))},!1)}(),function(t,e){"function"==typeof define&&define.amd?define([],e(t)):"object"==typeof exports?module.exports=e(t):t.smoothScroll=e(t)}("undefined"!=typeof global?global:this.window||this.global,function(t){"use strict";var e,n,o,i,s,a={},r="querySelector"in document&&"addEventListener"in t,c={selector:"[data-scroll]",selectorHeader:"[data-scroll-header]",speed:500,easing:"easeInOutCubic",offset:0,updateURL:!0,callback:function(){}},l=function(){var t={},e=!1,n=0,o=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(e=arguments[0],n++);for(var i=function(n){for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e&&"[object Object]"===Object.prototype.toString.call(n[o])?t[o]=l(!0,t[o],n[o]):t[o]=n[o])};n<o;n++){var s=arguments[n];i(s)}return t},u=function(t){return Math.max(t.scrollHeight,t.offsetHeight,t.clientHeight)},h=function(t,e){var n,o,i=e.charAt(0),s="classList"in document.documentElement;for("["===i&&(e=e.substr(1,e.length-2),n=e.split("="),n.length>1&&(o=!0,n[1]=n[1].replace(/"/g,"").replace(/'/g,"")));t&&t!==document&&1===t.nodeType;t=t.parentNode){if("."===i)if(s){if(t.classList.contains(e.substr(1)))return t}else if(new RegExp("(^|\\s)"+e.substr(1)+"(\\s|$)").test(t.className))return t;if("#"===i&&t.id===e.substr(1))return t;if("["===i&&t.hasAttribute(n[0])){if(!o)return t;if(t.getAttribute(n[0])===n[1])return t}if(t.tagName.toLowerCase()===e)return t}return null};a.escapeCharacters=function(t){"#"===t.charAt(0)&&(t=t.substr(1));for(var e,n=String(t),o=n.length,i=-1,s="",a=n.charCodeAt(0);++i<o;){if(e=n.charCodeAt(i),0===e)throw new InvalidCharacterError("Invalid character: the input contains U+0000.");s+=e>=1&&e<=31||127==e||0===i&&e>=48&&e<=57||1===i&&e>=48&&e<=57&&45===a?"\\"+e.toString(16)+" ":e>=128||45===e||95===e||e>=48&&e<=57||e>=65&&e<=90||e>=97&&e<=122?n.charAt(i):"\\"+n.charAt(i)}return"#"+s};var d=function(t,e){var n;return"easeInQuad"===t&&(n=e*e),"easeOutQuad"===t&&(n=e*(2-e)),"easeInOutQuad"===t&&(n=e<.5?2*e*e:-1+(4-2*e)*e),"easeInCubic"===t&&(n=e*e*e),"easeOutCubic"===t&&(n=--e*e*e+1),"easeInOutCubic"===t&&(n=e<.5?4*e*e*e:(e-1)*(2*e-2)*(2*e-2)+1),"easeInQuart"===t&&(n=e*e*e*e),"easeOutQuart"===t&&(n=1- --e*e*e*e),"easeInOutQuart"===t&&(n=e<.5?8*e*e*e*e:1-8*--e*e*e*e),"easeInQuint"===t&&(n=e*e*e*e*e),"easeOutQuint"===t&&(n=1+--e*e*e*e*e),"easeInOutQuint"===t&&(n=e<.5?16*e*e*e*e*e:1+16*--e*e*e*e*e),n||e},f=function(t,e,n){var o=0;if(t.offsetParent)do o+=t.offsetTop,t=t.offsetParent;while(t);return o=o-e-n,o>=0?o:0},p=function(){return Math.max(t.document.body.scrollHeight,t.document.documentElement.scrollHeight,t.document.body.offsetHeight,t.document.documentElement.offsetHeight,t.document.body.clientHeight,t.document.documentElement.clientHeight)},m=function(t){return t&&"object"==typeof JSON&&"function"==typeof JSON.parse?JSON.parse(t):{}},g=function(e,n){t.history.pushState&&(n||"true"===n)&&"file:"!==t.location.protocol&&t.history.pushState(null,null,[t.location.protocol,"//",t.location.host,t.location.pathname,t.location.search,e].join(""))},v=function(t){return null===t?0:u(t)+t.offsetTop};a.animateScroll=function(n,a,r){var u=m(a?a.getAttribute("data-options"):null),h=l(e||c,r||{},u),y="[object Number]"===Object.prototype.toString.call(n),b=y?null:"#"===n?t.document.documentElement:t.document.querySelector(n);if(y||b){var w=t.pageYOffset;o||(o=t.document.querySelector(h.selectorHeader)),i||(i=v(o));var E,T,S=y?n:f(b,i,parseInt(h.offset,10)),H=S-w,L=p(),C=0;y||g(n,h.updateURL);var k=function(e,o,i){var s=t.pageYOffset;(e==o||s==o||t.innerHeight+s>=L)&&(clearInterval(i),y||b.focus(),h.callback(n,a))},N=function(){C+=16,E=C/parseInt(h.speed,10),E=E>1?1:E,T=w+H*d(h.easing,E),t.scrollTo(0,Math.floor(T)),k(T,S,s)},O=function(){clearInterval(s),s=setInterval(N,16)};0===t.pageYOffset&&t.scrollTo(0,0),O()}};var y=function(t){if(0===t.button&&!t.metaKey&&!t.ctrlKey){var n=h(t.target,e.selector);if(n&&"a"===n.tagName.toLowerCase()){t.preventDefault();var o=a.escapeCharacters(n.hash);a.animateScroll(o,n,e)}}},b=function(t){n||(n=setTimeout(function(){n=null,i=v(o)},66))};return a.destroy=function(){e&&(t.document.removeEventListener("click",y,!1),t.removeEventListener("resize",b,!1),e=null,n=null,o=null,i=null,s=null)},a.init=function(n){r&&(a.destroy(),e=l(c,n||{}),o=t.document.querySelector(e.selectorHeader),i=v(o),t.document.addEventListener("click",y,!1),o&&t.addEventListener("resize",b,!1))},a}),function(t,e,n){"use strict";var o=function(o,i){var s=!!e.getComputedStyle;s||(e.getComputedStyle=function(t){return this.el=t,this.getPropertyValue=function(e){var n=/(\-([a-z]){1})/g;return"float"===e&&(e="styleFloat"),n.test(e)&&(e=e.replace(n,function(){return arguments[2].toUpperCase()})),t.currentStyle[e]?t.currentStyle[e]:null},this});var a,r,c,l,u,h,d=function(t,e,n,o){if("addEventListener"in t)try{t.addEventListener(e,n,o)}catch(i){if("object"!=typeof n||!n.handleEvent)throw i;t.addEventListener(e,function(t){n.handleEvent.call(n,t)},o)}else"attachEvent"in t&&("object"==typeof n&&n.handleEvent?t.attachEvent("on"+e,function(){n.handleEvent.call(n)}):t.attachEvent("on"+e,n))},f=function(t,e,n,o){if("removeEventListener"in t)try{t.removeEventListener(e,n,o)}catch(i){if("object"!=typeof n||!n.handleEvent)throw i;t.removeEventListener(e,function(t){n.handleEvent.call(n,t)},o)}else"detachEvent"in t&&("object"==typeof n&&n.handleEvent?t.detachEvent("on"+e,function(){n.handleEvent.call(n)}):t.detachEvent("on"+e,n))},p=function(t){if(t.children.length<1)throw new Error("The Nav container has no containing elements");for(var e=[],n=0;n<t.children.length;n++)1===t.children[n].nodeType&&e.push(t.children[n]);return e},m=function(t,e){for(var n in e)t.setAttribute(n,e[n])},g=function(t,e){0!==t.className.indexOf(e)&&(t.className+=" "+e,t.className=t.className.replace(/(^\s*)|(\s*$)/g,""))},v=function(t,e){var n=new RegExp("(\\s|^)"+e+"(\\s|$)");t.className=t.className.replace(n," ").replace(/(^\s*)|(\s*$)/g,"")},y=function(t,e,n){for(var o=0;o<t.length;o++)e.call(n,o,t[o])},b=t.createElement("style"),w=t.documentElement,E=function(e,n){var o;this.options={animate:!0,transition:284,label:"Menu",insert:"before",customToggle:"",closeOnNavClick:!1,openPos:"relative",navClass:"nav-collapse",navActiveClass:"js-nav-active",jsClass:"js",init:function(){},open:function(){},close:function(){}};for(o in n)this.options[o]=n[o];if(g(w,this.options.jsClass),this.wrapperEl=e.replace("#",""),t.getElementById(this.wrapperEl))this.wrapper=t.getElementById(this.wrapperEl);else{if(!t.querySelector(this.wrapperEl))throw new Error("The nav element you are trying to select doesn't exist");this.wrapper=t.querySelector(this.wrapperEl)}this.wrapper.inner=p(this.wrapper),r=this.options,a=this.wrapper,this._init(this)};return E.prototype={destroy:function(){this._removeStyles(),v(a,"closed"),v(a,"opened"),v(a,r.navClass),v(a,r.navClass+"-"+this.index),v(w,r.navActiveClass),a.removeAttribute("style"),a.removeAttribute("aria-hidden"),f(e,"resize",this,!1),f(e,"focus",this,!1),f(t.body,"touchmove",this,!1),f(c,"touchstart",this,!1),f(c,"touchend",this,!1),f(c,"mouseup",this,!1),f(c,"keyup",this,!1),f(c,"click",this,!1),r.customToggle?c.removeAttribute("aria-hidden"):c.parentNode.removeChild(c)},toggle:function(){l===!0&&(h?this.close():this.open())},open:function(){h||(v(a,"closed"),g(a,"opened"),g(w,r.navActiveClass),g(c,"active"),a.style.position=r.openPos,m(a,{"aria-hidden":"false"}),h=!0,r.open())},close:function(){h&&(g(a,"closed"),v(a,"opened"),v(w,r.navActiveClass),v(c,"active"),m(a,{"aria-hidden":"true"}),r.animate?(l=!1,setTimeout(function(){a.style.position="absolute",l=!0},r.transition+10)):a.style.position="absolute",h=!1,r.close())},resize:function(){"none"!==e.getComputedStyle(c,null).getPropertyValue("display")?(u=!0,m(c,{"aria-hidden":"false"}),a.className.match(/(^|\s)closed(\s|$)/)&&(m(a,{"aria-hidden":"true"}),a.style.position="absolute"),this._createStyles(),this._calcHeight()):(u=!1,m(c,{"aria-hidden":"true"}),m(a,{"aria-hidden":"false"}),a.style.position=r.openPos,this._removeStyles())},handleEvent:function(t){var n=t||e.event;switch(n.type){case"touchstart":this._onTouchStart(n);break;case"touchmove":this._onTouchMove(n);break;case"touchend":case"mouseup":this._onTouchEnd(n);break;case"click":this._preventDefault(n);break;case"keyup":this._onKeyUp(n);break;case"focus":case"resize":this.resize(n)}},_init:function(){this.index=n++,g(a,r.navClass),g(a,r.navClass+"-"+this.index),g(a,"closed"),l=!0,h=!1,this._closeOnNavClick(),this._createToggle(),this._transitions(),this.resize();var o=this;setTimeout(function(){o.resize()},20),d(e,"resize",this,!1),d(e,"focus",this,!1),d(t.body,"touchmove",this,!1),d(c,"touchstart",this,!1),d(c,"touchend",this,!1),d(c,"mouseup",this,!1),d(c,"keyup",this,!1),d(c,"click",this,!1),r.init()},_createStyles:function(){b.parentNode||(b.type="text/css",t.getElementsByTagName("head")[0].appendChild(b))},_removeStyles:function(){b.parentNode&&b.parentNode.removeChild(b)},_createToggle:function(){if(r.customToggle){var e=r.customToggle.replace("#","");if(t.getElementById(e))c=t.getElementById(e);else{if(!t.querySelector(e))throw new Error("The custom nav toggle you are trying to select doesn't exist");c=t.querySelector(e)}}else{var n=t.createElement("a");n.innerHTML=r.label,m(n,{href:"#","class":"nav-toggle"}),"after"===r.insert?a.parentNode.insertBefore(n,a.nextSibling):a.parentNode.insertBefore(n,a),c=n}},_closeOnNavClick:function(){if(r.closeOnNavClick){var t=a.getElementsByTagName("a"),e=this;y(t,function(n,o){d(t[n],"click",function(){u&&e.toggle()},!1)})}},_preventDefault:function(t){return t.preventDefault?(t.stopImmediatePropagation&&t.stopImmediatePropagation(),t.preventDefault(),t.stopPropagation(),!1):void(t.returnValue=!1)},_onTouchStart:function(t){Event.prototype.stopImmediatePropagation||this._preventDefault(t),this.startX=t.touches[0].clientX,this.startY=t.touches[0].clientY,this.touchHasMoved=!1,f(c,"mouseup",this,!1)},_onTouchMove:function(t){(Math.abs(t.touches[0].clientX-this.startX)>10||Math.abs(t.touches[0].clientY-this.startY)>10)&&(this.touchHasMoved=!0)},_onTouchEnd:function(t){if(this._preventDefault(t),u&&!this.touchHasMoved){if("touchend"===t.type)return void this.toggle();var n=t||e.event;3!==n.which&&2!==n.button&&this.toggle()}},_onKeyUp:function(t){var n=t||e.event;13===n.keyCode&&this.toggle()},_transitions:function(){if(r.animate){var t=a.style,e="max-height "+r.transition+"ms";t.WebkitTransition=t.MozTransition=t.OTransition=t.transition=e}},_calcHeight:function(){for(var t=0,e=0;e<a.inner.length;e++)t+=a.inner[e].offsetHeight;var n="."+r.jsClass+" ."+r.navClass+"-"+this.index+".opened{max-height:"+t+"px !important} ."+r.jsClass+" ."+r.navClass+"-"+this.index+".opened.dropdown-active {max-height:9999px !important}";b.styleSheet?b.styleSheet.cssText=n:b.innerHTML=n,n=""}},new E(o,i)};"undefined"!=typeof module&&module.exports?module.exports=o:e.responsiveNav=o}(document,window,0),function(t,e){"use strict";"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?module.exports=e():t.Headroom=e()}(this,function(){"use strict";function t(t){this.callback=t,this.ticking=!1}function e(t){return t&&"undefined"!=typeof window&&(t===window||t.nodeType)}function n(t){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var o,i,s=t||{};for(i=1;i<arguments.length;i++){var a=arguments[i]||{};for(o in a)"object"!=typeof s[o]||e(s[o])?s[o]=s[o]||a[o]:s[o]=n(s[o],a[o])}return s}function o(t){return t===Object(t)?t:{down:t,up:t}}function i(t,e){e=n(e,i.options),this.lastKnownScrollY=0,this.elem=t,this.tolerance=o(e.tolerance),this.classes=e.classes,this.offset=e.offset,this.scroller=e.scroller,this.initialised=!1,this.onPin=e.onPin,this.onUnpin=e.onUnpin,this.onTop=e.onTop,this.onNotTop=e.onNotTop,this.onBottom=e.onBottom,this.onNotBottom=e.onNotBottom}var s={bind:!!function(){}.bind,classList:"classList"in document.documentElement,rAF:!!(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame)};return window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,t.prototype={constructor:t,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},i.prototype={constructor:i,init:function(){if(i.cutsTheMustard)return this.debouncer=new t(this.update.bind(this)),this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this},destroy:function(){var t=this.classes;this.initialised=!1,this.elem.classList.remove(t.unpinned,t.pinned,t.top,t.notTop,t.initial),this.scroller.removeEventListener("scroll",this.debouncer,!1)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,this.scroller.addEventListener("scroll",this.debouncer,!1),this.debouncer.handleEvent())},unpin:function(){var t=this.elem.classList,e=this.classes;!t.contains(e.pinned)&&t.contains(e.unpinned)||(t.add(e.unpinned),t.remove(e.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var t=this.elem.classList,e=this.classes;t.contains(e.unpinned)&&(t.remove(e.unpinned),t.add(e.pinned),this.onPin&&this.onPin.call(this))},top:function(){var t=this.elem.classList,e=this.classes;t.contains(e.top)||(t.add(e.top),t.remove(e.notTop),this.onTop&&this.onTop.call(this))},notTop:function(){var t=this.elem.classList,e=this.classes;t.contains(e.notTop)||(t.add(e.notTop),t.remove(e.top),this.onNotTop&&this.onNotTop.call(this))},bottom:function(){var t=this.elem.classList,e=this.classes;t.contains(e.bottom)||(t.add(e.bottom),t.remove(e.notBottom),this.onBottom&&this.onBottom.call(this))},notBottom:function(){var t=this.elem.classList,e=this.classes;t.contains(e.notBottom)||(t.add(e.notBottom),t.remove(e.bottom),this.onNotBottom&&this.onNotBottom.call(this))},getScrollY:function(){return void 0!==this.scroller.pageYOffset?this.scroller.pageYOffset:void 0!==this.scroller.scrollTop?this.scroller.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop},getViewportHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},getElementPhysicalHeight:function(t){return Math.max(t.offsetHeight,t.clientHeight)},getScrollerPhysicalHeight:function(){return this.scroller===window||this.scroller===document.body?this.getViewportHeight():this.getElementPhysicalHeight(this.scroller)},getDocumentHeight:function(){var t=document.body,e=document.documentElement;return Math.max(t.scrollHeight,e.scrollHeight,t.offsetHeight,e.offsetHeight,t.clientHeight,e.clientHeight)},getElementHeight:function(t){return Math.max(t.scrollHeight,t.offsetHeight,t.clientHeight)},getScrollerHeight:function(){return this.scroller===window||this.scroller===document.body?this.getDocumentHeight():this.getElementHeight(this.scroller)},isOutOfBounds:function(t){var e=t<0,n=t+this.getScrollerPhysicalHeight()>this.getScrollerHeight();return e||n},toleranceExceeded:function(t,e){return Math.abs(t-this.lastKnownScrollY)>=this.tolerance[e]},shouldUnpin:function(t,e){var n=t>this.lastKnownScrollY,o=t>=this.offset;return n&&o&&e},shouldPin:function(t,e){var n=t<this.lastKnownScrollY,o=t<=this.offset;return n&&e||o},update:function(){var t=this.getScrollY(),e=t>this.lastKnownScrollY?"down":"up",n=this.toleranceExceeded(t,e);this.isOutOfBounds(t)||(t<=this.offset?this.top():this.notTop(),t+this.getViewportHeight()>=this.getScrollerHeight()?this.bottom():this.notBottom(),this.shouldUnpin(t,n)?this.unpin():this.shouldPin(t,n)&&this.pin(),this.lastKnownScrollY=t)}},i.options={tolerance:{up:0,down:0},offset:0,scroller:window,classes:{pinned:"headroom--pinned",unpinned:"headroom--unpinned",top:"headroom--top",notTop:"headroom--not-top",bottom:"headroom--bottom",notBottom:"headroom--not-bottom",initial:"headroom"}},i.cutsTheMustard="undefined"!=typeof s&&s.rAF&&s.bind&&s.classList,i}),window.addEventListener("DOMContentLoaded",function(){responsiveNav(".nav-collapse",{customToggle:"menu-toggle",closeOnNavClick:!0,openPos:"relative"});smoothScroll.init({offset:36})},!1),function(t){function e(e){var i=e.find(".marker"),s={zoom:16,center:new google.maps.LatLng(0,0),mapTypeId:google.maps.MapTypeId.ROADMAP},a=new google.maps.Map(e[0],s);return a.markers=[],i.each(function(){n(t(this),a)}),o(a),a}function n(t,e){var n=new google.maps.LatLng(t.attr("data-lat"),t.attr("data-lng")),o=new google.maps.Marker({position:n,map:e});if(e.markers.push(o),t.html()){var i=new google.maps.InfoWindow({content:t.html()});google.maps.event.addListener(o,"click",function(){i.open(e,o)})}}function o(e){var n=new google.maps.LatLngBounds;t.each(e.markers,function(t,e){var o=new google.maps.LatLng(e.position.lat(),e.position.lng());n.extend(o)}),1==e.markers.length?(e.setCenter(n.getCenter()),e.setZoom(16)):e.fitBounds(n)}var i=null;t(document).ready(function(){t(".acf-map").each(function(){i=e(t(this))})})}(jQuery);
//# sourceMappingURL=scripts.js.map