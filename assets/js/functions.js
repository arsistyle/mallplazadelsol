"use strict";

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) {
      descriptor.writable = true;
    }
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) {
    _defineProperties(Constructor.prototype, protoProps);
  }
  if (staticProps) {
    _defineProperties(Constructor, staticProps);
  }
  return Constructor;
}

function _createForOfIteratorHelper(o, allowArrayLike) {
  var it;
  if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {
    if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
      if (it) {
        o = it;
      }
      var i = 0;
      var F = function F() {};
      return {
        s: F,
        n: function n() {
          if (i >= o.length) {
            return {
              done: true
            };
          }
          return {
            done: false,
            value: o[i++]
          };
        },
        e: function e(_e) {
          throw _e;
        },
        f: F
      };
    }
    throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
  }
  var normalCompletion = true,
    didErr = false,
    err;
  return {
    s: function s() {
      it = o[Symbol.iterator]();
    },
    n: function n() {
      var step = it.next();
      normalCompletion = step.done;
      return step;
    },
    e: function e(_e2) {
      didErr = true;
      err = _e2;
    },
    f: function f() {
      try {
        if (!normalCompletion && it["return"] != null) {
          it["return"]();
        }
      } finally {
        if (didErr) {
          throw err;
        }
      }
    }
  };
}

function _unsupportedIterableToArray(o, minLen) {
  if (!o) {
    return;
  }
  if (typeof o === "string") {
    return _arrayLikeToArray(o, minLen);
  }
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) {
    n = o.constructor.name;
  }
  if (n === "Map" || n === "Set") {
    return Array.from(o);
  }
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) {
    return _arrayLikeToArray(o, minLen);
  }
}

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) {
    len = arr.length;
  }
  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }
  return arr2;
}

var _width = window.innerWidth;
var _height = window.innerHeight;
var _scroll = window.scrollY;
/**
 * ARS1
 */

var _clearAlerta;

var ars1 = {
  scrolling: function scrolling(fun) {
    _scroll = window.scrollY;

    if (typeof fun === 'function') {
      fun();
      document.addEventListener('scroll', function() {
        _scroll = window.scrollY;
        fun();
      });
    } else {
      console.warn('fln.scrolling(¿function?) : Se debe pasar una función como argumento');
    }
  },
  responsive: function responsive(fun) {
    _width = window.innerWidth;
    _height = window.innerHeight;

    if (typeof fun === 'function') {
      fun();
      window.addEventListener('resize', function(event) {
        _width = window.innerWidth;
        _height = window.innerHeight;
        fun();
      });
    } else {
      console.warn("fln.responsive(\xBFfunction?) : Se debe pasar una funci\xF3n como argumento");
    }
  },
  multipleEventsListeners: function multipleEventsListeners(elem, events, func) {
    events = events.split(' ');

    var _iterator = _createForOfIteratorHelper(events),
      _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var evento = _step.value;
        elem.addEventListener(evento, func, false);
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  },
  alerta: function alerta(opciones) {
    var _opciones = {
      selector: opciones.selector,
      texto: opciones.texto ? opciones.texto : 'Aquí deberias pasar tu mensaje',
      tipo: opciones.tipo ? opciones.tipo : false,
      altoContraste: opciones.altoContraste ? opciones.altoContraste : false,
      // TODO: Ver la posibilidad de asignar ancho full y automatico
      //ancho: opciones.ancho ? opciones.ancho : '',
      // TODO: Ver la posibilidad de mostrar distintos tamaños de alerta
      //size: opciones.size ? opciones.size : '',
      posicion: opciones.posicion ? opciones.posicion : 'top',
      tiempo: opciones.tiempo ? opciones.tiempo : 5000
    };
    var _tipoAlertas = ['alerta--exito', 'alerta--error', 'alerta--info', 'alerta--aviso', 'alerta--hc'];

    if (!_opciones.selector) {
      var _alerta = document.createElement('div');

      var _alertaAnterior = document.querySelector('.alerta--global');

      var _body = document.querySelector('body');

      if (_alertaAnterior) {
        _alertaAnterior.remove();
      }

      _alerta.className = "alerta alerta--global ".concat(_opciones.tipo ? "alerta--".concat(_opciones.tipo) : '', " alerta--fixed-").concat(_opciones.posicion, " ").concat(_opciones.altoContraste ? "alerta--hc" : '');
      _alerta.innerText = _opciones.texto;

      _body.appendChild(_alerta);

      clearInterval(_clearAlerta);
      _clearAlerta = setInterval(function() {
        _alerta.remove();
      }, _opciones.tiempo);
    } else {
      var _alerta2 = document.querySelector(_opciones.selector);

      if (_opciones.texto) {
        _alerta2.innerText = _opciones.texto;
      }

      if (_opciones.tipo) {
        var _alerta2$classList;

        (_alerta2$classList = _alerta2.classList).remove.apply(_alerta2$classList, _tipoAlertas);

        _alerta2.classList.add("alerta--".concat(_opciones.tipo));
      }

      $(_alerta2).slideDown('fast');
      clearInterval(_clearAlerta);
      _clearAlerta = setInterval(function() {
        $(_alerta2).slideUp('fast');
      }, _opciones.tiempo);
    }
  },
  init: function init() {}
};
/**
 * MENU RESPONSIVE
 */

var menuResponsive = {
  toggle: function toggle() {
    var _clasName = 'menu-responsive-active';

    var _body = document.querySelector('body');

    var _class = _body.classList.contains(_clasName);

    if (_class) {
      _body.classList.remove(_clasName);
    } else _body.classList.add(_clasName);
  }
};
/**
 * SLIDER PRINCIPAL
 */

var slider = function slider() {
  var _slider = $('.js-slide');

  _slider.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: ["<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"162\" height=\"279\" viewBox=\"0 0 161.7 278.7\"><polygon class=\"st0\" points=\"139.1 278.7 161.7 256.1 45 139.4 161.7 22.6 139.1 0 0 139.1 0 139.6 \"/></svg>", "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"162\" height=\"279\" viewBox=\"0 0 161.7 278.7\"><polygon class=\"st0\" points=\"22.6 0 0 22.6 116.7 139.4 0 256.1 22.6 278.7 161.7 139.6 161.7 139.1 \"/></svg>"],
    responsive: {
      0: {
        nav: false,
        dots: true
      },
      768: {
        nav: true,
        dots: false
      }
    }
  });
};

slider();

var fixedHeader = function fixedHeader() {
  var _body = document.querySelector('body');

  ars1.responsive(function() {
    ars1.scrolling(function() {
      if (_scroll > 0) {
        _body.classList.add('scrolled');
      } else {
        _body.classList.remove('scrolled');
      }
    });
  });
};

fixedHeader();
var observer = lozad();
observer.observe();

if ($('.rellax').length) {
  var rellax = new Rellax('.rellax');
}
/**
 * ACCORDEON TIENDAS
 */


var ACCORDEON_TIENDAS = function ACCORDEON_TIENDAS() {
  var accordeon = document.querySelector('.tiendas__accordeon');
  var categorias = document.querySelector('.tiendas__categorias');
  var state = 1;

  if (accordeon) {
    accordeon.addEventListener('click', function(event) {
      if (state) {
        accordeon.classList.add('active');
        $(categorias).slideDown('fast');
        state = 0;
      } else {
        state = 1;
        $(categorias).slideUp('fast');
        accordeon.classList.remove('active');
      }
    });
    ars1.responsive(function() {
      if (_width >= 768) {
        state = 1;
        accordeon.classList.remove('active');
        $(categorias).show();
      }
    });
  }
};

ACCORDEON_TIENDAS();
/**
 * CLASES
 */

var ARS1Galeria = /*#__PURE__*/ function() {
  function ARS1Galeria() {
    var selector = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.js-galeria';
    var opciones = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {
      cantidadItems: undefined
    };

    _classCallCheck(this, ARS1Galeria);

    this.selector = selector;
    this.item = 'ars1-galeria__item';
    this.opciones = opciones;
  }

  _createClass(ARS1Galeria, [{
    key: "crear",
    value: function crear() {
      var _this2 = this;

      var _galerias = document.querySelectorAll(this.selector);

      var _a = _galerias;

      var _f = function _f(el, i) {
        var _this = el;

        var _items = _this.querySelectorAll('.ars1-galeria__item');

        var _grupo = _this.getAttribute('data-group') ? _this.getAttribute('data-group') : 'group';

        if (_this.getAttribute('data-items')) {
          _this2.opciones.cantidadItems = Number(_this.getAttribute('data-items'));
        }

        var _n = Number(_this2.opciones.cantidadItems);

        if (_n) {
          var _restantes = _items.length;

          if (_restantes > _n) {
            var _num = _restantes - _n;

            var _lastItem = _items[_n - 1];

            var _capa = document.createElement('span');

            _lastItem.querySelector('.ars1-galeria__ico').remove();

            _capa.classList.add('ars1-galeria__mas', 'ars1-galeria__capa');

            _capa.innerText = "+ ".concat(_num);

            _lastItem.appendChild(_capa);

            for (var _i2 = 0; _i2 < _items.length; _i2++) {
              if (_i2 >= _n) {
                _items[_i2].style.display = 'none';
              }
            }
          }
        }

        $(_items).attr('data-fancybox', "".concat(_grupo, "-").concat(i));
      };

      for (var _i = 0; _i < _a.length; _i++) {
        _f(_a[_i], _i, _a);
      }

      undefined;
    }
  }, {
    key: "init",
    value: function init() {
      this.crear();
    }
  }]);

  return ARS1Galeria;
}();

$('.ars1-galeria__item').fancybox({
  caption: function caption(instance, item) {
    return $(this).find('figcaption').html();
  },
  lang: 'es',
  i18n: {
    es: {
      CLOSE: 'Cerrar',
      NEXT: 'Siguiente',
      PREV: 'Anterior',
      ERROR: 'El contenido no se pudo cargar.',
      PLAY_START: 'Comenzar presentación',
      PLAY_STOP: 'Pausar presentación',
      FULL_SCREEN: 'Pantalla completa',
      THUMBS: 'Miniaturas',
      DOWNLOAD: 'Descargar',
      SHARE: 'Compartir',
      ZOOM: 'Zoom'
    }
  }
});

var _galeria = new ARS1Galeria();

_galeria.init();

ars1.multipleEventsListeners(document, 'wpcf7invalid wpcf7spam wpcf7mailfailed wpcf7mailsent', function(event) {
  console.log(event);
  $('.wpcf7-response-output').remove();
});
/* Validation Events for changing response CSS classes */

document.addEventListener('wpcf7submit', function(event) {
  alert('Fire!');
}, false);
document.addEventListener('wpcf7invalid', function(event) {
  ars1.alerta({
    selector: '.js-alerta-contacto',
    texto: 'Revisa los campos que están con error',
    tipo: 'error'
  });
}, false);
document.addEventListener('wpcf7spam', function(event) {}, false);
document.addEventListener('wpcf7mailfailed', function(event) {
  ars1.alerta({
    selector: '.js-alerta-contacto',
    texto: 'Ocurrió un error al enviar tu mensaje, prueba reintentar',
    tipo: 'error'
  });
}, false);
document.addEventListener('wpcf7mailsent', function(event) {
  ars1.alerta({
    selector: '.js-alerta-contacto',
    texto: 'Tu mensaje ha sido enviado con éxito, nos contactaremos contigo a la brevedad',
    tipo: 'exito'
  });
}, false);