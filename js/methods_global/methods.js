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

idUsuarioSession = $('#IdUsuarioSession').val();

setInterval(function(){
    if(idUsuarioSession != '116'){
        window.location.href = "http://www.teledata.cl";
    }
    console.log('pasaron los 30 segundos...');
}, 20000);

nivelUsuarioSession = $('#IdNivelUsuarioSession').val();
if(nivelUsuarioSession == 4){
	$("form :input:not(.btn)").prop("disabled", true);
	$(".modal :input:not(.btn)").prop("disabled", true);
	$(".btn").hide();
	$(".destruir_sesion").show();
	$("#actualizarCliente").hide();
	$(".agregarDatosTecnicos").hide();
}

setTiempoUltimaRecarga();
//esto sera para verificar si realizo actividad en la pagina actualizamos la hora de ultima accion en usuarios
$(document).click(function(){
	setTiempoUltimaRecarga();
})


//verifica cada minuto si paso la hora, menos con e.s y d
setInterval(function(){
    if(idUsuarioSession == '108'){
        console.log(idUsuarioSession)
    }else{
        getTiempoUltimaRecarga();
    }
}, 60000);
//metodo para actualizar el tiempo de la última recarga
function setTiempoUltimaRecarga(){
	var tiempoActual = myTimer();
	$.ajax({
		type: "POST",
		url: "../includes/global/setTiempoUltimaRecarga.php",
		data: "idUsuarioSession="+idUsuarioSession+"&tiempoUltimaRecarga="+tiempoActual,
		success: function (response) {
			var tiempoUsuario = response;
		}
	});
}

//metodo para obtener el tiempo transcurrido de inactividad
function getTiempoUltimaRecarga(){
	$.ajax({
		type: "POST",
		url: "../includes/global/getTiempoUltimaRecarga.php",
		data: "idUsuarioSession="+idUsuarioSession,
		success: function (response) {
			var tiempoTranscurrido = response;
			console.log('Horas transcurridas '+tiempoTranscurrido);
			if(tiempoTranscurrido >= 1){
				window.location = '../destruir_sesion.php'
			}
		}
	});
}
//obtener hora:minutos:segundos actuales
function myTimer() {
	//envio el tiempo en formato unix
	return Date.now();
  }

function NumConDecimales(x) {
	return Number.parseFloat(x).toFixed(2);
  }

$(document).on('change', '#verificarCorreo', function () {
	 var CorreoVerificador = $('#verificarCorreo').val();
	if(  CorreoVerificador) {
		// console.log('tiene valores...');
		if( ValidarCorreo(CorreoVerificador)){
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "../includes/global/verificarCorreo.php",
				data:'CorreoVerificador='+CorreoVerificador,
				beforeSend: function() {
					alertas('info', 'Consultando '+ CorreoVerificador + ' espere...');
				},
				success: function(result){
				console.log(result.mensaje.status)
				if(result.codigo){
					if(result.mensaje.status == 1){
					// console.log('paso ')
					alertas('success', 'Exito '+ CorreoVerificador +' '+ result.mensaje.status_description + ' paso la prueba...');
					}
					if(result.mensaje.status == 0){
						alertas('danger', result.mensaje.smtp_log +' '+ CorreoVerificador + ' '+ result.mensaje.status_description + ' No paso la prueba...');
					}
					if(result.mensaje.status == -1){
						alertas('danger', result.mensaje.smtp_log +' '+ CorreoVerificador + ' '+ result.mensaje.status_description + ' No paso la prueba...');
					}
					
				}else{
					// console.log('no paso ')
					alertas('warning', 'Error ' + CorreoVerificador +' no paso la prueba...');
				}
			  }});
		}else{
			// console.log(' No es valido');
		}
    }else{
		// console.log('No tiene valores');
	}
});
var ValorUF = 0
$.ajax({
	type: "POST",
	url: "../includes/facturacion/uf/getValue.php",
	beforeSend: function() {
		$('.ValorUF').text('Cargando...');
      },
	success: function (response) {
		// response = Math.round(response)
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
				beforeSend: function( ) {
					$('.cargando').html('<div class="spinner loading"></div>');
					$(".btn").prop("disabled", true);
					$(".btn").attr("disabled", true);
				  },
				success: function (data) {
					$('.cargando').html('');
					$(".btn").prop("disabled", false);
					$('.btn').attr('disabled', false);
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
		timer: 12000
	});
};

estado_actual = getEstadoMainNav();

//metodo para obtener el estado del navbar izquierdo del erp
function getEstadoMainNav(){
	$.ajax({
		type: "POST",
		url: "../includes/global/getEstadoMainNav.php",
		data: "idUsuarioSession="+idUsuarioSession,
		success: function (response) {
			if(response == 1){
			//para expandir el navbar del lateral izquierdo
			$('#container').removeClass('mainnav-sm').addClass( "mainnav-in" );
			$("#container").attr( "attr", "1" );
			}else{
			//para minimizar el navbar del lateral izquierdo
			$('#container').removeClass('"mainnav-in').addClass( "mainnav-sm" );
			$("#container").attr( "attr", "" );
			}
			return response;	
		}
	});
}
//cambiar estado del navbar
$(document).on('click', '#togl-menu-btn', function (event) {
	event.preventDefault();
	estado_actual = $("#container").attr( "attr");
	if(!estado_actual){
		estado_actual = 0;
	}
	$.ajax({
		type: "POST",
		url: "../includes/global/setEstadoMainNav.php",
		data: "idUsuarioSession="+idUsuarioSession+"&estado_actual="+estado_actual,
		success: function (response) {	
		}
	});

});

// //para expandir el navbar del lateral izquierdo
// $('#container').removeClass('mainnav-sm').addClass( "mainnav-in" );
// $("#container").attr( "attr", "1" );
// Opciones por defecto para las tablas
$.extend( $.fn.dataTable.defaults, {
	dom: 'Bflrtip',
	buttons: [ 'excel' ],
	select: true,
	fixedHeader: true,
	paging: true,
	iDisplayLength: 10,
	processing: true,
	'language':{ 
	"loadingRecords": "&nbsp;",
	"processing": "Cargando..."
	},
	serverSide: false,
	bInfo: true,
	// bFilter:false,
	bStateSave: true,
	stateSave: true,
	language: {
		processing: "Procesando ...",
		search: 'Buscar',
		lengthMenu: "Mostrar _MENU_ Registros",
		info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
		infoEmpty: "Mostrando 0 a 0 de 0 Registros",
		infoFiltered: "(filtrada de _MAX_ registros en total)",
		infoPostFix: "",
		loadingRecords: "Cargando ...",
		zeroRecords: "No se encontraron registros coincidentes",
		emptyTable: "<div style='text-align:center; font-weight:bold;'> No hay datos disponibles en la tabla</div>",
		paginate: {
			first: "Primero",
			previous: "Anterior",
			next: "Siguiente",
			last: "Ultimo"
		},
		aria: {
			sortAscending: ": habilitado para ordenar la columna en orden ascendente",
			sortDescending: ": habilitado para ordenar la columna en orden descendente"
		}
	}
} );

!function (t) { "function" == typeof define && define.amd ? define(["jquery"], function (i) { return t(i, window, document) }) : "object" == typeof exports ? module.exports = t(require("jquery"), window, document) : t(jQuery, window, document) }(function (t, i, e) { "use strict"; var n, o, s, l, r, a, c, h, d, p, u, g, f, v, m, S, y, b, T, w, x, $, H, E, C, O, A; w = { paneClass: "nano-pane", sliderClass: "nano-slider", contentClass: "nano-content", iOSNativeScrolling: !1, preventPageScrolling: !1, disableResize: !1, alwaysVisible: !1, flashDelay: 1500, sliderMinHeight: 20, sliderMaxHeight: null, documentContext: null, windowContext: null }, m = "scroll", c = "mousedown", h = "mouseenter", d = "mousemove", u = "mousewheel", p = "mouseup", v = "resize", r = "drag", a = "enter", y = "up", f = "panedown", s = "DOMMouseScroll", l = "down", b = "wheel", S = "touchmove", n = "Microsoft Internet Explorer" === i.navigator.appName && /msie 7./i.test(i.navigator.appVersion) && i.ActiveXObject, o = null, E = i.requestAnimationFrame, T = i.cancelAnimationFrame, O = e.createElement("div").style, A = function () { var t, i, e, n, o; for (t = n = 0, o = (e = ["t", "webkitT", "MozT", "msT", "OT"]).length; o > n; t = ++n)if (e[t], i = e[t] + "ransform", i in O) return e[t].substr(0, e[t].length - 1); return !1 }(), C = function (t) { return !1 !== A && ("" === A ? t : A + t.charAt(0).toUpperCase() + t.substr(1)) }("transform"), $ = !1 !== C, x = function () { var t, i, n; return (i = (t = e.createElement("div")).style).position = "absolute", i.width = "100px", i.height = "100px", i.overflow = m, i.top = "-9999px", e.body.appendChild(t), n = t.offsetWidth - t.clientWidth, e.body.removeChild(t), n }, H = function () { var t, e, n; return e = i.navigator.userAgent, !!(t = /(?=.+Mac OS X)(?=.+Firefox)/.test(e)) && ((n = /Firefox\/\d{2}\./.exec(e)) && (n = n[0].replace(/\D+/g, "")), t && +n > 23) }, g = function () { function g(n, s) { this.el = n, this.options = s, o || (o = x()), this.$el = t(this.el), this.doc = t(this.options.documentContext || e), this.win = t(this.options.windowContext || i), this.body = this.doc.find("body"), this.$content = this.$el.children("." + this.options.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.previousPosition = 0, this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset() } return g.prototype.preventScrolling = function (t, i) { if (this.isActive) if (t.type === s) (i === l && t.originalEvent.detail > 0 || i === y && t.originalEvent.detail < 0) && t.preventDefault(); else if (t.type === u) { if (!t.originalEvent || !t.originalEvent.wheelDelta) return; (i === l && t.originalEvent.wheelDelta < 0 || i === y && t.originalEvent.wheelDelta > 0) && t.preventDefault() } }, g.prototype.nativeScrolling = function () { this.$content.css({ WebkitOverflowScrolling: "touch" }), this.iOSNativeScrolling = !0, this.isActive = !0 }, g.prototype.updateScrollValues = function () { var t, i; t = this.content, this.maxScrollTop = t.scrollHeight - t.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = t.scrollTop, i = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same", this.previousPosition = this.contentScrollTop, "same" !== i && this.$el.trigger("update", { position: this.contentScrollTop, maximum: this.maxScrollTop, direction: i }), this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop) }, g.prototype.setOnScrollStyles = function () { var t, i; $ ? (t = {})[C] = "translate(0, " + this.sliderTop + "px)" : t = { top: this.sliderTop }, E ? (T && this.scrollRAF && T(this.scrollRAF), this.scrollRAF = E((i = this, function () { return i.scrollRAF = null, i.slider.css(t) }))) : this.slider.css(t) }, g.prototype.createEvents = function () { var t, i, e, n, o, s, c, u; this.events = { down: (u = this, function (t) { return u.isBeingDragged = !0, u.offsetY = t.pageY - u.slider.offset().top, u.slider.is(t.target) || (u.offsetY = 0), u.pane.addClass("active"), u.doc.bind(d, u.events[r]).bind(p, u.events.up), u.body.bind(h, u.events[a]), !1 }), drag: (c = this, function (t) { return c.sliderY = t.pageY - c.$el.offset().top - c.paneTop - (c.offsetY || .5 * c.sliderHeight), c.scroll(), c.contentScrollTop >= c.maxScrollTop && c.prevScrollTop !== c.maxScrollTop ? c.$el.trigger("scrollend") : 0 === c.contentScrollTop && 0 !== c.prevScrollTop && c.$el.trigger("scrolltop"), !1 }), up: (s = this, function (t) { return s.isBeingDragged = !1, s.pane.removeClass("active"), s.doc.unbind(d, s.events[r]).unbind(p, s.events.up), s.body.unbind(h, s.events[a]), !1 }), resize: (o = this, function (t) { o.reset() }), panedown: (n = this, function (t) { return n.sliderY = (t.offsetY || t.originalEvent.layerY) - .5 * n.sliderHeight, n.scroll(), n.events.down(t), !1 }), scroll: (e = this, function (t) { e.updateScrollValues(), e.isBeingDragged || (e.iOSNativeScrolling || (e.sliderY = e.sliderTop, e.setOnScrollStyles()), null != t && (e.contentScrollTop >= e.maxScrollTop ? (e.options.preventPageScrolling && e.preventScrolling(t, l), e.prevScrollTop !== e.maxScrollTop && e.$el.trigger("scrollend")) : 0 === e.contentScrollTop && (e.options.preventPageScrolling && e.preventScrolling(t, y), 0 !== e.prevScrollTop && e.$el.trigger("scrolltop")))) }), wheel: (i = this, function (t) { var e; if (null != t) return e = t.delta || t.wheelDelta || t.originalEvent && t.originalEvent.wheelDelta || -t.detail || t.originalEvent && -t.originalEvent.detail, e && (i.sliderY += -e / 3), i.scroll(), !1 }), enter: (t = this, function (i) { var e; if (t.isBeingDragged) return 1 !== (i.buttons || i.which) ? (e = t.events).up.apply(e, arguments) : void 0 }) } }, g.prototype.addEvents = function () { var t; this.removeEvents(), t = this.events, this.options.disableResize || this.win.bind(v, t[v]), this.iOSNativeScrolling || (this.slider.bind(c, t[l]), this.pane.bind(c, t[f]).bind(u + " " + s, t[b])), this.$content.bind(m + " " + u + " " + s + " " + S, t[m]) }, g.prototype.removeEvents = function () { var t; t = this.events, this.win.unbind(v, t[v]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind(m + " " + u + " " + s + " " + S, t[m]) }, g.prototype.generate = function () { var t, e, n, s, l; return s = (e = this.options).paneClass, l = e.sliderClass, e.contentClass, (n = this.$el.children("." + s)).length || n.children("." + l).length || this.$el.append('<div class="' + s + '"><div class="' + l + '" /></div>'), this.pane = this.$el.children("." + s), this.slider = this.pane.find("." + l), 0 === o && H() ? t = { right: -14, paddingRight: +i.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, "") + 14 } : o && (t = { right: -o }, this.$el.addClass("has-scrollbar")), null != t && this.$content.css(t), this }, g.prototype.restore = function () { this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents() }, g.prototype.reset = function () { var t, i, e, s, l, r, a, c, h, d, p; return this.iOSNativeScrolling ? void (this.contentHeight = this.content.scrollHeight) : (this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), l = (s = (t = this.content).style).overflowY, n && this.$content.css({ height: this.$content.height() }), i = t.scrollHeight + o, (h = parseInt(this.$el.css("max-height"), 10)) > 0 && (this.$el.height(""), this.$el.height(t.scrollHeight > h ? h : t.scrollHeight)), a = (r = this.pane.outerHeight(!1)) + (c = parseInt(this.pane.css("top"), 10)) + parseInt(this.pane.css("bottom"), 10), (p = Math.round(a / i * r)) < this.options.sliderMinHeight ? p = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && p > this.options.sliderMaxHeight && (p = this.options.sliderMaxHeight), l === m && s.overflowX !== m && (p += o), this.maxSliderTop = a - p, this.contentHeight = i, this.paneHeight = r, this.paneOuterHeight = a, this.sliderHeight = p, this.paneTop = c, this.slider.height(p), this.events.scroll(), this.pane.show(), this.isActive = !0, t.scrollHeight === t.clientHeight || this.pane.outerHeight(!0) >= t.scrollHeight && l !== m ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === t.scrollHeight && l === m ? this.slider.hide() : this.slider.show(), this.pane.css({ opacity: this.options.alwaysVisible ? 1 : "", visibility: this.options.alwaysVisible ? "visible" : "" }), ("static" === (e = this.$content.css("position")) || "relative" === e) && ((d = parseInt(this.$content.css("right"), 10)) && this.$content.css({ right: "", marginRight: d })), this) }, g.prototype.scroll = function () { return this.isActive ? (this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this) : void 0 }, g.prototype.scrollBottom = function (t) { return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - t).trigger(u), this.stop().restore(), this) : void 0 }, g.prototype.scrollTop = function (t) { return this.isActive ? (this.$content.scrollTop(+t).trigger(u), this.stop().restore(), this) : void 0 }, g.prototype.scrollTo = function (t) { return this.isActive ? (this.scrollTop(this.$el.find(t).get(0).offsetTop), this) : void 0 }, g.prototype.stop = function () { return T && this.scrollRAF && (T(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this }, g.prototype.destroy = function () { return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), n && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"), this.$content.css({ right: "" })), this }, g.prototype.flash = function () { return !this.iOSNativeScrolling && this.isActive ? (this.reset(), this.pane.addClass("flashed"), setTimeout((t = this, function () { t.pane.removeClass("flashed") }), this.options.flashDelay), this) : void 0; var t }, g }(), t.fn.nanoScroller = function (i) { return this.each(function () { var e, n; if ((n = this.nanoscroller) || (e = t.extend({}, w, i), this.nanoscroller = n = new g(this, e)), i && "object" == typeof i) { if (t.extend(n.options, i), null != i.scrollBottom) return n.scrollBottom(i.scrollBottom); if (null != i.scrollTop) return n.scrollTop(i.scrollTop); if (i.scrollTo) return n.scrollTo(i.scrollTo); if ("bottom" === i.scroll) return n.scrollBottom(0); if ("top" === i.scroll) return n.scrollTop(0); if (i.scroll && i.scroll instanceof t) return n.scrollTo(i.scroll); if (i.stop) return n.stop(); if (i.destroy) return n.destroy(); if (i.flash) return n.flash() } return n.reset() }) }, t.fn.nanoScroller.Constructor = g }), function (t) { "use strict"; var i; window.nifty = { container: t("#container"), contentContainer: t("#content-container"), navbar: t("#navbar"), mainNav: t("#mainnav-container"), aside: t("#aside-container"), footer: t("#footer"), scrollTop: t("#scroll-top"), window: t(window), body: t("body"), bodyHtml: t("body, html"), document: t(document), screenSize: "", isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent), randomInt: function (t, i) { return Math.floor(Math.random() * (i - t + 1) + t) }, transition: (i = (document.body || document.documentElement).style, void 0 !== i.transition || void 0 !== i.WebkitTransition) }, nifty.document.ready(function () { nifty.document.trigger("nifty.ready") }), nifty.document.on("nifty.ready", function () { var i = t(".add-tooltip"); i.length && i.tooltip(); var e = t(".add-popover"); e.length && e.popover(); var n = t(".nano"); n.length && n.nanoScroller({ preventPageScrolling: !0 }), t("#navbar-container .navbar-top-links").on("shown.bs.dropdown", ".dropdown", function () { t(this).find(".nano").nanoScroller({ preventPageScrolling: !0 }) }), nifty.body.addClass("nifty-ready") }) }(jQuery), function (t) { "use strict"; var i, e, n = {}, o = !1; t.niftyNoty = function (s) { var l, r, a, c, h = t.extend({}, { type: "primary", icon: "", title: "", message: "", closeBtn: !0, container: "page", floating: { position: "top-right", animationIn: "jellyIn", animationOut: "fadeOut" }, html: null, focus: !0, timer: 0, onShow: function () { }, onShown: function () { }, onHide: function () { }, onHidden: function () { } }, s), d = t('<div class="alert-wrap"></div>'), p = (a = h.closeBtn ? '<button class="close" type="button"><i class="fa fa-times-circle"></i></button>' : "", c = '<div class="alert alert-' + h.type + '" role="alert">' + a + '<div class="media">', h.html ? c + h.html + "</div></div>" : c + (r = "", s && s.icon && (r = '<div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="' + h.icon + '"></i></span></div>'), r) + '<div class="media-body"><h4 class="alert-title">' + h.title + '</h4><p class="alert-message">' + h.message + "</p></div></div>"), u = function (t) { return h.onHide(), "floating" === h.container && h.floating.animationOut && (d.removeClass(h.floating.animationIn).addClass(h.floating.animationOut), nifty.transition || (h.onHidden(), d.remove())), d.removeClass("in").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function (t) { "max-height" == t.originalEvent.propertyName && (h.onHidden(), d.remove()) }), clearInterval(l), null }, g = function (t) { nifty.bodyHtml.animate({ scrollTop: t }, 300, function () { d.addClass("in") }) }; !function () { if (h.onShow(), "page" === h.container) i || (i = t('<div id="page-alert"></div>'), nifty.contentContainer.prepend(i)), e = i, h.focus && g(0); else if ("floating" === h.container) n[h.floating.position] || (n[h.floating.position] = t('<div id="floating-' + h.floating.position + '" class="floating-container"></div>'), nifty.container.append(n[h.floating.position])), e = n[h.floating.position], h.floating.animationIn && d.addClass("in animated " + h.floating.animationIn), h.focus = !1; else { var s = t(h.container), l = s.children(".panel-alert"), r = s.children(".panel-heading"); if (!s.length) return o = !1, !1; l.length ? e = l : (e = t('<div class="panel-alert"></div>'), r.length ? r.after(e) : s.prepend(e)), h.focus && g(s.offset().top - 30) } o = !0 }(); if (o) { if (e.append(d.html(p)), d.find('[data-dismiss="noty"]').one("click", u), h.closeBtn && d.find(".close").one("click", u), h.timer > 0 && (l = setInterval(u, h.timer)), !h.focus) var f = setInterval(function () { d.addClass("in"), clearInterval(f) }, 200); d.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function (t) { "max-height" != t.originalEvent.propertyName && "animationend" != t.type || !o || (h.onShown(), o = !1) }) } } }(jQuery);







/*!
 FixedHeader 3.1.5
 ©2009-2018 SpryMedia Ltd - datatables.net/license
*/
(function(d){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(g){return d(g,window,document)}):"object"===typeof exports?module.exports=function(g,i){g||(g=window);if(!i||!i.fn.dataTable)i=require("datatables.net")(g,i).$;return d(i,g,g.document)}:d(jQuery,window,document)})(function(d,g,i,k){var j=d.fn.dataTable,l=0,h=function(a,b){if(!(this instanceof h))throw"FixedHeader must be initialised with the 'new' keyword.";!0===b&&(b={});a=new j.Api(a);this.c=d.extend(!0,
	{},h.defaults,b);this.s={dt:a,position:{theadTop:0,tbodyTop:0,tfootTop:0,tfootBottom:0,width:0,left:0,tfootHeight:0,theadHeight:0,windowHeight:d(g).height(),visible:!0},headerMode:null,footerMode:null,autoWidth:a.settings()[0].oFeatures.bAutoWidth,namespace:".dtfc"+l++,scrollLeft:{header:-1,footer:-1},enable:!0};this.dom={floatingHeader:null,thead:d(a.table().header()),tbody:d(a.table().body()),tfoot:d(a.table().footer()),header:{host:null,floating:null,placeholder:null},footer:{host:null,floating:null,
	placeholder:null}};this.dom.header.host=this.dom.thead.parent();this.dom.footer.host=this.dom.tfoot.parent();var e=a.settings()[0];if(e._fixedHeader)throw"FixedHeader already initialised on table "+e.nTable.id;e._fixedHeader=this;this._constructor()};d.extend(h.prototype,{enable:function(a){this.s.enable=a;this.c.header&&this._modeChange("in-place","header",!0);this.c.footer&&this.dom.tfoot.length&&this._modeChange("in-place","footer",!0);this.update()},headerOffset:function(a){a!==k&&(this.c.headerOffset=
	a,this.update());return this.c.headerOffset},footerOffset:function(a){a!==k&&(this.c.footerOffset=a,this.update());return this.c.footerOffset},update:function(){this._positions();this._scroll(!0)},_constructor:function(){var a=this,b=this.s.dt;d(g).on("scroll"+this.s.namespace,function(){a._scroll()}).on("resize"+this.s.namespace,j.util.throttle(function(){a.s.position.windowHeight=d(g).height();a.update()},50));var e=d(".fh-fixedHeader");!this.c.headerOffset&&e.length&&(this.c.headerOffset=e.outerHeight());
	e=d(".fh-fixedFooter");!this.c.footerOffset&&e.length&&(this.c.footerOffset=e.outerHeight());b.on("column-reorder.dt.dtfc column-visibility.dt.dtfc draw.dt.dtfc column-sizing.dt.dtfc responsive-display.dt.dtfc",function(){a.update()});b.on("destroy.dtfc",function(){a.c.header&&a._modeChange("in-place","header",true);a.c.footer&&a.dom.tfoot.length&&a._modeChange("in-place","footer",true);b.off(".dtfc");d(g).off(a.s.namespace)});this._positions();this._scroll()},_clone:function(a,b){var e=this.s.dt,
	c=this.dom[a],f="header"===a?this.dom.thead:this.dom.tfoot;!b&&c.floating?c.floating.removeClass("fixedHeader-floating fixedHeader-locked"):(c.floating&&(c.placeholder.remove(),this._unsize(a),c.floating.children().detach(),c.floating.remove()),c.floating=d(e.table().node().cloneNode(!1)).css("table-layout","fixed").attr("aria-hidden","true").removeAttr("id").append(f).appendTo("body"),c.placeholder=f.clone(!1),c.placeholder.find("*[id]").removeAttr("id"),c.host.prepend(c.placeholder),this._matchWidths(c.placeholder,
	c.floating))},_matchWidths:function(a,b){var e=function(b){return d(b,a).map(function(){return d(this).width()}).toArray()},c=function(a,c){d(a,b).each(function(a){d(this).css({width:c[a],minWidth:c[a]})})},f=e("th"),e=e("td");c("th",f);c("td",e)},_unsize:function(a){var b=this.dom[a].floating;b&&("footer"===a||"header"===a&&!this.s.autoWidth)?d("th, td",b).css({width:"",minWidth:""}):b&&"header"===a&&d("th, td",b).css("min-width","")},_horizontal:function(a,b){var e=this.dom[a],c=this.s.position,
	d=this.s.scrollLeft;e.floating&&d[a]!==b&&(e.floating.css("left",c.left-b),d[a]=b)},_modeChange:function(a,b,e){var c=this.dom[b],f=this.s.position,g=this.dom["footer"===b?"tfoot":"thead"],h=d.contains(g[0],i.activeElement)?i.activeElement:null;h&&h.blur();if("in-place"===a){if(c.placeholder&&(c.placeholder.remove(),c.placeholder=null),this._unsize(b),"header"===b?c.host.prepend(g):c.host.append(g),c.floating)c.floating.remove(),c.floating=null}else"in"===a?(this._clone(b,e),c.floating.addClass("fixedHeader-floating").css("header"===
	b?"top":"bottom",this.c[b+"Offset"]).css("left",f.left+"px").css("width",f.width+"px"),"footer"===b&&c.floating.css("top","")):"below"===a?(this._clone(b,e),c.floating.addClass("fixedHeader-locked").css("top",f.tfootTop-f.theadHeight).css("left",f.left+"px").css("width",f.width+"px")):"above"===a&&(this._clone(b,e),c.floating.addClass("fixedHeader-locked").css("top",f.tbodyTop).css("left",f.left+"px").css("width",f.width+"px"));h&&h!==i.activeElement&&setTimeout(function(){h.focus()},10);this.s.scrollLeft.header=
	-1;this.s.scrollLeft.footer=-1;this.s[b+"Mode"]=a},_positions:function(){var a=this.s.dt.table(),b=this.s.position,e=this.dom,a=d(a.node()),c=a.children("thead"),f=a.children("tfoot"),e=e.tbody;b.visible=a.is(":visible");b.width=a.outerWidth();b.left=a.offset().left;b.theadTop=c.offset().top;b.tbodyTop=e.offset().top;b.theadHeight=b.tbodyTop-b.theadTop;f.length?(b.tfootTop=f.offset().top,b.tfootBottom=b.tfootTop+f.outerHeight(),b.tfootHeight=b.tfootBottom-b.tfootTop):(b.tfootTop=b.tbodyTop+e.outerHeight(),
	b.tfootBottom=b.tfootTop,b.tfootHeight=b.tfootTop)},_scroll:function(a){var b=d(i).scrollTop(),e=d(i).scrollLeft(),c=this.s.position,f;if(this.s.enable&&(this.c.header&&(f=!c.visible||b<=c.theadTop-this.c.headerOffset?"in-place":b<=c.tfootTop-c.theadHeight-this.c.headerOffset?"in":"below",(a||f!==this.s.headerMode)&&this._modeChange(f,"header",a),this._horizontal("header",e)),this.c.footer&&this.dom.tfoot.length))b=!c.visible||b+c.windowHeight>=c.tfootBottom+this.c.footerOffset?"in-place":c.windowHeight+
	b>c.tbodyTop+c.tfootHeight+this.c.footerOffset?"in":"above",(a||b!==this.s.footerMode)&&this._modeChange(b,"footer",a),this._horizontal("footer",e)}});h.version="3.1.5";h.defaults={header:!0,footer:!1,headerOffset:0,footerOffset:0};d.fn.dataTable.FixedHeader=h;d.fn.DataTable.FixedHeader=h;d(i).on("init.dt.dtfh",function(a,b){if("dt"===a.namespace){var e=b.oInit.fixedHeader,c=j.defaults.fixedHeader;if((e||c)&&!b._fixedHeader)c=d.extend({},c,e),!1!==e&&new h(b,c)}});j.Api.register("fixedHeader()",function(){});
	j.Api.register("fixedHeader.adjust()",function(){return this.iterator("table",function(a){(a=a._fixedHeader)&&a.update()})});j.Api.register("fixedHeader.enable()",function(a){return this.iterator("table",function(b){b=b._fixedHeader;a=a!==k?a:!0;b&&a!==b.s.enable&&b.enable(a)})});j.Api.register("fixedHeader.disable()",function(){return this.iterator("table",function(a){(a=a._fixedHeader)&&a.s.enable&&a.enable(!1)})});d.each(["header","footer"],function(a,b){j.Api.register("fixedHeader."+b+"Offset()",
	function(a){var c=this.context;return a===k?c.length&&c[0]._fixedHeader?c[0]._fixedHeader[b+"Offset"]():k:this.iterator("table",function(c){if(c=c._fixedHeader)c[b+"Offset"](a)})})});return h});