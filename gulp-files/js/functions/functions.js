let _width = window.innerWidth;
let _height = window.innerHeight;
let _scroll = window.scrollY;

/**
 * ARS1
 */
let _clearAlerta;
const ars1 = {
  scrolling(fun) {
    _scroll = window.scrollY;
    if (typeof fun === 'function') {
      fun();
      document.addEventListener('scroll', () => {
        _scroll = window.scrollY;
        fun();
      });
    } else {
      console.warn('fln.scrolling(¿function?) : Se debe pasar una función como argumento');
    }
  },
  responsive(fun) {
    _width = window.innerWidth;
    _height = window.innerHeight;

    if (typeof fun === 'function') {
      fun();
      window.addEventListener('resize', (event) => {
        _width = window.innerWidth;
        _height = window.innerHeight;
        fun();
      });
    } else {
      console.warn(`fln.responsive(¿function?) : Se debe pasar una función como argumento`);
    }
  },
  multipleEventsListeners(elem, events, func) {
    events = events.split(' ');
    for (let evento of events) {
      elem.addEventListener(evento, func, false);
    }
  },
  alerta(opciones) {
    let _opciones = {
      selector: opciones.selector,
      texto: opciones.texto ? opciones.texto : 'Aquí deberias pasar tu mensaje',
      tipo: opciones.tipo ? opciones.tipo : false,
      altoContraste: opciones.altoContraste ? opciones.altoContraste : false,

      // TODO: Ver la posibilidad de asignar ancho full y automatico
      //ancho: opciones.ancho ? opciones.ancho : '',

      // TODO: Ver la posibilidad de mostrar distintos tamaños de alerta
      //size: opciones.size ? opciones.size : '',

      posicion: opciones.posicion ? opciones.posicion : 'top',
      tiempo: opciones.tiempo ? opciones.tiempo : 5000,
    };

    const _tipoAlertas = ['alerta--exito', 'alerta--error', 'alerta--info', 'alerta--aviso', 'alerta--hc'];

    if (!_opciones.selector) {
      const _alerta = document.createElement('div');
      const _alertaAnterior = document.querySelector('.alerta--global');
      const _body = document.querySelector('body');
      if (_alertaAnterior) _alertaAnterior.remove();
      _alerta.className = `alerta alerta--global ${_opciones.tipo ? `alerta--${_opciones.tipo}` : ''} alerta--fixed-${_opciones.posicion} ${_opciones.altoContraste ? `alerta--hc` : ''}`;
      _alerta.innerText = _opciones.texto;
      _body.appendChild(_alerta);
      clearInterval(_clearAlerta);
      _clearAlerta = setInterval(() => {
        _alerta.remove();
      }, _opciones.tiempo);
    } else {
      const _alerta = document.querySelector(_opciones.selector);
      if (_opciones.texto) _alerta.innerText = _opciones.texto;
      if (_opciones.tipo) {
        _alerta.classList.remove(..._tipoAlertas);
        _alerta.classList.add(`alerta--${_opciones.tipo}`);
      }
      $(_alerta).slideDown('fast');
      clearInterval(_clearAlerta);
      _clearAlerta = setInterval(() => {
        $(_alerta).slideUp('fast');
      }, _opciones.tiempo);
    }
  },
  init() {},
};

/**
 * MENU RESPONSIVE
 */

const menuResponsive = {
  toggle() {
    const _clasName = 'menu-responsive-active';
    const _body = document.querySelector('body');
    const _class = _body.classList.contains(_clasName);
    if (_class) _body.classList.remove(_clasName);
    else _body.classList.add(_clasName);
  },
};

/**
 * SLIDER PRINCIPAL
 */
const slider = () => {
  let _slider = $('.js-slide');
  _slider.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: [
      `<svg xmlns="http://www.w3.org/2000/svg" width="162" height="279" viewBox="0 0 161.7 278.7"><polygon class="st0" points="139.1 278.7 161.7 256.1 45 139.4 161.7 22.6 139.1 0 0 139.1 0 139.6 "/></svg>`,
      `<svg xmlns="http://www.w3.org/2000/svg" width="162" height="279" viewBox="0 0 161.7 278.7"><polygon class="st0" points="22.6 0 0 22.6 116.7 139.4 0 256.1 22.6 278.7 161.7 139.6 161.7 139.1 "/></svg>`,
    ],
    responsive: {
      0: {
        nav: false,
        dots: true,
      },
      768: {
        nav: true,
        dots: false,
      },
    },
  });
};
slider();

const fixedHeader = () => {
  let _body = document.querySelector('body');
  ars1.responsive(() => {
    ars1.scrolling(() => {
      if (_scroll > 0) {
        _body.classList.add('scrolled');
      } else {
        _body.classList.remove('scrolled');
      }
    });
  });
};
fixedHeader();

const observer = lozad();
observer.observe();

if ($('.rellax').length) {
  let rellax = new Rellax('.rellax');
}

/**
 * ACCORDEON TIENDAS
 */

const ACCORDEON_TIENDAS = () => {
  const accordeon = document.querySelector('.tiendas__accordeon');
  const categorias = document.querySelector('.tiendas__categorias');
  let state = 1;
  if (accordeon) {
    accordeon.addEventListener('click', (event) => {
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
    ars1.responsive(() => {
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

class ARS1Galeria {
  constructor(
    selector = '.js-galeria',
    opciones = {
      cantidadItems: undefined,
    }
  ) {
    this.selector = selector;
    this.item = 'ars1-galeria__item';
    this.opciones = opciones;
  }
  crear() {
    let _galerias = document.querySelectorAll(this.selector);
    _galerias.forEach((el, i) => {
      let _this = el;
      let _items = _this.querySelectorAll('.ars1-galeria__item');
      let _grupo = _this.getAttribute('data-group') ? _this.getAttribute('data-group') : 'group';

      if (_this.getAttribute('data-items')) {
        this.opciones.cantidadItems = Number(_this.getAttribute('data-items'));
      }
      let _n = Number(this.opciones.cantidadItems);
      if (_n) {
        let _restantes = _items.length;
        if (_restantes > _n) {
          let _num = _restantes - _n;
          let _lastItem = _items[_n - 1];
          let _capa = document.createElement('span');
          _lastItem.querySelector('.ars1-galeria__ico').remove();
          _capa.classList.add('ars1-galeria__mas', 'ars1-galeria__capa');
          _capa.innerText = `+ ${_num}`;
          _lastItem.appendChild(_capa);

          for (let i = 0; i < _items.length; i++) {
            if (i >= _n) _items[i].style.display = 'none';
          }
        }
      }

      $(_items).attr('data-fancybox', `${_grupo}-${i}`);
    });
  }
  init() {
    this.crear();
  }
}

$('.ars1-galeria__item').fancybox({
  caption: function (instance, item) {
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
      ZOOM: 'Zoom',
    },
  },
});

let _galeria = new ARS1Galeria();

_galeria.init();

ars1.multipleEventsListeners(document, 'wpcf7invalid wpcf7spam wpcf7mailfailed wpcf7mailsent', (event) => {
  console.log(event);
  $('.wpcf7-response-output').remove();
});

/* Validation Events for changing response CSS classes */
document.addEventListener(
  'wpcf7submit',
  function (event) {
    alert('Fire!');
  },
  false
);
document.addEventListener(
  'wpcf7invalid',
  function (event) {
    ars1.alerta({
      selector: '.js-alerta-contacto',
      texto: 'Revisa los campos que están con error',
      tipo: 'error',
    });
  },
  false
);
document.addEventListener('wpcf7spam', function (event) {}, false);
document.addEventListener(
  'wpcf7mailfailed',
  function (event) {
    ars1.alerta({
      selector: '.js-alerta-contacto',
      texto: 'Ocurrió un error al enviar tu mensaje, prueba reintentar',
      tipo: 'error',
    });
  },
  false
);
document.addEventListener(
  'wpcf7mailsent',
  function (event) {
    ars1.alerta({
      selector: '.js-alerta-contacto',
      texto: 'Tu mensaje ha sido enviado con éxito, nos contactaremos contigo a la brevedad',
      tipo: 'exito',
    });
  },
  false
);
