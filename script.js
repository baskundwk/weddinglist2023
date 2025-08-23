// Randomize post cards
if ($(".row-cols-archive-randomized")) {
  $(".row-cols-archive-randomized").each((index, element) => {
    $(element).append(
      $(element)
        .find(".wdl-archive-primary")
        .sort(function () {
          return Math.round(Math.random()) - 0.5;
        })
    );
    $(element).append(
      $(element).find(".wdl-archive-default")
      /* .sort(function () {
            return Math.round(Math.random()) - 0.5;
          }) */
    );
    $(element).addClass("opacity-1");
  });
}

// Header
if (window.innerWidth < 1200) {
  $("#top-menu > .menu-item").each((menuIndex, menuElement) => {
    $(menuElement)
      .find(".sub-menu")
      .each((submenuIndex, submenuElement) => {
        $(submenuElement).addClass("collapse");
        $(submenuElement).attr(
          "id",
          "sub-menu-" + (menuIndex + 1) + "-" + (submenuIndex + 1)
        );
        $(submenuElement)
          .parent()
          .prepend(
            $(
              `<button class="menu-item-toggler" data-bs-target="#sub-menu-${
                menuIndex + 1
              }-${submenuIndex + 1}" data-bs-toggle="collapse"></button>`
            )
          );
      });
  });
}

// Lead Menu
$(window).scrollTop() > 140 ? $('.wdl-lead-menu').addClass('inactive') : $('.wdl-lead-menu').removeClass('inactive')

$(window).scroll(()=>{
  $(window).scrollTop() > 140 ? $('.wdl-lead-menu').addClass('inactive') : $('.wdl-lead-menu').removeClass('inactive')
})

const leadMenuSwiper = new Swiper('.wdl-lead-menu-swiper', {
  slidesPerView: 'auto',
  spaceBetween: 24,
  centerInsufficientSlides: true,
  slideClass: 'menu-item',
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next',
  },
  breakpoints: {
    1024: {
      spaceBetween: 32
    }
  }
})
const initLocalnav = () => {
  let heading = $(".wdl-localnav-heading");
  $(heading).each((index, element) => {
    $(element).attr("id", "section-" + (index + 1));
    $(".wdl-localnav-swiper .swiper-wrapper").append(
      $(
        `<li class="swiper-slide"><a href="#" data-href="#section-${
          index + 1
        }">${$(element).text()}</a></li>`
      )
    );
  });
  let activeLocalnav = 0;
  let localnavSlides = $(".wdl-localnav-swiper .swiper-wrapper .swiper-slide");

  $(localnavSlides[activeLocalnav]).addClass("active");

  $(window).scroll(() => {
    $(".wdl-localnav-heading").each((index, element) => {
      if (element.getBoundingClientRect().top > 0) {
        activeLocalnav = index;

        return false;
      }
    });
    $(localnavSlides).removeClass("active");
    $(localnavSlides[activeLocalnav]).addClass("active");
  });

  const wdlLocalnavSwiper = new Swiper(".wdl-localnav-swiper", {
    slidesPerView: "auto",
    spaceBetween: 0,
  });

  $(".wdl-localnav a").each((index, element) => {
    $(element).click((event) => {
      let scrollMargin = $("html").css("scroll-margin-top").replace("px", "");
      let target = $(element).attr("data-href");

      $("html, body").animate(
        { scrollTop: $(target).offset().top - scrollMargin },
        50
      );
    });
  });
};
$(document).ready(initLocalnav());

$("html").css("--header-height", $("#main-header").height() + "px");
$("html").css("--footer-height", $(".wdl-footer").height() + "px");

// Form progress
const wdlMultistepProgressBar = () => {
  const multiforms = document.querySelectorAll(".fieldset-cf7mls");
  const totalProgress = multiforms.length;

  let currentProgress;
  multiforms.forEach((e, i) => {
    return e.classList.contains("cf7mls_current_fs")
      ? (currentProgress = i + 1)
      : false;
  });

  let circleProgress = $(".wdl-circle-progress").circleProgress({
    value: currentProgress / totalProgress,
    fill: {
      color: ["#EB355D"],
    },
    size: 60,
    lineCap: "round",
    startAngle: -Math.PI / 2,
  });

  document.querySelector(".wdl-circle-progress-text").innerText =
    currentProgress + "/" + totalProgress;
};
const wdlMultistepProgressBarInit = () => {
  document.addEventListener("load", () => {
    setTimeout(() => {
      wdlMultistepProgressBar();
    }, 500);
  });
  document.querySelectorAll(".cf7mls_back").forEach((e) => {
    e.addEventListener("click", () => {
      setTimeout(() => {
        wdlMultistepProgressBar();
      }, 500);
    });
  });
  document.querySelectorAll(".cf7mls_next").forEach((e) => {
    e.addEventListener("click", () => {
      setTimeout(() => {
        wdlMultistepProgressBar();
      }, 500);
    });
  });
};
document.querySelector(".fieldset-cf7mls")
  ? (setTimeout(() => {
      wdlMultistepProgressBar();
    }, 500),
    wdlMultistepProgressBarInit())
  : false;

// Swipers
const wdlArchiveExtendedSwiper = new Swiper(
  ".wdl-archive .wdl-archive-swiper",
  {
    slidesPerView: 1,
    spaceBetween: 16,
    speed: 1000,
    autoplay: {
      delay: 7000,
      pauseOnMouseEnter: true,
      disableOnInteraction: true,
    },
    breakpoints: {
      576: {
        slidesPerView: 2,
        spaceBetween: 8,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 8,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 8,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 16,  
      },
      1400: {
        slidesPerView: 5,
        spaceBetween: 16,  
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
      dynamicMainBullets: 5,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  }
);
let compareSlide = $(".wdl-compare-swiper .wdl-compare-card").length;
const wdlCompareSwiper = new Swiper(".wdl-compare-swiper", {
  slidesPerView: "auto",
  spaceBetween: 12,
  centerInsufficientSlides: true,
  breakpoints: {
    768: {
      slidesPerView: "auto",
      spaceBetween: 16,
      centerInsufficientSlides: true,
    },
    1200: {
      slidesPerView: compareSlide,
      spaceBetween: /* 55 - 8 * compareSlide */ 16,
      centerInsufficientSlides: true,
    },
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  on: {
    init: (swiper) => {
      swiper.el.classList.add("wdl-compare-swiper-" + compareSlide);
    },
  },
});
const wdlSwiperAuto = new Swiper(".wdl-swiper-auto", {
  slidesPerView: "auto",
  spaceBetween: 8,
});
const wdlBadgeSwiper = new Swiper(".wdl-badge-container.swiper", {
  slidesPerView: "auto",
  spaceBetween: 8,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
const wdlHeroSwiper = new Swiper(".wdl-hero-swiper", {
  slidesPerView: 1,
  spaceBetween: 40,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    type: "bullets",
  },
  navigation: {
    nextEl: ".swiper-navigation-hero .swiper-button-next",
    prevEl: ".swiper-navigation-hero .swiper-button-prev",
  },
  speed: 1500,
  autoplay: {
    delay: 5000,
  },
  loop: true,
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
});
const wdlHero2Swiper = new Swiper(".wdl-hero-2-swiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  speed: 1500,
  autoplay: {
    delay: 5000,
  },
  loop: true,
  breakpoints: {
    1200: {
      spaceBetween: 24
    }
  }
});
const wdlCompareGroupRoomSwiper = new Swiper(".wdl-compare-group-room-swiper", {
  slidesPerView: "1",
  spaceBetween: 24,
  navigation: {
    nextEl: ".swiper-navigation .swiper-button-next",
    prevEl: ".swiper-navigation .swiper-button-prev",
  },
});
const wdlCardGallerygSwiper = new Swiper(".wdl-card-gallery-swiper", {
  slidesPerView: 1,
  navigation: {
    nextEl: ".swiper-navigation .swiper-button-next",
    prevEl: ".swiper-navigation .swiper-button-prev",
  },
});
const wdlListingCardGallerygSwiper = new Swiper(
  ".wdl-listing-card-gallery-swiper",
  {
    slidesPerView: 1,
    /* autoplay: {
        delay: 5000,
      }, */
    navigation: {
      nextEl: ".swiper-navigation .swiper-button-next",
      prevEl: ".swiper-navigation .swiper-button-prev",
    },
  }
);
const wdlListingCardDetailPricingSwiper = new Swiper(
  ".wdl-listing-card-detail-pricing-swiper",
  {
    slidesPerView: "auto",
    spaceBetween: 6,
  }
);
const wdlListingCardDetailFeaturesSwiper = new Swiper(
  ".wdl-listing-card-detail-features-swiper",
  {
    slidesPerView: "auto",
    spaceBetween: 24,
  }
);
const wdlListingCardDetailRoomSwiper = new Swiper(
  ".wdl-listing-card-detail-room-swiper",
  {
    slidesPerView: "auto",
    spaceBetween: 16,
  }
);
const wdlAdPopupSwiper = new Swiper(".wdl-ad-popup-swiper", {
  speed: 1000,
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: ".swiper-navigation-ad-popup .swiper-button-next",
    prevEl: ".swiper-navigation-ad-popup .swiper-button-prev",
  },
});
const wdlArchivePricingSwiper = new Swiper(".wdl-archive-pricing-swiper", {
  slidesPerView: 1,
  spaceBetween: 16,
  breakpoints: {
    576: {
      slidesPerView: 2,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 8,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 8,
    },
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  speed: 1000,
});
const wdlHeroGallerySwiper = new Swiper(".wdl-archive-pricing-gallery-swiper", {
  enableTouchSwipe: false,
  slidesPerView: "auto",
  spaceBetween: 0,
  navigation: {
    prevEl: ".swiper-button-prev",
    nextEl: ".swiper-button-next",
  },
  centerInsufficientSlides: true,
  speed: 1000,
  loop: true,
});
const wdlCouponCardSwiper = new Swiper(".wdl-coupon-card-swiper", {
  spaceBetween: 8,
  slidesPerView: "auto",
});
const wdlVideoSwiper = new Swiper('.wdl-video-swiper', {
  slidesPerView: 2,
  spaceBetween: 8,
  breakpoints: {
    768: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 6,
    },
    1200: {
      slidesPerView: 7,
    },
    1400: {
      slidesPerView: 7,
      spaceBetween: 12,  
    }
  },
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next'
  },
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
  speed: 1000,
  autoplay: {
    delay: 5000,
  },
})
const wdlSubvendorSwiper = new Swiper('.wdl-subvendor-thumbnail-grid', {
  slidesPerView: 'auto',
  spaceBetween: 10,
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next'
  },
  speed: 1000,
  autoplay: {
    delay: 5000,
  },
})

// Stickybar
const wdlStickyBar = () => {
  const mainContent = document.querySelector(".wdl-main-bar");
  window.addEventListener("scroll", () => {
    window.scrollY > mainContent.offsetTop + mainContent.clientHeight
      ? document.querySelector(".wdl-sticky-bar").classList.add("active")
      : document.querySelector(".wdl-sticky-bar").classList.remove("active");
  });
  window.addEventListener("load", () => {
    window.scrollY > mainContent.offsetTop + mainContent.clientHeight
      ? document.querySelector(".wdl-sticky-bar").classList.add("active")
      : document.querySelector(".wdl-sticky-bar").classList.remove("active");
  });

  const positioning = () => {
    document.querySelector(".wdl-sticky-bar").style.top =
      document.querySelector("#main-header").clientHeight +
      "px";
  };

  positioning();

  window.addEventListener("load", () => {
    positioning();
  });
  window.addEventListener("resize", () => {
    positioning();
  });
};

document.querySelector(".wdl-sticky-bar") ? wdlStickyBar() : false;

const wdlGallery = () => {
  const galleryItems = document.querySelectorAll(
    ".wdl-gallery .wdl-gallery-item"
  );

  const galleryModalSwiper = new Swiper(".wdl-gallery-modal-swiper", {
    sldiesPerView: 1,
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    navigation: {
      prevEl: ".swiper-button-prev",
      nextEl: ".swiper-button-next",
    },
    loop: true,
  });

  galleryItems.forEach((e, i) => {
    e.addEventListener("click", (element) => {
      galleryModalSwiper.slideTo(i, 0);
    });
    e.addEventListener("drag", (element) => {
      e.preventDefault();
    });
  });
};

// Gallery
document.querySelector(".wdl-gallery") ? wdlGallery() : false;

const wdlHeroGallery = () => {
  if ($(".wdl-hero-gallery-swiper").hasClass("wdl-hero-gallery-video-swiper")) {
    const wdlHeroGalleryVideoSwiper = new Swiper(
      ".wdl-hero-gallery-video-swiper",
      {
        slidesPerView: "auto",
        spaceBetween: 16,
        navigation: {
          prevEl: ".swiper-navigation-hero .swiper-button-prev",
          nextEl: ".swiper-navigation-hero .swiper-button-next",
        },
        centerInsufficientSlides: true,
        loop: true,
      }
    );
  } else {
    const wdlHeroGallerySwiper = new Swiper(".wdl-hero-gallery-swiper", {
      slidesPerView: "auto",
      spaceBetween: 16,
      navigation: {
        prevEl: ".swiper-navigation-hero .swiper-button-prev",
        nextEl: ".swiper-navigation-hero .swiper-button-next",
      },
      centerInsufficientSlides: true,
      speed: 1000,
      autoplay: {
        delay: 5000,
      },
      loop: true,
    });
  }
};

// Hero Gallery

document.querySelector(".wdl-hero-gallery") ? wdlHeroGallery() : false;

const leadMenuSmallSwiper = new Swiper(".lead-menu-small-swiper", {
  slidesPerView: 2.3,
  spaceBetween: 16,
  breakpoints: {
    575: {
      slidesPerView: 3.7,
    },
    992: {
      slidesPerView: 5,
    },
  },
});

// Search floating label
const etSearchFloatingLabel = () => {
  document
    .querySelectorAll(".et_pb_searchform > div")
    .forEach((element, index) => {
      element.classList.add("form-floating");
      element.querySelector("input.et_pb_s").classList.add("form-control");

      if (element.querySelector("input.et_pb_s").placeholder) {
        let placeholderText =
          element.querySelector("input.et_pb_s").placeholder;
        let inputId = "search-" + (index + 1);
        let floatingLabel = document.createElement("label");
        floatingLabel.setAttribute("for", inputId);
        floatingLabel.innerText = placeholderText;

        element.querySelector("input.et_pb_s").id = inputId;
        element.querySelector("input.et_pb_s").after(floatingLabel);
      }
    });
};

document.querySelector(".et_pb_searchform") &&
document.querySelector("input.et_pb_s")
  ? etSearchFloatingLabel()
  : false;
// WPCF7 floating label
const cf7FloatingLabel = () => {
  document
    .querySelectorAll(".wpcf7-form-control-wrap")
    .forEach((element, index) => {
      element.classList.add("form-floating");
      element.querySelector("input.wpcf7-form-control")
        ? element
            .querySelector("input.wpcf7-form-control")
            .classList.add("form-control")
        : false;
      element.querySelector("textarea.wpcf7-form-control")
        ? element
            .querySelector("textarea.wpcf7-form-control")
            .classList.add("form-control")
        : false;

      if (element.querySelector(".wpcf7-form-control").placeholder) {
        let placeholderText = element.querySelector(
          ".wpcf7-form-control"
        ).placeholder;
        let inputId = element.querySelector(".wpcf7-form-control").id;
        let floatingLabel = document.createElement("label");

        floatingLabel.setAttribute("for", inputId);
        floatingLabel.innerText = placeholderText;

        element.querySelector(".wpcf7-form-control").after(floatingLabel);
      }
    });
};

document.querySelector(".wpcf7-form-control-wrap") ? cf7FloatingLabel() : false;

// Search page default value
const wdlSearchQuery = () => {
  document
    .querySelector(".wdl-search input[name=s]")
    .setAttribute(
      "value",
      document.querySelector(".wdl-search-query").textContent.trim()
    );
};

document.querySelector(".wdl-search-query") ? wdlSearchQuery() : false;

// Search floating label
document
  .querySelectorAll(".wpc-search-field-wrapper")
  .forEach((element, index) => {
    element.classList.add("form-floating");
    element.querySelector(".wpc-search-field").classList.add("form-control");

    if (element.querySelector(".wpc-search-field").placeholder) {
      let placeholderText =
        element.querySelector(".wpc-search-field").placeholder;
      let inputId = "search-" + (index + 1);
      let floatingLabel = document.createElement("label");
      floatingLabel.setAttribute("for", inputId);
      floatingLabel.innerText = placeholderText;

      element.querySelector(".wpc-search-field").id = inputId;
      element.querySelector(".wpc-search-field").after(floatingLabel);
    }
  });

const selectAll = () => {
  document.querySelectorAll(".select-all").forEach((e) => {
    e.addEventListener("change", () => {
      e.parentElement.parentElement
        .querySelectorAll("input[type=checkbox]")
        .forEach((checkbox) => {
          checkbox.checked = e.checked;
        });
    });
  });
};

document.querySelector(".select-all") ? selectAll() : false;

// Search type selection
if (document.querySelectorAll("#searchform #search-type")) {
  document.querySelectorAll("#searchform #search-type a").forEach((e) => {
    e.addEventListener("click", () => {
      document
        .querySelector("#searchform")
        .setAttribute(
          "action",
          "https://www.weddinglist.co.th/" + e.getAttribute("data-type")
        );

      document.querySelector(".wdl-btn-filter span").innerText = e.innerText;
    });
  });
}
// Set Default Form Venue Data
const dataVenue = () => {
  if (
    document.querySelector(".wdl-data-venue") &&
    document.querySelector(".wdl-set-venue")
  ) {
    setTimeout(() => {
      document.querySelector(".wdl-set-venue").value =
        document.querySelector(".wdl-data-venue").innerText;
    }, 2000);
  }
};

document.querySelector(".wdl-data-venue") &&
document.querySelector(".wdl-set-venue")
  ? dataVenue()
  : false;

$("#apply-cta").click(dataVenue());
$(".wdl-apply-btn").on("click", (event) => {
  $(event.target).closest(".wdl-archive-title");
});

// Set Collected Checkbox Data from General Form

const collectCheckbox = () => {
  document
    .querySelector("input[type=submit]")
    .addEventListener("mouseover", () => {
      let selected = [];

      document
        .querySelectorAll(
          '.wdl-checkbox-convert input[type="checkbox"]:not(.select-all):checked ~ label'
        )
        .forEach((element) => {
          selected.push(element.innerText);
        });

      document.querySelector(".wdl-checkbox-summary").value =
        selected.join(", ");
    });
  document.querySelector("input[type=submit]").addEventListener("click", () => {
    let selected = [];

    document
      .querySelectorAll(
        '.wdl-checkbox-convert input[type="checkbox"]:not(.select-all):checked ~ label'
      )
      .forEach((element) => {
        selected.push(element.innerText);
      });

    document.querySelector(".wdl-checkbox-summary").value = selected.join(", ");
  });
};

document.querySelector(".wdl-checkbox-convert") ? collectCheckbox() : false;

/* Prefill form */
$(".wpcf7-submit").click(() => {
  localStorage.setItem("wdl-name-lastname", $("#name-lastname").val());
  localStorage.setItem("wdl-tel", $("#tel").val());
  localStorage.setItem("wdl-email", $("#email").val());
  localStorage.setItem("wdl-lineid", $("#lineid").val());
  localStorage.setItem("wdl-guest", $("#guest").val());
  localStorage.setItem("wdl-budget", $("#budget").val());
  localStorage.setItem("wdl-date", $("#date").val());
  localStorage.setItem("wdl-message", $("#message").val());
});
$(".wdl-form-submit").click(() => {
  localStorage.setItem("wdl-name-lastname", $("#name-lastname").val());
  localStorage.setItem("wdl-tel", $("#tel").val());
  localStorage.setItem("wdl-email", $("#email").val());
  localStorage.setItem("wdl-lineid", $("#lineid").val());
  localStorage.setItem("wdl-guest", $("#guest").val());
  localStorage.setItem("wdl-budget", $("#budget").val());
  localStorage.setItem("wdl-date", $("#date").val());
  localStorage.setItem("wdl-message", $("#message").val());
});

if($('#wdl-form-general').length > 0) {
  $(document).ready(() => {
    setTimeout(() => {
      $("#name-lastname").val(localStorage.getItem("wdl-name-lastname"));
      $("#tel").val(localStorage.getItem("wdl-tel"));
      $("#email").val(localStorage.getItem("wdl-email"));
      $("#lineid").val(localStorage.getItem("wdl-lineid"));
      $("#guest").val(localStorage.getItem("wdl-guest"));
      $("#budget").val(localStorage.getItem("wdl-budget"));
      $("#date").val(localStorage.getItem("wdl-date"));
      $("#message").val(localStorage.getItem("wdl-message"));
  
      //checkAllGeneralFields();
    }, 2000);
  });
} 

// Find and force word wrapping

$(document).ready(() => {
  let replaceWords = [
    "สถานที่",
    "จะเป็น",
    "โรงแรม",
    "ย่านใจกลางเมือง",
    "ใจกลางเมือง",
    "ขอบคุณ",
    "จริง ๆ ค่ะ",
    "ข้อผิดพลาด",
    "ความทรงจำ",
    "บ่าว-สาว",
    "บ่าวสาว",
    "แบบนั้น",
    "ของเรา",
    "แต่งงาน",
    "แกรนด์",
    "กรุงเทพ",
    "กรุงเทพฯ",
  ];
  let replaceElement = [
    "p",
    "h1",
    "h2",
    "h3",
    "h4",
    "h5",
    "h6",
    "a",
    "span",
    "td",
    "th",
  ];
  $(replaceWords).each((index, word) => {
    $(".wdl-main-content p").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h1").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h2").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h3").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h4").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h5").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
    $(".wdl-main-content h6").html(function (_, html) {
      return html.replaceAll(word, "<word>" + word + "</word>");
    });
  });
});

// Compare
/* $(function() {

    $('.wdl-compare-group')[0].matchHeight({
      property: 'height',
      remove: true
    })
  }) */

$(".wdl-link-print").click(() => {
  window.print();
});

let selectedCard = [];

const compareBarActive = () => {
  // Compare : disable if selected card is not venue and more than 3
  if (
    selectedCard.findIndex((item) => item.postType !== "venue") === -1 &&
    selectedCard.length > 1
  ) {
    $("#compare-selected").removeClass("disabled");
    $("#compare-selected").attr(
      "href",
      "/compare/?compare_id=" +
        selectedCard
          .map((card) => {
            return card.id;
          })
          .join(",")
    );
  } else {
    $("#compare-selected").addClass("disabled");
    $("#compare-selected").attr("href", "javascript:void(0);");
  }

  // Compare : update compare bar label
  $(".wdl-compare-bar-selection-label p span").text(
    selectedCard.length > 0 ? selectedCard.length : 1
  );

  // Compare : switch compare bar active status
  if (selectedCard.length > 0) {
    $(".wdl-compare-bar").addClass("active");

    setTimeout(() => {
      bootstrap.Tooltip.getInstance("#compare-selected").show();
    }, 350);
  } else {
    $(".wdl-compare-bar").removeClass("active");

    //bootstrap.Tooltip.getInstance("#compare-selected").hide();
  }
};

// Compare : add item
const compareBarAdd = (title) => {
  $(".wdl-compare-bar .wdl-compare-bar-selection-card").each(
    (index, element) => {
      if ($(element).hasClass("empty")) {
        $(element).removeClass("empty");
        $(element).find("p").text(title);

        return false;
      }
    }
  );
};

// Compare : remove item
const compareBarRemove = (title) => {
  $(".wdl-compare-bar .wdl-compare-bar-selection-card").each(
    (index, element) => {
      let matchElement = $(element).find("p:contains(" + title + ")");

      $(matchElement)
        .closest(".wdl-compare-bar-selection-card")
        .appendTo($(element).closest(".wdl-compare-bar-selection-group"));
      $(matchElement)
        .closest(".wdl-compare-bar-selection-card")
        .addClass("empty");
      $(matchElement).text("");
    }
  );
};

// Compare : register button
/* $('.wdl-form-general-direct').each( (index, element) => {
    $(element).click(()=> {
      generalDirectData.push(JSON.parse($(element).closest('.wdl-archive-card').find('.wdl-checkbox input[type="checkbox"]').attr('data-select')))
    })
  }) */

let generalDirectData = [];
$(window).click((event) => {
  if ($(event.target).hasClass("wdl-form-general-direct")) {
    generalDirectData = [
      JSON.parse(
        $(event.target)
          .closest(".wdl-archive-card")
          .find('.wdl-checkbox input[type="checkbox"]')
          .attr("data-select")
      ),
    ];
    $(".wdl-form-general-list").html(
      $(`<li><span>${generalDirectData[0].title}</span></li>`)
    );
  }
  if ($(event.target).hasClass("card-select-input")) {
    compareBarUpdate($(event.target));
    // Compare : prevent over-selection
    if (selectedCard.length < 5) {
      $(".card-select input[type=checkbox]").prop("disabled", false);
    } else {
      $(".card-select input[type=checkbox]:not(:checked)").prop(
        "disabled",
        true
      );
    }
    let formGeneralList = () => {
      return selectedCard.map((card) => `<li><span>${card.title}</span></li>`);
    };
    $(".wdl-form-general-list").html(formGeneralList());
  }
  /* if(generalDirectData) {
    } else {
      
    } */
});

/* $('.wdl-form-general-modal').on('hidden.bs.modal', ()=> {
    generalDirectData = []
  }) */

// Compare : reset all selection after coming 'back'
$(document).ready(() => {
  setTimeout(() => {
    $(".card-select input[type=checkbox]").prop("checked", false);
  }, 50);
});

// Compare : add or remove selection
const compareBarUpdate = (element) => {
  if ($(element).is(":checked")) {
    selectedCard.push(JSON.parse($(element).attr("data-select")));
    compareBarAdd(JSON.parse($(element).attr("data-select")).title);
    $(element).closest(".card").addClass("active");
  } else {
    selectedCard.pop(JSON.parse($(element).attr("data-select")));
    compareBarRemove(JSON.parse($(element).attr("data-select")).title);
    $(element).closest(".card").removeClass("active");
  }

  compareBarActive();
};

// Compare : checkbox trigger
/* $(".card-select input[type=checkbox]").each((index, element) => {
    $(element).change(() => {
      compareBarUpdate(element);

    // Compare : prevent over-selection
      if (selectedCard.length < 5) {
        $(".card-select input[type=checkbox]").prop(
          "disabled",
          false
        );
      } else {
        $(".card-select input[type=checkbox]:not(:checked)").prop(
          "disabled",
          true
        );
      }
    });
  });
  */
// Compare : uncheck selected item from compare bar
$(".wdl-compare-bar .wdl-compare-bar-selection-card").each((index, element) => {
  $(element).click(() => {
    let title = $(element).find("p").text();
    let titleEl = $(".wdl-archive-title a:contains(" + title + ")");

    compareBarRemove(title);

    selectedCard.pop(
      JSON.parse(
        $(titleEl)
          .closest(".card")
          .find(".card-select input[type=checkbox]")
          .attr("data-select")
      )
    );

    $(titleEl)
      .closest(".card")
      .find(".card-select input[type=checkbox]")
      .prop("checked", false);
    $(titleEl).closest(".card").removeClass("active");

    compareBarActive();

    // Compare : prevent over-selection
    if (selectedCard.length < 5) {
      $(".card-select input[type=checkbox]").prop("disabled", false);
    } else {
      $(".card-select input[type=checkbox]:not(:checked)").prop(
        "disabled",
        true
      );
    }
  });
});

// Enable tooltips
const tooltipTriggerList = $('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

$(".wdl-iframe").each((index, element) => {
  setTimeout(() => {
    $(element)
      .find("iframe")
      .css(
        "height",
        $(element).find("iframe").contents().find("body").height() + "px"
      );
  }, 10);

  $(document).ready(() => {
    setTimeout(() => {
      $(element)
        .find("iframe")
        .css(
          "height",
          $(element).find("iframe").contents().find("body").height() + "px"
        );
    }, 250);
  });

  $(window).resize(() => {
    setTimeout(() => {
      $(element)
        .find("iframe")
        .css(
          "height",
          $(element).find("iframe").contents().find("body").height() + "px"
        );
    }, 10);
  });

  $(element)
    .find("iframe")
    .contents()
    .click(() => {
      setTimeout(() => {
        $(element)
          .find("iframe")
          .css(
            "height",
            $(element).find("iframe").contents().find("body").height() + "px"
          );
      }, 350);
    });
});

// Auto-trigger modal
if(document.querySelector('.wdl-modal-autotrigger')) {
  $(document).ready(() => {
    setTimeout(() => {
      let modal = new bootstrap.Modal(document.querySelector('.wdl-modal-autotrigger'));
      modal.show();
    }, 50);
  });
}

// Init Feather icons
$(document).ready(() => {
  feather.replace();
});

// Copy button
$(".wdl-btn-copy").each((index, element) => {
  $(element).click(() => {
    if ($($(element).attr("data-copy")).val() !== "") {
      navigator.clipboard.writeText($($(element).attr("data-copy")).val());
    } else {
      navigator.clipboard.writeText($($(element).attr("data-copy")).text());
    }

    $("body").append(
      $(`
        <div class="alert wdl-copy-alert" role="alert">
          <span class="text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1.5em" width="1.5em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></span>
          คัดลอกข้อความเสร็จสมบูรณ์
        </div>
      `)
    );

    setTimeout(() => {
      $(".wdl-copy-alert").remove();
    }, 5000);
  });
});

$(document).ready(() => {
  $($(".wdl-tab-related").find(".nav-link")[0]).addClass("active");
  $($(".wdl-tab-related-content").find(".tab-pane")[0]).addClass([
    "show",
    "active",
  ]);
});

// General form : Conditional appointment
$(".wdl-checkbox #appoint").change(() => {
  if ($(".wdl-checkbox #appoint").is(":checked") === true) {
    $("#appoint-date").attr("required", true);
    $("#appoint-time").attr("required", true);

    $("#appoint-field").removeClass("d-none");
  } else {
    $("#appoint-date").attr("required", false);
    $("#appoint-time").attr("required", false);

    $("#appoint-field").addClass("d-none");
  }
});

// Coupon Popup Link
$(".wdl-coupon-popup-link").each((i, e) => {
  $(e).click(() => {
    const feature =
      " width=744, height=1024 ,location=0, resizable=0, scrollbars=1, toolbar=0, menubar=0";
    couponPopup = window.open($(e).attr("href"), "couponPopup", feature);

    if (window.focus) {
      couponPopup.focus();
    }

    return false;
  });
});

/* const checkAllGeneralFields = () => {
  let incompleteInput = [];

  $(".wdl-form-general input[required]").each((index, input) => {
    if ($(input).val() === "") {
      incompleteInput.push(input);
    }
  });

  if (incompleteInput.length === 0) {
    $(".wdl-coupon-checkbox").each((index, coupon) => {
      $(coupon).removeClass("disabled");
    });
  } else {
    $(".wdl-coupon-checkbox").each((index, coupon) => {
      $(coupon).addClass("disabled");
    });
  }
}; */
/* $(".wdl-form-general input[required]").each((i, e) => {
  $(e).on("keyup", checkAllGeneralFields);
  $(e).on("change", checkAllGeneralFields);
}); */

$(".wdl-coupon-proxy").each((i, e) => {
  $(e).click(() => {
    const applyModal = new bootstrap.Modal(document.querySelector("#apply"));
    const origin = $("#coupon-" + (i + 1));
    applyModal.show();
    console.log($(origin));
    if (e.classList.contains("disabled")) {
    } else {
      $(origin).addClass("active");
      $(origin).find(".wdl-coupon-checkbox-target").prop("checked", true);
      $(origin).find(".wdl-coupon-picker-action button").text("เก็บคูปองแล้ว");
      $(origin).find(".wdl-coupon-picker-indicator").addClass("active");
      setTimeout(() => {
        $(origin).find(".wdl-coupon-picker-indicator").removeClass("active");
      }, 3000);
    }
  });
});
$(".wdl-coupon-checkbox").each((i, e) => {
  $(e).attr("id", "coupon-" + (i + 1));
  $(e).click(() => {
    if (e.classList.contains("disabled")) {
    } else {
      $(e).addClass("active");
      $(e).find(".wdl-coupon-checkbox-target").prop("checked", true);
      $(e).find(".wdl-coupon-picker-action button").text("เก็บคูปองแล้ว");
      $(e).find(".wdl-coupon-picker-indicator").addClass("active");
      setTimeout(() => {
        $(e).find(".wdl-coupon-picker-indicator").removeClass("active");
      }, 3000);
    }
  });
});

/* document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll("img");
  
    images.forEach((img) => {
      img.classList.add("skeleton");
  
      img.onload = () => {
        img.classList.remove("skeleton");
      };
  
      img.onerror = () => {
        img.classList.remove("skeleton");
      };
    });
  }); */

$(".wdl-single-content-readmore .wdl-btn").click(() => {
  $(".wdl-single-content").addClass("expanded");
});

$(".wdl-single-stickybar-toggle").click(() => {
  $(".wdl-single-stickybar").toggleClass("expanded");
});
$(".wdl-single-stickybar-toggle a").click(() => {
  $(".wdl-single-stickybar").removeClass("expanded");
});

$(document).ready(() => {
  if ($("#s-type").length > 0 && $("#s-type").attr("value")) {
    $("#s-type").val($("#s-type").attr("value"));
  }
});

function searchRedirect(event) {
  event.preventDefault(); // Prevent form from submitting the traditional way

  // Get the input and select values
  const sParam = $("#search").val();
  const typeParam = $("#s-type").val();

  // Construct the URL with query parameters
  const url = `/?s=${encodeURIComponent(sParam)}&type=${encodeURIComponent(
    typeParam
  )}`;

  // Redirect to the constructed URL
  window.location.href = url;
}

$('#form-line-contact').submit((event)=>{
  event.preventDefault();
  const formItems = $('#form-line-contact').attr('data-items').split(',')
  console.log(formItems)
  const messageArray = [$('#form-line-contact').attr('data-message-prefix')]
  formItems.forEach((e,i)=>{
    if($('#' + e).attr('type') === 'date') { 
      const date = new Date($('#' + e).val());
      const options = { day: "2-digit", month: "short", year: "numeric" };
      const formattedDate = date.toLocaleDateString("en-US", options);
      messageArray.push($('#' + e).attr('placeholder') + ' : ' + formattedDate);
    } else {
      messageArray.push($('#' + e).attr('placeholder') + ' : ' + $('#' + e).val())
    }
  })

  const messageBody = messageArray.join('\r')

  const isMobileOrTablet = () => {
    const userAgent = navigator.userAgent || navigator.vendor || window.opera;
    
    // Check for mobile
    if (/android/i.test(userAgent)) return true;
    if (/iPhone|iPad|iPod/i.test(userAgent)) return true;
    if (/windows phone/i.test(userAgent)) return true;
  
    return false;
  }
  
  if (isMobileOrTablet()) {
    window.location.href = "https://line.me/R/oaMessage/@ety4154i/?" + encodeURI(messageBody)
  } else {
    $("#wdl-lineqr-container").html('')
    const qrcode = new QRCode(document.querySelector("#wdl-lineqr-container"), {
      text: "https://line.me/R/oaMessage/@ety4154i/?" + encodeURI(messageBody),
      width: 600,
      height: 600,
      colorDark : "#EB355D",
      colorLight : "#ffffff",
      correctLevel : QRCode.CorrectLevel.Q
    });
    
    let modal = new bootstrap.Modal(document.querySelector('#modalLineQr'));
    modal.show();
  }
})

$('.wdl-btn-line-contact').each((i,e) => {
  $(e).click(()=>{
    const messageBody = $(e).attr('data-text')

    const isMobileOrTablet = () => {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;
      
      // Check for mobile
      if (/android/i.test(userAgent)) return true;
      if (/iPhone|iPad|iPod/i.test(userAgent)) return true;
      if (/windows phone/i.test(userAgent)) return true;
    
      return false;
    }

    if (isMobileOrTablet()) {
      window.location.href = "https://line.me/R/oaMessage/@ety4154i/?" + encodeURI(messageBody)
    } else {
      $("#wdl-lineqr-container").html('')
      const qrcode = new QRCode(document.querySelector("#wdl-lineqr-container"), {
        text: "https://line.me/R/oaMessage/@ety4154i/?" + encodeURI(messageBody),
        width: 600,
        height: 600,
        colorDark : "#EB355D",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.Q
      });
      
      let modal = new bootstrap.Modal(document.querySelector('#modalLineQr'));
      modal.show();
    }
  })
})

document.addEventListener("DOMContentLoaded", () => {
  const tiktokIframes = document.querySelectorAll('iframe[src*="tiktok.com"]');

  tiktokIframes.forEach((iframe) => {
    iframe.style.width = "100%";  // Set full width
    iframe.style.maxWidth = "100%"; // Set max width
    iframe.style.height = "900px";  // Set height
  });
});

new Swiper('.wdl-video-playlist-content', {
  slidesPerView: 2,
  spaceBetween: 8,
  breakpoints: {
    576: {
      slidesPerView: 4
    },
    1024: {
      slidesPerView: 2
    },
  },
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next',
  }
})

const relatedVideoPlaylists = document.querySelectorAll('.wdl-video-playlist-content')
if(relatedVideoPlaylists.length > 0) {
  const selector = document.querySelector('.wdl-video-playlist-select')
  relatedVideoPlaylists[0].classList.add('active')

  selector.addEventListener('change', (event) => {
    relatedVideoPlaylists.forEach((e,i) => {
      e.classList.remove('active')
    })
    document.querySelector('.wdl-video-playlist-content[data-content-id="' + event.target.value + '"]').classList.add('active')
  })
}

//Campaign Countdown
// Set the date we're counting down to
const eCampaignCountdown = document.querySelectorAll('.wdl-campaign-countdown')

if(eCampaignCountdown.length > 0) {
  eCampaignCountdown.forEach((e,i) => {
    const countDownDate = new Date(e.getAttribute('data-date')).getTime();
    
    // Update the count down every 1 second
    const x = setInterval(function() {
    
      // Get today's date and time
      const now = new Date().getTime();
    
      // Find the distance between now and the count down date
      const distance = countDownDate - now;
    
      // Time calculations for days, hours, minutes and seconds
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      e.querySelector(" .day .number").innerText = days
      e.querySelector(" .hour .number").innerText = hours
      e.querySelector(" .minute .number").innerText = minutes
      e.querySelector(" .second .number").innerText = seconds
    
      e.querySelectorAll(' .number').forEach((e,i) => {
        e.classList.remove('loading')
      })
    
      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        e.innerHTML = "EXPIRED";
      }
    }, 1000);
  })
}


const wdlConsultantSwiper = new Swiper('.wdl-consultant-swiper', {
  slidesPerView: 1,
  spaceBetween: 8,
  breakpoints: {
    576: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 4,
    },
    1280: {
      slidesPerView: 5,
    }
  },
  navigation: {
    prevEl: '.swiper-nested-prev',
    nextEl: '.swiper-nested-next'
  },
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
  speed: 1000,
  autoplay: {
    delay: 5000,
    pauseOnMouseEnter: true,
  },
})

/* Consult Module */
new Swiper('.wdl-consultant-gallery-swiper', {
  slidesPerView: 'auto',
  spaceBetween: 8,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
    dynamicMainBullets: 5,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  nested: true
})

/* Auto-trigger Apply Modal */
const applyModal = document.querySelector('#apply')

if(applyModal) {
  document.addEventListener('DOMContentLoaded', function () {
    if (window.location.hash === '#apply') {
      const modal = new bootstrap.Modal(applyModal);
      modal.show();

      $('#apply .btn-close').click(()=>{
        modal.hide()
      })
    }
  });
}

// Vendor album
const vendorAlbum = new Swiper('.wdl-vendor-album-swiper', {
  slidesPerView: 'auto',
  spaceBetween: 8,
  centerInsufficientSlides: true,
  breakpoints: {
    768: {
      spaceBetween: 16
    }
  },
  navigation: {
    prevEl: '.swiper-navigation-vendor-album .swiper-button-prev',
    nextEl: '.swiper-navigation-vendor-album .swiper-button-next'
  },
  pagination: {
    el: '.swiper-pagination'
  }
})

$('.wdl-vendor-album-toggle').each((i, e) => {
  $(e).click(() => {
    $('.wdl-vendor-album-group').addClass('d-none')
    $($(e).attr('data-album')).removeClass('d-none')
  })
})

// Vendor package
$('.wdl-checkbox-bundle').each((i,e) => {
  const item = $(e).find('.bundle-item')

  $(item).each((i2, e2) => {
    const input = $(e2).find('input')
    $(input).change(()=>{
      $(item).removeClass('active')
      
      if($(input).is(':checked')) {
        $(e2).addClass('active')
      } else {
        $(e2).removeClass('active')
      }
    })
  })
})


$('#toggleSearch').on('click', ()=>{
  setTimeout(()=>{
    $('#search').focus()
  }, 350)
})

const datepickerContainer = document.querySelectorAll('.wdl-datepicker-container')

datepickerContainer.forEach((e, i) => {
  const input = e.querySelector('.datepicker');
  const datepickerToggle = e.querySelector('.datepicker-toggle')
  const inputTarget = document.querySelector(`#${datepickerToggle.getAttribute('for')}`)
  const datepickerClear = e.querySelectorAll('.datepicker-clear')
  const datepickerReset = e.querySelectorAll('.datepicker-reset')

  const localeObj = {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'S'],
      months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'dd MMM yyyy',
      timeFormat: 'hh:ii aa',
      firstDay: 0
  };



  const datepicker = new AirDatepicker(input, {
      locale: localeObj,
      onSelect: ({date, formattedDate, datepicker}) => {
        if(date) {
          inputTarget.checked = true
          inputTarget.value = formattedDate 
          datepickerToggle.querySelector('span').innerText = formattedDate
          e.classList.remove('active')
        }
      }
  });


  // Toggle datepicker click
  datepickerToggle?.addEventListener('click' , (event) => {
    event.preventDefault()
    if(!datepicker.$datepicker.contains(event.target)) {
      setTimeout(()=>{
        e.classList.toggle('active')
      }, 50)
    }

  })

  // Clear datepicker click
  datepickerClear.forEach((e2, i2) => e2?.addEventListener('click', () => {
    datepicker.clear()
    inputTarget.value = ''
    datepickerToggle.querySelector('span').innerText = "ระบุวันที่"
  }))

  // Datepicker inner reset
  datepickerReset.forEach((e2, i2) => e2?.addEventListener('click', (event) => {
    event.preventDefault()
    event.stopPropagation()
    datepicker.clear()
    e.classList.remove('active')
    inputTarget.value = ''
    inputTarget.checked = false
    datepickerToggle.querySelector('span').innerText = "ระบุวันที่"
  }))

  // Outside click
  document.addEventListener('click', function (event) {
    const isInside = [input, datepicker.$datepicker, inputTarget].some(el => {
      return el && el.contains(event.target);
    });
    
    if (!isInside && e.classList.contains('active')) {
      console.log('Datepicker outside click')
      e.classList.remove('active');
    }
  });

})

jQuery(document).ready(function($) {
  $('.select2').each((i, e)=>{
    const $select = $(e)
    $select.select2({
      dropdownParent: $select.parent(),
      width: "100%",
      minimumResultsForSearch: -1,
    })

    $select.on('select2:open', function () {
      // Get the dropdown container
      const $dropdown = $('.select2-container--open .select2-dropdown');

      // Disable interaction
      $dropdown.css('pointer-events', 'none');

      // Re-enable after a short delay (e.g., 500ms)
      setTimeout(() => {
        $dropdown.css('pointer-events', 'auto');
      }, 350);
    })
  })


  const resetSelect2 = (id) => {
    $(id).val('').trigger('change.select2');
    setTimeout(() => {
      $('#appoint-time').select2('close');
    }, 10);
  }

  $('[data-select2-reset]').each((i, e) => {
    $(e).click(() => {
      const target = $(e).attr('data-select2-reset');
      resetSelect2(target);
    });
  });
});
