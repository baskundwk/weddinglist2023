const wdlMultistepProgressBar = () => {
  const multiforms = document.querySelectorAll('.fieldset-cf7mls')
  const totalProgress = multiforms.length
  
  let currentProgress
  multiforms.forEach((e, i) => {
    return e.classList.contains('cf7mls_current_fs') ? currentProgress = i+1 : false
  })

  let circleProgress = $('.wdl-circle-progress').circleProgress({
    value: currentProgress / totalProgress,
    fill: {
      color: ['#ff2758']
    },
    size: 60,
    lineCap: 'round',
    startAngle: -Math.PI/2
    });

    document.querySelector('.wdl-circle-progress-text').innerText = currentProgress + '/' + totalProgress
}
const wdlMultistepProgressBarInit = () => {
  document.addEventListener('load', () => {
    setTimeout(()=>{wdlMultistepProgressBar()}, 500)
  })
  document.querySelectorAll('.cf7mls_back').forEach((e) => {
    e.addEventListener('click',()=> {setTimeout(()=>{wdlMultistepProgressBar()}, 500)})
  })
  document.querySelectorAll('.cf7mls_next').forEach((e) => {
    e.addEventListener('click',()=> {setTimeout(()=>{wdlMultistepProgressBar()}, 500)})
  })
}
document.querySelector('.fieldset-cf7mls') ?
(
  setTimeout(()=>{wdlMultistepProgressBar()}, 500),
  wdlMultistepProgressBarInit()
) : false

const wdlArchiveSwiper = new Swiper('.wdl-archive-swiper', {
  slidesPerView: 'auto',
  spaceBetween: 16,
  breakpoints: {
    576: {
      slidesPerView: 'auto',
    },
    992: {
      slidesPerView: 3,
    },
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true
  }
})
const wdlBadgeSwiper = new Swiper('.wdl-badge-container.swiper', {
  slidesPerView: 'auto',
  pagination: {
    el: '.swiper-pagination',
    clickable: true
  }
})

const wdlHeroSwiper = new Swiper('.wdl-hero-swiper', {
  slidesPerView: 1,
  spaceBetween: 40,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    type: 'bullets',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  },
  speed: 1000,
  autoplay: {
    delay: 7000,
  }
})

const wdlStickyBar = () => {
  const mainContent = document.querySelector('.wdl-main-bar')
  window.addEventListener('scroll', () => {
    (window.scrollY > mainContent.offsetTop + mainContent.clientHeight) ?
    document.querySelector('.wdl-sticky-bar').classList.add('active') :
    document.querySelector('.wdl-sticky-bar').classList.remove('active')
  })
  window.addEventListener('load', () => {
    (window.scrollY > mainContent.offsetTop + mainContent.clientHeight) ?
    document.querySelector('.wdl-sticky-bar').classList.add('active') :
    document.querySelector('.wdl-sticky-bar').classList.remove('active')
  })

  const positioning = () => {
    document.querySelector('.wdl-sticky-bar').style.top = document.querySelector('#main-header').offsetTop + document.querySelector('#main-header').clientHeight + 'px'
  }

  positioning()

  window.addEventListener('load', () => { positioning() })
  window.addEventListener('resize', () => { positioning() })

}

document.querySelector('.wdl-sticky-bar') ? wdlStickyBar() : false

const wdlGallery = () => {
  const galleryItems = document.querySelectorAll('.wdl-gallery .wdl-gallery-item')

  const galleryModalSwiper = new Swiper('.wdl-gallery-modal-swiper', {
    sldiesPerView: 1,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    navigation: {
      prevEl: '.swiper-button-prev',
      nextEl: '.swiper-button-next',
    },
    loop: true
  })


  galleryItems.forEach((e, i) => {
    e.addEventListener('click', (element) => {
      galleryModalSwiper.slideTo(i, 0)
    })
    e.addEventListener('drag', (element) => {
      e.preventDefault()
    })
  })
}

document.querySelector('.wdl-gallery') ? wdlGallery() : false

const wdlHeroGallery = () => {
  const wdlHeroGallerySwiper = new Swiper('.wdl-hero-gallery-swiper', {
    slidesPerView: 'auto',
    spaceBetween: 16,
    navigation: {
      prevEl: '.swiper-button-prev',
      nextEl: '.swiper-button-next',
    },
    speed: 1000,
    autoplay: {
      delay: 7000,
    }
  })
}

document.querySelector('.wdl-hero-gallery') ? wdlHeroGallery() : false

const leadMenuSmallSwiper = new Swiper('.lead-menu-small-swiper', {
  slidesPerView: 2.3,
  spaceBetween: 16,
  breakpoints: {
    575: {
      slidesPerView: 3.7,
    },
    992: {
      slidesPerView: 5,
    }
  }
})

// Search floating label
document.querySelectorAll('.et_pb_searchform > div').forEach((element, index) => {
  element.classList.add('form-floating')
  element.querySelector('input.et_pb_s').classList.add('form-control')
  
  if (element.querySelector('input.et_pb_s').placeholder) {
    let placeholderText = element.querySelector('input.et_pb_s').placeholder
    let inputId = 'search-' + (index + 1)
    let floatingLabel = document.createElement('label')
    floatingLabel.setAttribute('for', inputId)
    floatingLabel.innerText = placeholderText
    
    element.querySelector('input.et_pb_s').id = inputId
    element.querySelector('input.et_pb_s').after(floatingLabel)
  }
})

// WPCF7 floating label
document.querySelectorAll('.wpcf7-form-control-wrap').forEach((element, index) => {
  element.classList.add('form-floating')
  element.querySelector('input.wpcf7-form-control') ? element.querySelector('input.wpcf7-form-control').classList.add('form-control') : false
  element.querySelector('textarea.wpcf7-form-control') ? element.querySelector('input.wpcf7-form-control').classList.add('form-control') : false
  
  if (element.querySelector('.wpcf7-form-control').placeholder) {
    let placeholderText = element.querySelector('.wpcf7-form-control').placeholder
    let inputId = element.querySelector('.wpcf7-form-control').id
    let floatingLabel = document.createElement('label')
    
    floatingLabel.setAttribute('for', inputId)
    floatingLabel.innerText = placeholderText
    
    element.querySelector('.wpcf7-form-control').after(floatingLabel)
  }
})

// Search page default value
const wdlSearchQuery = () => {
  document.querySelector('.wdl-search input[name=s]').setAttribute('value', document.querySelector('.wdl-search-query').textContent.trim())
}

document.querySelector('.wdl-search-query') ? wdlSearchQuery() : false;

// Search floating label
document.querySelectorAll('.wpc-search-field-wrapper').forEach((element, index) => {
  element.classList.add('form-floating')
  element.querySelector('.wpc-search-field').classList.add('form-control')
  
  if (element.querySelector('.wpc-search-field').placeholder) {
    let placeholderText = element.querySelector('.wpc-search-field').placeholder
    let inputId = 'search-' + (index + 1)
    let floatingLabel = document.createElement('label')
    floatingLabel.setAttribute('for', inputId)
    floatingLabel.innerText = placeholderText
    
    element.querySelector('.wpc-search-field').id = inputId
    element.querySelector('.wpc-search-field').after(floatingLabel)
  }
})

const selectAll = () => {
  document.querySelectorAll('.select-all').forEach((e)=> {
    e.addEventListener('change', ()=> {
      document.querySelectorAll('input[type=checkbox][name=' + e.getAttribute('name') + ']').forEach((checkbox)=> {
        checkbox.checked = e.checked
      })
    })
  })
}

document.querySelector('.select-all') ? selectAll() : false