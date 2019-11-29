let _height = window.innerHeight;
let _scroll = window.scrollY;

/**
 * ARS1
 */

const ars1 = {
  scrolling (fun) {
    _scroll = window.scrollY;
    if (typeof fun === 'function') {
      fun();
      document.addEventListener('scroll', () => {
        _scroll = window.scrollY;
        fun();
      });
    } else {
      console.warn(
        'fln.scrolling(¿function?) : Se debe pasar una función como argumento'
      );
    }
  },
  responsive (fun) {
    _width = window.innerWidth;
    _height = window.innerHeight;

    if (typeof fun === 'function') {
      fun();
      window.addEventListener('resize', event => {
        _width = window.innerWidth;
        _height = window.innerHeight;
        fun();
      });
    } else {
      console.warn(
        `fln.responsive(¿function?) : Se debe pasar una función como argumento`
      );
    }
  },
  init () {
    
  }
}

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
  }
}


/**
 * SLIDER PRINCIPAL
 */
const slider = () => {
  let _slider = $("#slider");
  _slider.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: [
      `<svg xmlns="http://www.w3.org/2000/svg" width="162" height="279" viewBox="0 0 161.7 278.7"><polygon class="st0" points="139.1 278.7 161.7 256.1 45 139.4 161.7 22.6 139.1 0 0 139.1 0 139.6 "/></svg>`,
      `<svg xmlns="http://www.w3.org/2000/svg" width="162" height="279" viewBox="0 0 161.7 278.7"><polygon class="st0" points="22.6 0 0 22.6 116.7 139.4 0 256.1 22.6 278.7 161.7 139.6 161.7 139.1 "/></svg>`
    ],
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

const fixedHeader = () => {
  let _header;
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
}
fixedHeader();

const observer = lozad();
observer.observe();
