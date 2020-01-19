class ARS1Galeria {
  constructor(
    selector = '.js-galeria',
    opciones = {
      cantidadItems: undefined
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
      let _grupo = _this.getAttribute('data-group')
        ? _this.getAttribute('data-group')
        : 'group';

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
  caption: function(instance, item) {
    return $(this)
      .find('figcaption')
      .html();
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

let _galeria = new ARS1Galeria();

_galeria.init();
