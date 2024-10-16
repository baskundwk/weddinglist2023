function loadTocIds() {
  /* Load TOC ID & Links */
  let tocIds = [];
  $("#ez-toc-container nav")
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
  });

  $("#ez-toc-container nav")
    .find("a")
    .each((i, e) => {
      $(e).click((event) => {
        event.preventDefault();

        $(".wdl-single-content").addClass("expanded");
        $("body, html").animate(
          {
            scrollTop: $($(e).attr("href")).offset().top - 130,
          },
          250
        );
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

if (document.querySelector("#post-content-container")) {
  $(document).ready(function ($) {
    $.ajax({
      url: ajax_params.ajax_url, // AJAX URL from localized script
      type: "POST",
      data: {
        action: "load_current_post",
        post_id: ajax_params.post_id, // Send the current post ID
      },
      success: function (response) {
        $("#post-content-container").html(response); // Insert post content into the container
        loadTocIds();
        prepareContentSwiper();
        $("#post-content-container").removeClass("loading");
      },
      error: function () {
        $("#post-content-container").html(
          "<p>Failed to load post content.</p>"
        );
      },
    });
  });
}
