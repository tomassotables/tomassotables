(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{144:function(t,o,i){"use strict";i.r(o),function(t){i(210),i(211);o.default=()=>{function o(){t(window).scrollTop()>t(".sticky-anchor").offset().top-300?t(".sticky-topbar").addClass("sticky"):t(".sticky-topbar").removeClass("sticky")}t(".js-selector").stick_in_parent({offset_top:150}),t((function(){t(window).scroll(o),o()})),t(".xoo-cp-btn-vc.xcp-btn").html("I am going to order")}}.call(this,i(8))},210:function(t,o,i){},211:function(t,o){(function(){var t,o;t=this.jQuery||window.jQuery,o=t(window),t.fn.stick_in_parent=function(i){var e,s,r,n,l,c,a,p,u,d,f,h;for(null==i&&(i={}),u=i.sticky_class,r=i.inner_scrolling,p=i.recalc_every,a=i.parent,l=i.offset_top,n=i.spacer,s=i.bottoming,null==l&&(l=0),null==a&&(a=void 0),null==r&&(r=!0),null==u&&(u="is_stuck"),e=t(document),null==s&&(s=!0),c=function(t){var o;return window.getComputedStyle?(t=window.getComputedStyle(t[0]),o=parseFloat(t.getPropertyValue("width"))+parseFloat(t.getPropertyValue("margin-left"))+parseFloat(t.getPropertyValue("margin-right")),"border-box"!==t.getPropertyValue("box-sizing")&&(o+=parseFloat(t.getPropertyValue("border-left-width"))+parseFloat(t.getPropertyValue("border-right-width"))+parseFloat(t.getPropertyValue("padding-left"))+parseFloat(t.getPropertyValue("padding-right"))),o):t.outerWidth(!0)},d=function(i,d,f,h,g,k,y,m){var w,b,v,_,x,C,P,V,F,I,z,j;if(!i.data("sticky_kit")){if(i.data("sticky_kit",!0),x=e.height(),P=i.parent(),null!=a&&(P=P.closest(a)),!P.length)throw"failed to find stick parent";if(w=v=!1,(z=null!=n?n&&i.closest(n):t("<div />"))&&z.css("position",i.css("position")),(V=function(){var t,o,s;if(!m&&(x=e.height(),t=parseInt(P.css("border-top-width"),10),o=parseInt(P.css("padding-top"),10),d=parseInt(P.css("padding-bottom"),10),f=P.offset().top+t+o,h=P.height(),v&&(w=v=!1,null==n&&(i.insertAfter(z),z.detach()),i.css({position:"",top:"",width:"",bottom:""}).removeClass(u),s=!0),g=i.offset().top-(parseInt(i.css("margin-top"),10)||0)-l,k=i.outerHeight(!0),y=i.css("float"),z&&z.css({width:c(i),height:k,display:i.css("display"),"vertical-align":i.css("vertical-align"),float:y}),s))return j()})(),k!==h)return _=void 0,C=l,I=p,j=function(){var t,c,a,b;if(!m&&(a=!1,null!=I&&(0>=--I&&(I=p,V(),a=!0)),a||e.height()===x||V(),a=o.scrollTop(),null!=_&&(c=a-_),_=a,v?(s&&(b=a+k+C>h+f,w&&!b&&(w=!1,i.css({position:"fixed",bottom:"",top:C}).trigger("sticky_kit:unbottom"))),a<g&&(v=!1,C=l,null==n&&("left"!==y&&"right"!==y||i.insertAfter(z),z.detach()),t={position:"",width:"",top:""},i.css(t).removeClass(u).trigger("sticky_kit:unstick")),r&&(t=o.height(),k+l>t&&!w&&(C-=c,C=Math.max(t-k,C),C=Math.min(l,C),v&&i.css({top:C+"px"})))):a>g&&(v=!0,(t={position:"fixed",top:C}).width="border-box"===i.css("box-sizing")?i.outerWidth()+"px":i.width()+"px",i.css(t).addClass(u),null==n&&(i.after(z),"left"!==y&&"right"!==y||z.append(i)),i.trigger("sticky_kit:stick")),v&&s&&(null==b&&(b=a+k+C>h+f),!w&&b)))return w=!0,"static"===P.css("position")&&P.css({position:"relative"}),i.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},F=function(){return V(),j()},b=function(){if(m=!0,o.off("touchmove",j),o.off("scroll",j),o.off("resize",F),t(document.body).off("sticky_kit:recalc",F),i.off("sticky_kit:detach",b),i.removeData("sticky_kit"),i.css({position:"",bottom:"",top:"",width:""}),P.position("position",""),v)return null==n&&("left"!==y&&"right"!==y||i.insertAfter(z),z.remove()),i.removeClass(u)},o.on("touchmove",j),o.on("scroll",j),o.on("resize",F),t(document.body).on("sticky_kit:recalc",F),i.on("sticky_kit:detach",b),setTimeout(j,0)}},f=0,h=this.length;f<h;f++)i=this[f],d(t(i));return this}}).call(this)}}]);
//# sourceMappingURL=6.0571d.chunk.js.map