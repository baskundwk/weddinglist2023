const elSection = document.querySelector('.wdl-friendly-search-section');
const elBar = document.querySelector('.wdl-friendly-search-bar');
const elMain = document.querySelector('.wdl-friendly-search-main');
const elModal = document.querySelector('.wdl-friendly-search-modal');
const elTab = document.querySelector('.wdl-friendly-search-nav');
const elFormInput = document.querySelector('.wdl-form-input-group');
const elAllTab = document.querySelectorAll('.wdl-friendly-search-nav button');
const elAllFilter = document.querySelectorAll('.wdl-friendly-search-main .filters .filter');
const elAllSkip = document.querySelectorAll('.wdl-friendly-search-modal .modal-title-skip');
const elAllCancel = document.querySelectorAll('.wdl-friendly-search-modal .modal-top-cancel');
const elAllModalChoice = document.querySelectorAll('.wdl-friendly-search-modal .modal-choice');

const setFormData = (name, value) => {
  console.log(`Setting form data: ${name} = ${value}`);
  if (name === 'vendor_type') {
    elBar.setAttribute('action', `/vendor_type/${value}/`);
  } else if (name === 'category') {
    elBar.setAttribute('action', `/blog/category/${value}/`);
  } else {
    elFormInput.querySelector('input[name="' + name + '"]')?.setAttribute('value', value);
  }
}

const handleModalOpen = (step) => {
  elModal?.classList.add('active');
  elSection?.classList.add('active');

  elModal.querySelectorAll('.modal-step')?.forEach(e => e.classList.remove('active'));
  elModal.setAttribute('data-current-step', step)
  elModal.querySelector('.modal-step' + elModal.getAttribute('data-current-step'))?.classList.add('active');
}

const handleModalClose = () => {
  if(elModal?.classList.contains('active')) {
    elSection?.classList.remove('active');
    elModal?.classList.remove('active');
    elModal?.classList.add('closing');
    setTimeout(() => {elModal?.classList.remove('closing')}, 350)
  }
}

const handleModalReset = () => {
  document.querySelectorAll('input[type="hidden"]').forEach((e) => {
    e.value = '';
    
  })
  elAllFilter.forEach((e) => {
    e.classList.remove('active');
    e.querySelector('.filter-label-value').innerText = '';
  })
}

const handleTabSwap = (tab) => {
  elAllTab?.forEach((e) => {
    e.classList.remove('active');
  })
  elTab?.querySelector(`button[data-tab="${tab}"]`)?.classList.add('active');
  elMain?.querySelectorAll('.filters')?.forEach((e) => e.classList.remove('active'));
  elMain?.querySelector(`.filters[data-tab-content="${tab}"]`)?.classList.add('active');

  //setFormData('type', tab)

  elBar?.setAttribute('action', `/${tab}/`);

  handleModalReset();
}

const populateData = () => {
  if(dataType) {
    document.querySelector('#modal-step-1-1 .modal-grid').innerHTML = dataType.map((e, i) => 
      `<div id="filter-1-1-${i}" class="thumb-card" data-form-name="type" data-form-value="${e.value}">
        <div class="thumb-image">
          <img src="${e.thumbnail}" alt="${e.title}">
        </div>
        <p>${e.title}</p>
      </div>`
    ).join('');
  }
  if(dataLocation) {
    document.querySelector('#modal-step-1-2 .modal-grid').innerHTML = dataLocation.map((e, i) => 
      `<div id="filter-1-2-${i}" class="thumb-card" data-form-name="loc" data-form-value="${e.value}">
        <div class="thumb-image">
          <img src="${e.thumbnail}" alt="${e.title}">
        </div>
        <p>${e.title}</p>
      </div>`
    ).join('');
  }
  if(dataStyle) {
    document.querySelector('#modal-step-1-5 .modal-grid').innerHTML = dataStyle.map((e, i) => 
      `<div id="filter-1-5-${i}" class="thumb-card" data-form-name="character" data-form-value="${e.value}">
        <div class="thumb-image">
          <img src="${e.thumbnail}" alt="${e.title}">
        </div>
        <p>${e.title}</p>
      </div>`
    ).join('');
  }
}

const initModalChoice = () => {
  elAllModalChoice.forEach((e) => {
    const items = e.querySelectorAll('.modal-choice-item')
    items.forEach((e2) => {
      e2.addEventListener('click', () => {
        items?.forEach((e3) => {e3.classList.remove('active')})
        e2.classList.add('active');
        //const value = e2.getAttribute('data-form-value');
        //setFormData(e.querySelector('.modal-choice-group').getAttribute('data-form-name'), value);
      })
    })
  })
}

const handleSkip = (name) => {
  const currentElement = document.querySelector('.modal-title-skip[data-form-name="' + name + '"]');
  const currentModalStep = currentElement.closest('.modal-step');
  const nextModalStep = currentModalStep.nextElementSibling;
  const currentFilter = document.querySelector('[data-filter-name="' + name + '"]')
  const currentStep = parseInt(currentFilter.getAttribute('data-filter-step'))
  const currentInput = elBar.querySelector('input[name="' + name + '"]');
  const nextSetStep = currentFilter.nextElementSibling?.getAttribute('data-set-step');

  currentFilter?.classList.add('active');
  currentFilter.querySelector('.filter-label-value').innerText = 'ไม่ระบุ';

  currentInput?.setAttribute('value', '');
  if(currentModalStep?.getAttribute('data-group') === nextModalStep?.getAttribute('data-group') && nextSetStep) {
    handleModalOpen(nextSetStep);
  } else {
    handleModalClose()
  }
}

const handleFormSubmit = () => {
  elBar.querySelectorAll('input').forEach((e) => {
    if(e.value.trim() === '') {
      e.remove()
    }
  })
}

const initFriendlySearch = () => {
  populateData();

  // On Tab Click
  elAllTab.forEach((e) => {
    e.addEventListener('click', (e2) => {
      const tab = e.getAttribute('data-tab');
      handleTabSwap(tab);
    })
  })

  // On Select Change
  elBar.querySelectorAll('select').forEach((e) => {
    e.addEventListener('change', (e2) => {
      const name = e.getAttribute('name');
      const value = e.value;
      setFormData(name, value);
    })
  })

  // On Filter Click
  elAllFilter.forEach((e) => {
    e.addEventListener('click', (e2) => {
      if(document.querySelector(e.getAttribute('data-set-step'))?.classList.contains('active') && elModal?.classList.contains('active')) {
        handleModalClose();
      } else {
        handleModalOpen(e.getAttribute('data-set-step'));
      }
    })
  })

  // On Modal Outside Click
  window.addEventListener('click', (e) => {
    if (!elModal.contains(e.target) && !elMain.contains(e.target)) {
      handleModalClose()
    }
  })

  // On Modal Cancel Click
  elAllCancel.forEach((e) => {
    e.addEventListener('click', (e2) => {
      handleModalReset();
      handleModalClose();
    })
  })

  // On Modal Choice Click
  initModalChoice()

  // On All Choice/Grid Click
  elBar.querySelectorAll('[data-form-name]').forEach((e) => {
    e.addEventListener('click', (e2) => {
      if(!e.classList.contains('modal-title-skip')) {
        const name = e.getAttribute('data-form-name');
        const value = e.getAttribute('data-form-value');
        const label = e.innerText
        setFormData(name, value);
        
        const currentElement = e;
        const currentModalStep = currentElement.closest('.modal-step');
        const nextModalStep = currentModalStep.nextElementSibling;
        const currentFilter = document.querySelector('[data-filter-name="' + name + '"]')
        const currentStep = parseInt(currentFilter.getAttribute('data-filter-step'))
        const currentInput = elBar.querySelector('input[name="' + name + '"]');
        const nextSetStep = currentFilter.nextElementSibling?.getAttribute('data-set-step');

        if(currentModalStep?.getAttribute('data-group') === nextModalStep?.getAttribute('data-group') && nextSetStep) {
          handleModalOpen(nextSetStep);
        } else {
          handleModalClose()
        }
  
        elBar.querySelector(`[data-filter-name="${name}"]`)?.classList.add('active');
        elBar.querySelector(`[data-filter-name="${name}"] .filter-label-value`).innerText = label;
      }
    })
  })

  // On Skip Click
  elAllSkip.forEach((e) => {
    e.addEventListener('click', (e2) => {
      const name = e.getAttribute('data-form-name');
      handleSkip(name);
    })
  })

  // On Form Submit
  elBar.addEventListener('submit', (e) => {
    e.preventDefault();
    handleFormSubmit();
    elBar.submit();
  });
}

elSection && initFriendlySearch()
