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

var _height = window.innerHeight;
var _scroll = window.scrollY;
/**
 * ARS1
 */

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
  var _slider = $(".js-slide");

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
/*
const carouselCartelera = () => {
  let _slider = $("#cartelera");
  _slider.owlCarousel({
    items: 4,
    margin: 30,
    autoplay: true,
    autoplayHoverPause: true
  });
}
carouselCartelera();
*/

var fixedHeader = function fixedHeader() {
  var _header;

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
 * CLASES
 */


var ARS1Galeria =
  /*#__PURE__*/
  function() {
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

          $(_items).attr('data-fancybox', "group".concat(i));
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