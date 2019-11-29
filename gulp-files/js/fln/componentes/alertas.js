let _clearAlerta;
fln.alerta = opciones => {
  let _opciones = {
    texto: opciones.texto ? opciones.texto : 'Aquí deberias pasar tu mensaje',
    tipo: opciones.tipo ? opciones.tipo : 'error',
    posicion: opciones.posicion ? opciones.posicion : 'top',
    tiempo: opciones.tiempo ? opciones.tiempo : 5000,
    cascada: opciones.cascada ? opciones.cascada : false
  };

  if (!$('.alerta__contenedor').length && _opciones.cascada) {
    $('body').append('<div class="alerta__contenedor"></div>');
  }
  let _alerta = $('<div/>');
  _alerta.addClass('alerta alerta--global');
  _alerta.removeClass('alerta--error').removeClass('alerta--aviso').removeClass('alerta--exito').removeClass('alerta--info');
  let _contenedor = $('.alerta__contenedor');
  if (_opciones.cascada) {
    $('.alerta__contenedor').prepend(_alerta);
    _contenedor.addClass(`alerta__contenedor--fixed-${_opciones.posicion}`);
    _alerta.addClass(`alerta--${_opciones.tipo}`).text(_opciones.texto);
    if (!_alerta.hasClass('visible')) {
      setTimeout(function () {
        _alerta.addClass('visible');
      }, 100);
      setTimeout(function () {
        _alerta.removeClass('visible').addClass('alerta--hidden');
      }, _opciones.tiempo);
      setTimeout(function () {
        _alerta.remove();
      }, _opciones.tiempo + 300);
    }
  } else {
    $('.alerta--global').remove();
    $('body').append(_alerta);
    _alerta.addClass(`alerta--${_opciones.tipo} alerta--fixed-${_opciones.posicion}`).text(_opciones.texto);
  }
  clearInterval(_clearAlerta);
  _clearAlerta = setInterval(() => {
    if (_opciones.cascada) {
      if (!$('.alerta--global').length) {
        _contenedor.remove();
      }
    } else {
      $('.alerta--global').remove();
    }
  }, 5000);
};
