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

		$('#demo-dp-component .input-group.date').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd",
			weekStart: 1,
			language: 'es'
		});

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
	success: function (response) {
		response = Math.round(response)
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
			icon: 'fa fa-check',
			message: 'El correo no es valido ',
			container: 'floating',
			timer: 3000
		});

		sw1 = 1;
	} else if (Correo.trim() == "") {

		$.niftyNoty({
			type: 'danger',
			icon: 'fa fa-check',
			message: 'Debe llenar el campo Correo',
			container: 'floating',
			timer: 3000
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
			icon: 'fa fa-check',
			message: 'Debe llenar el campo ' + Text,
			container: 'floating',
			timer: 3000
		});

		sw1 = 1;
	}
	if (sw1 == 1) {
		return false;
	} else {
		return true;
	}
};

$.postFormValues = function (url, form, extras, callback) {
	if ($(form).length) {
		Validate = $.validate(form)
		if (Validate.Status) {
			formValues = Validate.formValues
			if (extras) {
				formValues.append('extras', extras);
			}
			$.ajax({
				url: url,
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function (data) {
					callback(data);
				}
			});
		}
	} else {
		return false;
	}
}

$.localFormValues = function (form, callback) {
	if ($(form).length) {
		Validate = $.validate(form)
		if (Validate.Status) {
			callback(Validate.formValues);
		} else {
			return false;
		}
	} else {
		return false;
	}
}
$.validate = function (form) {
	var countObjs = 0;
	var countValidates = 0;
	var objs = $(form).find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
	var formValues = new FormData();
	objs.each(function (index, obj) {
		if (obj.hasAttribute('name')) {
			name = $(obj).attr('name')
			type = $(obj).attr('type');
			if(type != 'checkbox'){
				value = $(obj).val();
			}else{
				if ($(obj).is(':checked')){
					value = 1
				}else{
					value = 0
				}
			}
			countObjs++;
			if (obj.hasAttribute('validate')) {
				switch ($(obj).attr('validate')) {
					case 'not_null':
						if (value == "") {

							label = $(obj).siblings('label').html()

							if (label) {
								$(obj).parent('.form-group').addClass('has-error');
							} else {
								label = $(obj).parent().siblings('label').html()
								if(label){
									$(obj).closest('.form-group').addClass('has-error');
								}else{
									label = $(obj).data('nombre')
								}
							}
					
							alertas('danger', '<h5>Disculpe el campo ' + label + ' es obligatorio</h5>');
							return false;
						} else {
							formValues.append(name, value);
							countValidates++;
						}
						break;
					case 'email':
						emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
						emails = value.split(',');
						ToReturn = true
						$.each(emails, function (index, email) {
							if (!emailRegex.test(email.trim())) {
								ToReturn = false;
							}
						});

						if (ToReturn) {
							formValues.append(name, value);
							countValidates++;
						} else {
							$(obj).parent('.form-group').addClass('has-error');
							alertas('danger', '<h5>Disculpe el campo correo no es correo</h5>');
							return false;
						}
						break;
					default:
						formValues.append(name, value);
						countValidates++;
				}
			} else {
				formValues.append(name, value);
				countValidates++;
			}
		}
	});
	if (countObjs == countValidates) {
		Status = true;
	} else {
		Status = false;
	}
	Validate = {
		'Status': Status,
		'formValues': formValues
	}
	return Validate;
}

$('input').blur(function () {
	$(this).closest('.form-group').removeClass('has-error');
});

$('.effect').attr('attr', '');
$('.menu-items').hover(function () {
	if ($('.effect').attr('attr') == '') {
		$('.hover-menu').remove()
		var x = $(this).position();
		var top = x.top + 41;
		$('body').append('<span class="hover-menu" style="top:' + top + 'px;">' + $(this).html() + '</span>')
	} else {
		$('.menu-items').click(function () {
			if ($(this).find('ul').hasClass('in')) {
				$(this).find('ul').removeClass('in');
			} else {
				$(this).find('ul').addClass('in');
			}
		});
	}
}, function () {
	$('.hover-menu').hover(function () { }, function () {
		$('.hover-menu').remove()
	});
});


$(document).on('click', '.itemsMenu', function () {
	$(this).siblings('.collapse').slideToggle();
});

$(document).on('click', '.tgl-menu-btn', function (event) {
	event.preventDefault();
	if ($('.effect').attr('attr') == 1) {
		$('.effect').addClass('mainnav-sm');
		$('.effect').removeClass('mainnav-in');
		$('.effect').attr('attr', '');
	} else {
		$('.effect').addClass('mainnav-in');
		$('.effect').removeClass('mainnav-sm');
		$('.effect').attr('attr', '1');
	}
});

function alertas(type, message) {
	$.niftyNoty({
		type: type,
		icon: 'fa fa-check',
		message: '<h5>' + message + '</h5>',
		container: 'floating',
		timer: 3000
	});
};

!function (t) { "function" == typeof define && define.amd ? define(["jquery"], function (i) { return t(i, window, document) }) : "object" == typeof exports ? module.exports = t(require("jquery"), window, document) : t(jQuery, window, document) }(function (t, i, e) { "use strict"; var n, o, s, l, r, a, c, h, d, p, u, g, f, v, m, S, y, b, T, w, x, $, H, E, C, O, A; w = { paneClass: "nano-pane", sliderClass: "nano-slider", contentClass: "nano-content", iOSNativeScrolling: !1, preventPageScrolling: !1, disableResize: !1, alwaysVisible: !1, flashDelay: 1500, sliderMinHeight: 20, sliderMaxHeight: null, documentContext: null, windowContext: null }, m = "scroll", c = "mousedown", h = "mouseenter", d = "mousemove", u = "mousewheel", p = "mouseup", v = "resize", r = "drag", a = "enter", y = "up", f = "panedown", s = "DOMMouseScroll", l = "down", b = "wheel", S = "touchmove", n = "Microsoft Internet Explorer" === i.navigator.appName && /msie 7./i.test(i.navigator.appVersion) && i.ActiveXObject, o = null, E = i.requestAnimationFrame, T = i.cancelAnimationFrame, O = e.createElement("div").style, A = function () { var t, i, e, n, o; for (t = n = 0, o = (e = ["t", "webkitT", "MozT", "msT", "OT"]).length; o > n; t = ++n)if (e[t], i = e[t] + "ransform", i in O) return e[t].substr(0, e[t].length - 1); return !1 }(), C = function (t) { return !1 !== A && ("" === A ? t : A + t.charAt(0).toUpperCase() + t.substr(1)) }("transform"), $ = !1 !== C, x = function () { var t, i, n; return (i = (t = e.createElement("div")).style).position = "absolute", i.width = "100px", i.height = "100px", i.overflow = m, i.top = "-9999px", e.body.appendChild(t), n = t.offsetWidth - t.clientWidth, e.body.removeChild(t), n }, H = function () { var t, e, n; return e = i.navigator.userAgent, !!(t = /(?=.+Mac OS X)(?=.+Firefox)/.test(e)) && ((n = /Firefox\/\d{2}\./.exec(e)) && (n = n[0].replace(/\D+/g, "")), t && +n > 23) }, g = function () { function g(n, s) { this.el = n, this.options = s, o || (o = x()), this.$el = t(this.el), this.doc = t(this.options.documentContext || e), this.win = t(this.options.windowContext || i), this.body = this.doc.find("body"), this.$content = this.$el.children("." + this.options.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.previousPosition = 0, this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset() } return g.prototype.preventScrolling = function (t, i) { if (this.isActive) if (t.type === s) (i === l && t.originalEvent.detail > 0 || i === y && t.originalEvent.detail < 0) && t.preventDefault(); else if (t.type === u) { if (!t.originalEvent || !t.originalEvent.wheelDelta) return; (i === l && t.originalEvent.wheelDelta < 0 || i === y && t.originalEvent.wheelDelta > 0) && t.preventDefault() } }, g.prototype.nativeScrolling = function () { this.$content.css({ WebkitOverflowScrolling: "touch" }), this.iOSNativeScrolling = !0, this.isActive = !0 }, g.prototype.updateScrollValues = function () { var t, i; t = this.content, this.maxScrollTop = t.scrollHeight - t.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = t.scrollTop, i = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same", this.previousPosition = this.contentScrollTop, "same" !== i && this.$el.trigger("update", { position: this.contentScrollTop, maximum: this.maxScrollTop, direction: i }), this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop) }, g.prototype.setOnScrollStyles = function () { var t, i; $ ? (t = {})[C] = "translate(0, " + this.sliderTop + "px)" : t = { top: this.sliderTop }, E ? (T && this.scrollRAF && T(this.scrollRAF), this.scrollRAF = E((i = this, function () { return i.scrollRAF = null, i.slider.css(t) }))) : this.slider.css(t) }, g.prototype.createEvents = function () { var t, i, e, n, o, s, c, u; this.events = { down: (u = this, function (t) { return u.isBeingDragged = !0, u.offsetY = t.pageY - u.slider.offset().top, u.slider.is(t.target) || (u.offsetY = 0), u.pane.addClass("active"), u.doc.bind(d, u.events[r]).bind(p, u.events.up), u.body.bind(h, u.events[a]), !1 }), drag: (c = this, function (t) { return c.sliderY = t.pageY - c.$el.offset().top - c.paneTop - (c.offsetY || .5 * c.sliderHeight), c.scroll(), c.contentScrollTop >= c.maxScrollTop && c.prevScrollTop !== c.maxScrollTop ? c.$el.trigger("scrollend") : 0 === c.contentScrollTop && 0 !== c.prevScrollTop && c.$el.trigger("scrolltop"), !1 }), up: (s = this, function (t) { return s.isBeingDragged = !1, s.pane.removeClass("active"), s.doc.unbind(d, s.events[r]).unbind(p, s.events.up), s.body.unbind(h, s.events[a]), !1 }), resize: (o = this, function (t) { o.reset() }), panedown: (n = this, function (t) { return n.sliderY = (t.offsetY || t.originalEvent.layerY) - .5 * n.sliderHeight, n.scroll(), n.events.down(t), !1 }), scroll: (e = this, function (t) { e.updateScrollValues(), e.isBeingDragged || (e.iOSNativeScrolling || (e.sliderY = e.sliderTop, e.setOnScrollStyles()), null != t && (e.contentScrollTop >= e.maxScrollTop ? (e.options.preventPageScrolling && e.preventScrolling(t, l), e.prevScrollTop !== e.maxScrollTop && e.$el.trigger("scrollend")) : 0 === e.contentScrollTop && (e.options.preventPageScrolling && e.preventScrolling(t, y), 0 !== e.prevScrollTop && e.$el.trigger("scrolltop")))) }), wheel: (i = this, function (t) { var e; if (null != t) return e = t.delta || t.wheelDelta || t.originalEvent && t.originalEvent.wheelDelta || -t.detail || t.originalEvent && -t.originalEvent.detail, e && (i.sliderY += -e / 3), i.scroll(), !1 }), enter: (t = this, function (i) { var e; if (t.isBeingDragged) return 1 !== (i.buttons || i.which) ? (e = t.events).up.apply(e, arguments) : void 0 }) } }, g.prototype.addEvents = function () { var t; this.removeEvents(), t = this.events, this.options.disableResize || this.win.bind(v, t[v]), this.iOSNativeScrolling || (this.slider.bind(c, t[l]), this.pane.bind(c, t[f]).bind(u + " " + s, t[b])), this.$content.bind(m + " " + u + " " + s + " " + S, t[m]) }, g.prototype.removeEvents = function () { var t; t = this.events, this.win.unbind(v, t[v]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind(m + " " + u + " " + s + " " + S, t[m]) }, g.prototype.generate = function () { var t, e, n, s, l; return s = (e = this.options).paneClass, l = e.sliderClass, e.contentClass, (n = this.$el.children("." + s)).length || n.children("." + l).length || this.$el.append('<div class="' + s + '"><div class="' + l + '" /></div>'), this.pane = this.$el.children("." + s), this.slider = this.pane.find("." + l), 0 === o && H() ? t = { right: -14, paddingRight: +i.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, "") + 14 } : o && (t = { right: -o }, this.$el.addClass("has-scrollbar")), null != t && this.$content.css(t), this }, g.prototype.restore = function () { this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents() }, g.prototype.reset = function () { var t, i, e, s, l, r, a, c, h, d, p; return this.iOSNativeScrolling ? void (this.contentHeight = this.content.scrollHeight) : (this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), l = (s = (t = this.content).style).overflowY, n && this.$content.css({ height: this.$content.height() }), i = t.scrollHeight + o, (h = parseInt(this.$el.css("max-height"), 10)) > 0 && (this.$el.height(""), this.$el.height(t.scrollHeight > h ? h : t.scrollHeight)), a = (r = this.pane.outerHeight(!1)) + (c = parseInt(this.pane.css("top"), 10)) + parseInt(this.pane.css("bottom"), 10), (p = Math.round(a / i * r)) < this.options.sliderMinHeight ? p = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && p > this.options.sliderMaxHeight && (p = this.options.sliderMaxHeight), l === m && s.overflowX !== m && (p += o), this.maxSliderTop = a - p, this.contentHeight = i, this.paneHeight = r, this.paneOuterHeight = a, this.sliderHeight = p, this.paneTop = c, this.slider.height(p), this.events.scroll(), this.pane.show(), this.isActive = !0, t.scrollHeight === t.clientHeight || this.pane.outerHeight(!0) >= t.scrollHeight && l !== m ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === t.scrollHeight && l === m ? this.slider.hide() : this.slider.show(), this.pane.css({ opacity: this.options.alwaysVisible ? 1 : "", visibility: this.options.alwaysVisible ? "visible" : "" }), ("static" === (e = this.$content.css("position")) || "relative" === e) && ((d = parseInt(this.$content.css("right"), 10)) && this.$content.css({ right: "", marginRight: d })), this) }, g.prototype.scroll = function () { return this.isActive ? (this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this) : void 0 }, g.prototype.scrollBottom = function (t) { return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - t).trigger(u), this.stop().restore(), this) : void 0 }, g.prototype.scrollTop = function (t) { return this.isActive ? (this.$content.scrollTop(+t).trigger(u), this.stop().restore(), this) : void 0 }, g.prototype.scrollTo = function (t) { return this.isActive ? (this.scrollTop(this.$el.find(t).get(0).offsetTop), this) : void 0 }, g.prototype.stop = function () { return T && this.scrollRAF && (T(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this }, g.prototype.destroy = function () { return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), n && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"), this.$content.css({ right: "" })), this }, g.prototype.flash = function () { return !this.iOSNativeScrolling && this.isActive ? (this.reset(), this.pane.addClass("flashed"), setTimeout((t = this, function () { t.pane.removeClass("flashed") }), this.options.flashDelay), this) : void 0; var t }, g }(), t.fn.nanoScroller = function (i) { return this.each(function () { var e, n; if ((n = this.nanoscroller) || (e = t.extend({}, w, i), this.nanoscroller = n = new g(this, e)), i && "object" == typeof i) { if (t.extend(n.options, i), null != i.scrollBottom) return n.scrollBottom(i.scrollBottom); if (null != i.scrollTop) return n.scrollTop(i.scrollTop); if (i.scrollTo) return n.scrollTo(i.scrollTo); if ("bottom" === i.scroll) return n.scrollBottom(0); if ("top" === i.scroll) return n.scrollTop(0); if (i.scroll && i.scroll instanceof t) return n.scrollTo(i.scroll); if (i.stop) return n.stop(); if (i.destroy) return n.destroy(); if (i.flash) return n.flash() } return n.reset() }) }, t.fn.nanoScroller.Constructor = g }), function (t) { "use strict"; var i; window.nifty = { container: t("#container"), contentContainer: t("#content-container"), navbar: t("#navbar"), mainNav: t("#mainnav-container"), aside: t("#aside-container"), footer: t("#footer"), scrollTop: t("#scroll-top"), window: t(window), body: t("body"), bodyHtml: t("body, html"), document: t(document), screenSize: "", isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent), randomInt: function (t, i) { return Math.floor(Math.random() * (i - t + 1) + t) }, transition: (i = (document.body || document.documentElement).style, void 0 !== i.transition || void 0 !== i.WebkitTransition) }, nifty.document.ready(function () { nifty.document.trigger("nifty.ready") }), nifty.document.on("nifty.ready", function () { var i = t(".add-tooltip"); i.length && i.tooltip(); var e = t(".add-popover"); e.length && e.popover(); var n = t(".nano"); n.length && n.nanoScroller({ preventPageScrolling: !0 }), t("#navbar-container .navbar-top-links").on("shown.bs.dropdown", ".dropdown", function () { t(this).find(".nano").nanoScroller({ preventPageScrolling: !0 }) }), nifty.body.addClass("nifty-ready") }) }(jQuery), function (t) { "use strict"; var i, e, n = {}, o = !1; t.niftyNoty = function (s) { var l, r, a, c, h = t.extend({}, { type: "primary", icon: "", title: "", message: "", closeBtn: !0, container: "page", floating: { position: "top-right", animationIn: "jellyIn", animationOut: "fadeOut" }, html: null, focus: !0, timer: 0, onShow: function () { }, onShown: function () { }, onHide: function () { }, onHidden: function () { } }, s), d = t('<div class="alert-wrap"></div>'), p = (a = h.closeBtn ? '<button class="close" type="button"><i class="fa fa-times-circle"></i></button>' : "", c = '<div class="alert alert-' + h.type + '" role="alert">' + a + '<div class="media">', h.html ? c + h.html + "</div></div>" : c + (r = "", s && s.icon && (r = '<div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="' + h.icon + '"></i></span></div>'), r) + '<div class="media-body"><h4 class="alert-title">' + h.title + '</h4><p class="alert-message">' + h.message + "</p></div></div>"), u = function (t) { return h.onHide(), "floating" === h.container && h.floating.animationOut && (d.removeClass(h.floating.animationIn).addClass(h.floating.animationOut), nifty.transition || (h.onHidden(), d.remove())), d.removeClass("in").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function (t) { "max-height" == t.originalEvent.propertyName && (h.onHidden(), d.remove()) }), clearInterval(l), null }, g = function (t) { nifty.bodyHtml.animate({ scrollTop: t }, 300, function () { d.addClass("in") }) }; !function () { if (h.onShow(), "page" === h.container) i || (i = t('<div id="page-alert"></div>'), nifty.contentContainer.prepend(i)), e = i, h.focus && g(0); else if ("floating" === h.container) n[h.floating.position] || (n[h.floating.position] = t('<div id="floating-' + h.floating.position + '" class="floating-container"></div>'), nifty.container.append(n[h.floating.position])), e = n[h.floating.position], h.floating.animationIn && d.addClass("in animated " + h.floating.animationIn), h.focus = !1; else { var s = t(h.container), l = s.children(".panel-alert"), r = s.children(".panel-heading"); if (!s.length) return o = !1, !1; l.length ? e = l : (e = t('<div class="panel-alert"></div>'), r.length ? r.after(e) : s.prepend(e)), h.focus && g(s.offset().top - 30) } o = !0 }(); if (o) { if (e.append(d.html(p)), d.find('[data-dismiss="noty"]').one("click", u), h.closeBtn && d.find(".close").one("click", u), h.timer > 0 && (l = setInterval(u, h.timer)), !h.focus) var f = setInterval(function () { d.addClass("in"), clearInterval(f) }, 200); d.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function (t) { "max-height" != t.originalEvent.propertyName && "animationend" != t.type || !o || (h.onShown(), o = !1) }) } } }(jQuery);