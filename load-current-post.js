function loadTocIds() {
  /* Load TOC ID & Links */
  /* let tocIds = [];
  $(".wdl-toc-inner")
    .find("a")
    .each((i, e) => {
      tocIds.push($(e).attr("href").replace("#", ""));
    });
  let sortedHeaders = $(".wdl-single-content")
    .find("h2, h3, h4, h5, h6")
    .toArray()
    .sort(function (a, b) {
      return a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_FOLLOWING
        ? -1
        : 1;
    });
  $(sortedHeaders).each((i, e) => {
    $(e).attr("id", tocIds[i]);
  }); */

  $(".wdl-toc-inner")
    .find("a")
    .each((i, e) => {
      $(e).click((event) => {
        //event.preventDefault();

        $(".wdl-single-content").addClass("expanded");
        /* $("body, html").animate(
          {
            scrollTop: $($(e).attr("href")).offset().top - 130,
          },
          250
        ); */
      });
    });
}

function prepareContentSwiper() {
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
}

const listToc = () => {
  const toc = document.querySelector(
    ".wdl-single-stickybar-toc .wdl-toc-inner"
  );
  const content = document.querySelector("#post-content-container");
  const headers = content.querySelectorAll("h2, h3, h4, h5, h6");
  const tocList = document.createElement("ul");

  if(document.querySelector('#post-content-container h2')) {
    let lastLevel = 2;
    let currentList = tocList;
    const listsByLevel = { 2: tocList };
  
    headers.forEach((header) => {
      const level = parseInt(header.tagName.substring(1));
      const item = document.createElement("li");
      const link = document.createElement("a");
  
      // Set up the anchor link
      const id = header.textContent.replace(/\s+/g, "-").toLowerCase();
      header.id = id;
      link.href = `#${id}`;
      link.textContent = header.textContent.replace(/[\u{1F600}-\u{1F64F}\u{1F300}-\u{1F5FF}\u{1F680}-\u{1F6FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}]/gu, '') // Remove emojis
      .replace(/[^a-zA-Z0-9\u0E00-\u0E7F\s]/g, '');;
      item.appendChild(link);
  
      // Adjust list hierarchy based on level
      if (level > lastLevel) {
        const nestedList = document.createElement("ul");
        listsByLevel[lastLevel].lastElementChild.appendChild(nestedList);
        listsByLevel[level] = nestedList;
      } else if (level < lastLevel) {
        delete listsByLevel[lastLevel];
      }
  
      listsByLevel[level].appendChild(item);
      lastLevel = level;
    });
  
    toc.appendChild(tocList);
  
    toc.classList.remove("disabled");
  }
};

if (document.querySelector("#post-content-container")) {
  jQuery(document).ready(function ($) {
    $.ajax({
      url: ajax_params.ajax_url,
      type: "POST",
      data: {
        action: "load_current_post",
        post_id: ajax_params.post_id,
      },
      success: function (response) {
        $("#post-content-container").html(response);
        prepareContentSwiper();
        $("#post-content-container").removeClass("loading");
        listToc();
        loadTocIds();
      },
      error: function () {
        $("#post-content-container").html(
          "<p>Failed to load post content.</p>"
        );
      },
    });
  });
}
