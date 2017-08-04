/*
**************************************
* Event Listener Function v1.4       *
* Autor: Carlos R. L. Rodrigues      *
**************************************
*/
addEvent = function(o, e, f, s){
	var r = o[r = "_" + (e = "on" + e)] = o[r] || (o[e] ? [[o[e], o]] : []), a, c, d;
	r[r.length] = [f, s || o], o[e] = function(e){
		try{
			(e = e || event).preventDefault || (e.preventDefault = function(){e.returnValue = false;});
			e.stopPropagation || (e.stopPropagation = function(){e.cancelBubble = true;});
			e.target || (e.target = e.srcElement || null);
			e.key = (e.which + 1 || e.keyCode + 1) - 1 || 0;
		}catch(f){}
		for(d = 1, f = r.length; f; r[--f] && (a = r[f][0], o = r[f][1], a.call ? c = a.call(o, e) : (o._ = a, c = o._(e), o._ = null), d &= c !== false));
		return e = null, !!d;
    }
};

removeEvent = function(o, e, f, s){
	for(var i = (e = o["_on" + e] || []).length; i;)
		if(e[--i] && e[i][0] == f && (s || o) == e[i][1])
			return delete e[i];
	return false;
};

//Função que retorna um determinado parametro da URL
// - strParamName = Nome do Parametro a procurar
// - defaultValue = Valor padrão caso não ache o parametro
// - winFrame = local onde deve procurar (window ou frame especifico)
function getURLParam(strParamName, defaultValue, winFrame) {
	winFrame = winFrame && winFrame.location && winFrame.location.href ? winFrame : window;

    var strReturn = defaultValue;
    var strHref = winFrame.location.href;

    if ( strHref.indexOf("?") > -1 ) {
        var strQueryString = strHref.substr(strHref.indexOf("?")+1);
        var aQueryString = strQueryString.split("&");
        for (var iParam = 0; iParam < aQueryString.length; iParam++) {
            if (aQueryString[iParam].indexOf(strParamName + "=") > -1 ) {
                var aParam = aQueryString[iParam].split("=");
                strReturn = decodeURIComponent(aParam[1]);
                break;
            }
        }
    }
    return strReturn;
}

//Remove um parametro de um querystring
function removeURLParam(strQueryString, strParamName) {
	var hostPathName = "";
    if (strQueryString.indexOf("?") > -1) {
        hostPathName = strQueryString.substr(0,strQueryString.indexOf("?"));
        strQueryString = strQueryString.substr(strQueryString.indexOf("?")+1);
	    var aQueryString = strQueryString.split("&");
        strQueryString = "";
        for (var iParam = 0; iParam < aQueryString.length; iParam++) {
     	    if (aQueryString[iParam].indexOf(strParamName + "=") < 0 ) {
                if (strQueryString != "") {
                    strQueryString = strQueryString  + "&"; 
                }
       	        strQueryString = strQueryString + aQueryString[iParam];
	        }
        }
	} else {
		hostPathName = strQueryString;
		strQueryString = "";
	}
    return (hostPathName +'?'+ strQueryString);
}

//Adiciona a função trim ao Objeto String do JavaScript
String.prototype.trim = function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
}

//--------------------------------------------------
//BEGIN Tratamento de Erro
//--------------------------------------------------
function handleErr(msg, url, l)
{
	var txt = "Existe um erro nesta página.\n\n";
	txt += "Error: " + msg + "\n";
	txt += "URL: " + url + "\n";
	txt += "Line: " + l + "\n\n";
	txt += "Clique em OK para continuar.\n\n";
	alert(txt);
	return true;
}
//onerror=handleErr;
//--------------------------------------------------
//END Tratamento de Erro
//--------------------------------------------------

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/geral/hittest [v1.0]

hitTest = function(o, l){
	function getOffset(o){
		for(var r = {l: o.offsetLeft, t: o.offsetTop, r: o.offsetWidth, b: o.offsetHeight};
			o = o.offsetParent; r.l += o.offsetLeft, r.t += o.offsetTop);
		return r.r += r.l, r.b += r.t, r;
	}
	for(var b, s, r = [], a = getOffset(o), j = isNaN(l.length), i = (j ? l = [l] : l).length; i;
		b = getOffset(l[--i]), (a.l == b.l || (a.l > b.l ? a.l <= b.r : b.l <= a.r))
		&& (a.t == b.t || (a.t > b.t ? a.t <= b.b : b.t <= a.b)) && (r[r.length] = l[i]));
	return j ? !!r.length : r;
};

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/dhtml/drag-library [v1.1]

//=============================================================
// REQUIRES http://www.jsfromhell.com/geral/event-listener v1.4
//=============================================================

Dragger = function(o, a){
	var $ = this;
	o.style.position = "absolute", $.object = o, $.d = {x: 0, y: 0}, $.f = [];
	a && (addEvent(o, "mousedown", function(){return this.start(), false;}, $),
		addEvent(document, "mouseup", function(){this.dragging && this.stop();}, $));
}
with({p: Dragger.prototype, c: Dragger}){
	p._updateMouse = function(e){
		var w = window, b = document.documentElement;
		p.mouse = {x: e.clientX + (w.scrollX || b.scrollLeft || b.parentNode.scrollLeft || 0),
			y: e.clientY + (w.scrollY || b.scrollTop || b.parentNode.scrollTop || 0)};
	};
	addEvent(document, "mousemove", p._updateMouse);
	p.mouse = {x: 0, y: 0};
	p.dragging = false;
	p.start = function(center){
		var r, $ = this, m = $.mouse, o = $.object;
		for(var r = {l: o.offsetLeft, t: o.offsetTop, w: o.offsetWidth, h: o.offsetHeight};
			o = o.offsetParent; r.l += o.offsetLeft, r.t += o.offsetTop);
		!$.dragging && ($.dragging = true, o = $.object, $.d = center &&
			(m.x < r.l || m.x > r.l + r.w || m.y < r.t || m.y > r.t + r.h) ?
			{x: r.w / 2, y: r.h / 2} : {x: m.x - o.offsetLeft, y: m.y - o.offsetTop},
			addEvent(document, "mousemove", $.drag, $),
			this.callEvent("onstart"));
	};
	p.drag = function(e){
		var i, p, $ = this, o = $.object, m = ($._updateMouse(e), (m = $.mouse).x -= $.d.x, m.y -= $.d.y, m);
		for(i = $.f.length; i; $.f[--i] && $.f[i][0].apply(m, $.f[i][1]));
		o.style.left = m.x + "px", o.style.top = m.y + "px";
		return !!this.callEvent("ondrag", e);
	};
	p.stop = function(){
		this.dragging = false;
		removeEvent(document, "mousemove", this.drag, this);
		this.callEvent("onstop");
	};
	p.addFilter = function(f, arg0, arg1, arg2, argN){
		this.f[this.f.length] = [f, [].slice.call(arguments, 1)];
	};
	p.callEvent = function(e){
		return this[e] instanceof Function ? this[e].apply(this, [].slice.call(arguments, 1)) : undefined;
	};
}

//Standard Filters
Dragger.filters = new function(){
	function lineLength(x, y, x0, y0){
		return Math.sqrt((x -= x0) * x + (y -= y0) * y);
	}
	function dotLineLength(x, y, x0, y0, x1, y1, o){
		if(o && !(o = function(x, y, x0, y0, x1, y1){
			if(!(x1 - x0)) return {x: x0, y: y};
			else if(!(y1 - y0)) return {x: x, y: y0};
			var left, tg = -1 / ((y1 - y0) / (x1 - x0));
			return {x: left = (x1 * (x * tg - y + y0) + x0 * (x * - tg + y - y1)) /
				(tg * (x1 - x0) + y0 - y1), y: tg * left - tg * x + y};
		}(x, y, x0, y0, x1, y1), o.x >= Math.min(x0, x1) && o.x <= Math.max(x0, x1)
		&& o.y >= Math.min(y0, y1) && o.y <= Math.max(y0, y1))){
			var l1 = lineLength(x, y, x0, y0), l2 = lineLength(x, y, x1, y1);
			return l1 > l2 ? l2 : l1;
		}
		else{
			var a = y0 - y1, b = x1 - x0, c = x0 * y1 - y0 * x1;
			return Math.abs(a * x + b * y + c) / Math.sqrt(a * a + b * b);
		}
	}
	this.SQUARE = function(x, y, w, h){
		this.x = this.x < x ? x : this.x > x + w ? x + w : this.x,
		this.y = this.y < y ? y : this.y > y + h ? y + h : this.y;
	};
	this.CIRCLE = function(x, y, ray){
		var tg;
		lineLength(this.x, this.y, x += ray, y += ray) > ray &&
			(this.x = Math.cos(tg = Math.atan2(this.y - y, this.x - x)) * ray + x,
			this.y = Math.sin(tg) * ray + y);
	};
	this.LINE = function(x, y, angle){
		if(!(angle % 90))
			return this.x = x;
		var tg = Math.tan(-angle * Math.PI / 180);
		Math.sin(45 * Math.PI / 180) >= Math.sin(angle * Math.PI / 180) ?
			this.y = (this.x - x) * tg + y : this.x = (this.y - y) / tg + x;
	};
	this.POLY = function(x0, y0, x1, y1, etc, etc, etc){
		for(var a = [].slice.call(arguments, 0), lines = []; a.length > 3;
			lines[lines.length] = {y1: a.pop(), x1: a.pop(), y0: a.pop(), x0: a.pop()});
		if(!lines.length)
			return;
		for(var l, i = lines.length - 1, o = lines[i],
			lower = {i: i, l: dotLineLength(this.x,	this.y, o.x0, o.y0, o.x1, o.y1, 1)};
			i--; lower.l > (l = dotLineLength(this.x, this.y,
			(o = lines[i]).x0, o.y0, o.x1, o.y1, 1)) && (lower = {i: i, l: l}));
		this.y < Math.min((o = lines[lower.i]).y0, o.y1) ? this.y = Math.min(o.y0, o.y1)
			: this.y > Math.max(o.y0, o.y1) && (this.y = Math.max(o.y0, o.y1));
		this.x < Math.min(o.x0, o.x1) ? this.x = Math.min(o.x0, o.x1)
			: this.x > Math.max(o.x0, o.x1) && (this.x = Math.max(o.x0, o.x1));
		Math.abs(o.x0 - o.x1) < Math.abs(o.y0 - o.y1) ?
			this.x = (this.y * (o.x0 - o.x1) - o.x0 * o.y1 + o.y0 * o.x1) / (o.y0 - o.y1)
			: this.y = (this.x * (o.y0 - o.y1) - o.y0 * o.x1 + o.x0 * o.y1) / (o.x0 - o.x1);
	};
	this.CLIENTSIZE = function(o){
		var r = document.documentElement.clientWidth, b = document.documentElement.clientHeight;
		var s = o.style;
		var w = parseInt(s.width) + parseInt(s.borderLeftWidth) + parseInt(s.borderRightWidth);
		var h = parseInt(s.height) + parseInt(s.borderBottomWidth) + parseInt(s.borderTopWidth);
		this.x = this.x < 0 ? 0 : this.x > r - w ? r - w : this.x,
		this.y = this.y < 0 ? 0 : this.y > b - h ? b - h : this.y;
	};
};

//Classe para a construção de janelas
Janela = function(id, url, titulo, w, h, l, t){
	if (!w){ w = 115; }
	if (!h){ h = 115; }
  this.initialize(id, url, titulo, w, h, l, t);
};
/*
Janela = function(id, url, titulo, w, h){
	if (!w){ w = 100; }
	if (!h){ h = 100; }
  this.initialize(id, url, titulo, w, h);
};
*/
with({p: Janela.prototype}){
	p.refreshWindow = null;
	p.ccsForm = "";
	p.numReq = 0;
	p.errors = "";
	p.url = "";
	p.relativePath = "";
	p.dragger = null;

    p.initialize = function(id, url, titulo, w, h){
		var $ = this, o = null;
		$.url = url;
		$.ccsForm = id;

		//Procura e define o caminho relativo ao script
	    var objHead = document.getElementsByTagName("head")[0];
	    var listaScripts = document.getElementsByTagName("script"); //Todos os scripts do documento
	    for (var i=0 ; i < listaScripts.length ; i++) {
	        if (listaScripts[i].src.substring(listaScripts[i].src.lastIndexOf("/") + 1) == "Janelas.js") {
	            $.relativePath = listaScripts[i].src.substring(0, listaScripts[i].src.lastIndexOf("/") + 1);
	            break;
	        }
	    }

		o = document.createElement("div");
		o.id = id;
		o.name = "divJanela";
		o.className = "divJanela";
		o.zIndex = 100;
		o.style.display = "none";
		$.object = document.body.appendChild(o);

		$.header = {};
		o = document.createElement("div");
		o.className = "divHeader";
		o.id = id + "_" + o.className;
		//    addEvent(o, "click", function(){$.selected();}, $);
		$.header.object = $.object.appendChild(o);
		o = document.createElement("div");
		o.className = "divTituloHeader";
		o.id = id + "_" + o.className;
		o.innerHTML = titulo;
		$.header.desc = $.header.object.appendChild(o);

		o = document.createElement("div");
		o.className = "divFechar";
		o.id = id + "_" + o.className;
		o.innerHTML = "X";
		addEvent(o, "click", function(){$.close();}, $);
		$.header.fechar = $.header.object.appendChild(o);

		o = document.createElement("iframe");
		o.frameBorder = "no";
		o.className = "iframeFundo";
		o.id = id + "_" + o.className;
		$.fundo = $.object.appendChild(o);

		o = document.createElement("iframe");
		o.frameBorder = "no"; 
		o.className = "iframeConteudo";
		o.id = id + "_" + o.className;
		o.src = url;
		$.iframe = $.object.appendChild(o);

		//Cria a imagem de loading
		o = document.createElement("img");
		o.className = "janelaLoading";
		o.id = id + "_" + o.className;
		o.src = $.relativePath + "Imagens/loader.gif";
		o.zIndex = 999;
		o.width = "16";
		o.height = "16";
		o.style.position = "absolute";
		o.style.top = "60px";
		o.style.left = "50px";
		$.loader = $.object.appendChild(o);
		$.header.desc.innerHTML = "Carregando...";

		//Cria a propriedade de arrastar a janela
		$.dragger = new Dragger($.object, true);
		$.dragger.addFilter(Dragger.filters.CLIENTSIZE, $.object);
		$.dragger.onstart = function() {
			$.iframe.style.display = "none";
			$.fundo.style.display = "none";
		};
		$.dragger.onstop = function() {
			$.iframe.style.display = "";
			$.fundo.style.display = "";
		};

		//Cria o bloqueio de fundo da janela
//		o = document.createElement("div");
//		o.className = "janelaBloqueio";
//		o.id = id + "_" + o.className;
//		o.style.width = top.window.document.documentElement.clientWidth + "px";
//		o.style.height = top.window.document.documentElement.clientHeight + "px";
//			w = top.window.document.body.clientWidth;
//			h = top.window.document.body.clientHeight;
//		o.style.position = "absolute";
//		o.style.top = "0px";
//		o.style.left = "0px";
//		o.style.backgroundColor = "red";
//		$.bloqueio = top.window.document.body.appendChild(o);

		//Cria e adiciona no onload do iframe de conteudo o código que define as variaveis de vinculo da janela
		var func = function () {
			if ($.iframe && $.iframe.contentWindow && $.iframe.contentWindow.document) {
				$.iframe.contentWindow.thisJanela = $;
				$.window = $.iframe.contentWindow ? $.iframe.contentWindow : null;
				$.iframe.contentWindow.thisJanela.window = $.iframe.contentWindow ? $.iframe.contentWindow : null;
				$.document = $.iframe.contentWindow.document ? $.iframe.contentWindow.document : null;
				$.iframe.contentWindow.thisJanela.document = $.iframe.contentWindow.document ? $.iframe.contentWindow.document : null;

				//Processa o JSFunc do IFrame
				var jsfunc = getURLParam("JSFunc", "", $.iframe.contentWindow);
				if (jsfunc != "") {
					var thisJanela = $; //Solução provisória para solucionar a referência a thisJanela no OnLoad
					eval(decodeURIComponent(jsfunc));
				}

			}
			//Esconde o loader quando carregar a tela
			$.loader.style.display = "none";
			if ($ && $.header && $.header.desc && titulo) { 
				$.header.desc.innerHTML = titulo;
			}

		};
		if($.iframe && $.iframe.addEventListener){$.iframe.addEventListener("load", func, true)}else{if($.iframe && $.iframe.attachEvent){$.iframe.attachEvent("onload", func)}}


		//Style
		var  sobj  = $.object.style
			,sfun  = $.fundo.style
			,shead = $.header.object.style
			,sifr  = $.iframe.style;

		var  sbtnf = $.header.fechar.style
			,sdesc = $.header.desc.style;
		
		//Div Janela
		sobj.display = "none"; 
		sobj.position = "absolute"; 
		sobj.left = 0+'px'; sobj.top = 0+'px';
		sobj.margin = 0+'px';
		sobj.padding = 0+'px';
		sobj.border = "0px";
		sobj.background = "white";
		sobj.boxShadow = "0px 0px 10px #888888";
		
		//IFrame Fundo
		sfun.position = "absolute"; 
		sfun.left = 0+'px'; 
		sfun.top = 0+'px';
		sfun.frameBorder = "no"; 
		sfun.src = "about:blank"; 
		sfun.background = "transparent";
		sfun.zIndex = parseInt("0" + sobj.zIndex) - 10;
		sfun.margin = 0+'px';
		sfun.padding = 0+'px';
		sfun.border = "0px red none";

		//Div Header
		shead.display = "block"; 
		shead.cursor = "move";
		//shead.backgroundImage = "url('"+$.relativePath+"Imagens/HeaderBg.gif')"; //falta definição do caminho relativo
		shead.border = "0px black none";
		//shead.border = "1px solid #3d84cc";
		sdesc.width = "100%";
		sdesc.height = 22+'px';
		shead.margin = 0+'px';
		shead.padding = 0+'px';
		shead.whiteSpace = "nowrap";
		shead.background = "#eb5055";	

		//Titulo
		sdesc.width = "auto";
		sdesc.border = "0px green none";
		sdesc.whiteSpace = "nowrap";
		sdesc.position = "absolute";
		sdesc.top = 3+'px';
		sdesc.left = 3+'px';
		sdesc.color = "white";
		sdesc.textAlign = "center";
		sdesc.textIndent = 10+'px';
		sdesc.fontFamily = "arial";
		sdesc.fontWeight = "bold";
		sdesc.fontSize = 12+'px';
		sdesc.backgroundRepeat = "no-repeat";

		//Div Fechar
		sbtnf.position = "absolute";
		sbtnf.right = 3+'px';
		sbtnf.top = 3+'px';
		sbtnf.cursor = "pointer"; 
		sbtnf.width = 14+'px';
		sbtnf.height = 14+'px';
		sbtnf.padding = 0+'px';
		sbtnf.margin = 0+'px';
		sbtnf.background = "#E75853";
		sbtnf.lineHeight = "14px";
		sbtnf.fontSize = "11px";
		sbtnf.fontWeight = "bold";
		sbtnf.textAlign = "center";
		sbtnf.color = "white";
		sbtnf.fontFamily = "arial";
		sbtnf.cursor = "pointer";
		sbtnf.border = "1px solid #d43f3a";
		sbtnf.borderRadius = "2px";

		//Iframe Conteudo
		sifr.border = "0px black none";
		sifr.background = "transparent";
		sifr.frameBorder = "no"; 
		sifr.margin = 0+'px';
		sifr.padding = 0+'px';

		//Define altura e largura
		$.setWidth(w);
		$.setHeight(h);
		$.center();
		$.hide();
		$.autoSize();
	};

	p.setWidth = function(w){
        var $ = this, sobj = $.object.style, sfun = $.fundo.style;
		var shead = $.header.object.style, sifr = $.iframe.style;
		w = w - parseInt(sobj.borderLeftWidth) - parseInt(sobj.borderRightWidth); //Por causa da borda da Div Janela
		sobj.width = w+'px'; sfun.width = w+'px'; sifr.width = w+'px'; shead.width = w+'px'; 
	};
	p.setHeight = function(h){
        var $ = this, sobj = $.object.style, sfun = $.fundo.style;
		var shead = $.header.object.style, sifr = $.iframe.style;
		h = h - parseInt(sobj.borderBottomWidth) - parseInt(sobj.borderTopWidth); //Por causa da borda da Div Janela
		shead.height = '22px'; 
		sfun.height = h+'px'; sobj.height = h+'px'; 
		sifr.height = parseInt(h - parseInt(shead.height))+'px'; 
	};
	p.position = function(t,l){
		var $ = this, sd = $.object.style;
		sd.top = t+'px';
		sd.left = l+'px';
	};
	p.show = function(){
		var $ = this, sd = $.object.style;
		var func = function(){ 
			$.onLoad && $.onLoad($);
			//Define o foco no primeiro campo ou na própria janela
			var forms = $.iframe.contentWindow.document.forms;
			if (forms.length > 0)
			{
				if (forms[0].elements.length > 0)
				{
					forms[0].elements[0].focus(); 
				}
				else
				{
					$.iframe.contentWindow.focus();
				}
			}
			else
			{
				$.iframe.contentWindow.focus();
			}
		};
		if($.iframe.addEventListener){$.iframe.addEventListener("load", func, true)}else{if($.iframe.attachEvent){$.iframe.attachEvent("onload", func)}}

		$.onBeforeShow && $.onBeforeShow($);
		sd.display = "block";

		$.onShow && $.onShow($);
	};
	p.hide = function(){
		var $ = this, sd = $.object.style;
		$.onBeforeClose && $.onBeforeClose($);//para compatibilidade com o codigo antigo
		sd.display = "none";
		$.onHide && $.onHide($);
		$.onClose && $.onClose($); //para compatibilidade com o codigo antigo
		window.focus();
	};
	p.center = function(){
		var $ = this, sd = $.object.style;

		var l = document.documentElement.scrollLeft + ((document.documentElement.clientWidth - parseInt(sd.width))/2);
		var t = window.pageYOffset + ((document.documentElement.clientHeight - parseInt(sd.height))/2);
		
		if( navigator.appName == "Microsoft Internet Explorer" ){
			l = document.documentElement.scrollLeft + ((document.documentElement.clientWidth - parseInt(sd.width))/2);
			t = document.documentElement.scrollTop + ((document.documentElement.clientHeight - parseInt(sd.height))/2);
		}

		l = ( l > 0 ) ? l : 0 ;
		t = ( t > 0 ) ? t : 0 ;

		$.position(t,l);
	};
	p.close = function(){
		var $ = this, o, sd = $.object.style;
		$.onBeforeClose && $.onBeforeClose($);

		sd.display = "none"; o = document.body.removeChild($.object); o = null; 
		$.header = null; $.fundo = null; $.iframe = null; $.object = null; 
		
		$.onClose && $.onClose($);
		window.focus();
	};
	p.reload = function(){
		var $ = this;
		$.iframe.src = $.url;
	};
	p.onCloseRefresh = function(w){
		var $ = this;
		$.onBeforeClose = function(r){
			if (!w) { w = top.window; }
			var href = removeURLParam(w.location.href, "JSFunc");
			href = removeURLParam(href, "ccsForm");
			w.location.href = href;
		};
	};
	p.autoCloseMaint = function(f, w, r, a){
		var $ = this, s = $.iframe.contentWindow; 
		if (f) { $.ccsForm = f;	}
		var func = function(e){
			var func2 = function(e){
				var func3 = function(e){
					if (getURLParam("ccsForm", "", s) == $.ccsForm ||
						getURLParam("ccsForm", "", s) == $.ccsForm+"%3AEdit" ||
						getURLParam("ccsForm", "", s) == $.ccsForm+":Edit") {
						//Errors
					} else {
						$.onAutoCloseMaintSuccess && $.onAutoCloseMaintSuccess($);

						//$.close();
						$.hide();
						if(w) {
							var href = removeURLParam(w.location.href, "JSFunc");
							href = removeURLParam(href, "ccsForm");
							
							for(i in a) { 
								href = CCAddParam(href, i, a[i]);
							}

							for (x in r) {
								href = removeURLParam(href, r[x]);
							}

						    w.location.href = href;
						} else if ($.refreshWindow) {
						    $.refreshWindow.location.href = removeURLParam($.refreshWindow.location.href, "JSFunc");
						}
					}
				};
				//Remove primeiro onload do iframe
				if($.iframe && $.iframe.removeEventListener){$.iframe.removeEventListener("load", func, true)}else{if($.iframe && $.iframe.detachEvent){$.iframe.detachEvent("onload", func)}}
				if($.iframe && $.iframe.addEventListener){$.iframe.addEventListener("load", func3, true);}else{if($.iframe && $.iframe.attachEvent){$.iframe.attachEvent("onload", func3);}}
			};
			if (s.document) { 
				if (s.document.getElementsByName($.ccsForm)[0]) {
					addEvent(s.document.getElementsByName($.ccsForm)[0], "submit", func2); 
				} else if (s.document.getElementById($.ccsForm)) {
					addEvent(s.document.getElementById($.ccsForm), "submit", func2); 
				}
			}
		};
		if($.iframe && $.iframe.addEventListener){$.iframe.addEventListener("load", func, true)}else{if($.iframe && $.iframe.attachEvent){$.iframe.attachEvent("onload", func)}}
	};

	p.camposSelecionar = function(campoCodigo, campoDescricao){
		var $ = this;
	
    	func = function() {
        	var ancoras = $.iframe.contentWindow.document.getElementsByTagName("a");
        	for (var i = 0; i < ancoras.length; i++ ) {
        		if ( ancoras[i].attributes.codigo && ancoras[i].attributes.codigo.value 
                	&& ancoras[i].attributes.descricao && ancoras[i].attributes.descricao.value 
            	) {
                	addEvent(ancoras[i], "click", function() {
						if (campoCodigo) { campoCodigo.value = this.attributes.codigo.value; }
						if (campoDescricao) { campoDescricao.value = this.attributes.descricao.value; }
						if (campoCodigo) { campoCodigo.focus(); } else { campoDescricao.focus(); }
	                    $.close();
	                });
	            }
	        }
	    };
		if($.iframe.addEventListener){$.iframe.addEventListener("load", func, true)}else{if($.iframe.attachEvent){$.iframe.attachEvent("onload", func)}}
	};

	p.resize = function(){
		var $ = this;

        //para evitar problema no IE quando tem autoCloseMaint.
        if (! $.iframe) { return false; }

		var s = $.iframe.contentWindow.document.documentElement;
		var w = 0; 
		var h = 0;
		//Soma pois w (width) e h (height) são do iframe Conteudo e não da janela inteira
        var sobj = $.object.style;
		var shead = $.header.object.style;
		w = w + parseInt(sobj.borderLeftWidth) + parseInt(sobj.borderRightWidth); //Por causa da borda da Div Janela
		h = h + parseInt(sobj.borderTopWidth) + parseInt(sobj.borderBottomWidth); //Por causa da borda da Div Janela

		w = w + parseInt(sobj.marginLeft) + parseInt(sobj.marginRight); //Por causa da margem da Div Janela
		h = h + parseInt(sobj.marginTop) + parseInt(sobj.marginBottom); //Por causa da margem da Div Janela

		w = w + parseInt(sobj.paddingLeft) + parseInt(sobj.paddingRight); //Por causa do espaçamento da Div Janela
		h = h + parseInt(sobj.paddingTop) + parseInt(sobj.paddingBottom); //Por causa do espaçamento da Div Janela

		h = h + parseInt(shead.height) + parseInt(shead.borderTopWidth) + parseInt(shead.borderBottomWidth); //Por causa do Header da Janela
		h = h + parseInt(shead.marginTop) + parseInt(shead.marginBottom); //Por causa do Header da Janela
		h = h + parseInt(shead.paddingTop) + parseInt(shead.paddingBottom); //Por causa do Header da Janela

		//Define a largura do Scroll
		var scroll = 17; //em pixel
		
		//Obtém o elemento que tem o tamanho disponível na tela
		var corpo = document.documentElement;

		//Se a largura possivel para a janela for menor que a disponivel
		if (corpo.clientWidth > w + s.scrollWidth) {
			w = w + s.scrollWidth;
		} else { 
			w = corpo.clientWidth;
			//Avalia se tem espaço na altura para o scroll
			if (h + scroll < corpo.clientHeight) {
				h = h + scroll;
			}
		}

		//Faz o tratamento para o IE e Firefox
		if (navigator.appName.indexOf("Microsoft") != -1) {
			//Se a altura possivel para a janela for menor que a disponivel
			if (corpo.clientHeight > h + s.scrollHeight) {
				h = h + s.scrollHeight;
			} else {
				h = corpo.clientHeight;
				//Avalia se tem espaço na largura para o scroll
				if (w + scroll < corpo.clientWidth) {
					w = w + scroll;
				}
			}
		} else {
			h = h + 1; //para ajustar determinadas telas no Firefox 3 que estavam abrindo com tamanho errado
			//Se a altura possivel para a janela for menor que a disponivel
			if (corpo.clientHeight > h + s.offsetHeight) {
				h = h + s.offsetHeight;
			} else {
				h = corpo.clientHeight;
				//Avalia se tem espaço na largura para o scroll
				if (w + scroll < corpo.clientWidth) {
					w = w + scroll;
				}
			}
		}

		$.setWidth(w);
		$.setHeight(h);
		$.center();
	};
	p.autoSize = function(){
		var $ = this;
		var func = function(){ $.resize(); };
		if($.iframe.addEventListener){$.iframe.addEventListener("load", func, true);}else{if($.iframe.attachEvent){$.iframe.attachEvent("onload", func);}}
	};
	p.fullScreen = function(){
		var $ = this;
		var func = function(){ 
			$.resize(); 
			var w = 100; h = 100;
			w = top.window.document.documentElement.clientWidth;
			h = top.window.document.documentElement.clientHeight;

			$.setWidth(w);
			$.setHeight(h);
			$.position(0,0);
		};
		if($.iframe.addEventListener){$.iframe.addEventListener("load", func, true);}else{if($.iframe.attachEvent){$.iframe.attachEvent("onload", func);}}
	};
};

inicializeScriptJanela = function() {
    var objHead = document.getElementsByTagName("head")[0];
    var listaScripts = document.getElementsByTagName("script"); //Todos os scripts do documento
	var RegExpScript = new RegExp("[=/]?Functions.js[&]?");
	var temFunctionsJS = false;
	var RelativePath = "";
    for (var i=0 ; i < listaScripts.length ; i++) {
        if (listaScripts[i].src.substring(listaScripts[i].src.lastIndexOf("/") + 1) == "Janelas.js") {
            var pathStyle = listaScripts[i].src.substring(0, listaScripts[i].src.lastIndexOf("/") + 1);
            pathStyle = pathStyle + "Janelas.css";
			
            var linkEstilo;
            linkEstilo = document.createElement("link");
            linkEstilo.setAttribute("type", "text/css");
            linkEstilo.setAttribute("id", "EstiloJanelas");
            linkEstilo.setAttribute("rel", "stylesheet");
            linkEstilo.setAttribute("href", pathStyle);
            objHead.appendChild(linkEstilo);

            RelativePath = listaScripts[i].attributes.getNamedItem("src").value;
			RelativePath = RelativePath.substring(0, RelativePath.lastIndexOf("../") + 3);

        }

		if (!temFunctionsJS) {
			temFunctionsJS = RegExpScript.test(listaScripts[i].src);
		}

    }

	if ( !temFunctionsJS ) {
        var scriptScript;
        scriptScript = document.createElement("script");
        scriptScript.setAttribute("type", "text/javascript");
        scriptScript.setAttribute("language", "JavaScript");
		scriptScript.setAttribute("charset", "utf-8");
        scriptScript.setAttribute("src", RelativePath + "ClientI18N.php?file=Functions.js&locale=pt-BR");
        objHead.appendChild(scriptScript);
	}

	var jsfunc = getURLParam("JSFunc", "", window);
	if (jsfunc != "") {
		eval(decodeURIComponent(jsfunc));
	}
};

addEvent(window, "load", inicializeScriptJanela);