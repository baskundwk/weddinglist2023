/* Initialize dataLayer */
window.dataLayer = window.dataLayer || [];

/* Lead Menu Items */
$('#lead-menu .menu-item').each((i, e) => {
  $(e).attr({
    'data-dlev': 'navClick',
    'data-dlcomp': 'tag - lead menu',
    'data-dltgt': $(e).text().trim()
  });
});

/* Header Menu Links */
$('#top-menu a').each((i, e) => {
  $(e).attr({
    'data-dlev': 'linkClick',
    'data-dlcomp': 'link - header - menu',
    'data-dltgt': $(e).text().trim()
  });
});


/* Prepare dataLayer in navigation */
const navItems = [
  { selector: '.menu-item-object-promotion', comp: 'link - nav - promotion', tgt: 'Promotion' },
  { selector: '.menu-item-object-wedding-fair', comp: 'link - nav - wedding-fair', tgt: 'Wedding Fair' },
  { selector: '.menu-item-object-venue', comp: 'link - nav - venue', tgt: 'Venue' },
  { selector: '.menu-item-object-vendor', comp: 'link - nav - vendor', tgt: 'Vendor' },
  { selector: '.menu-item-object-listing', comp: 'link - nav - listing', tgt: 'Listing' },
  { selector: '.menu-item-object-video', comp: 'link - nav - video', tgt: 'Video' },
  { selector: '.menu-item-object-moment', comp: 'link - nav - moment', tgt: 'Moment' },
  { selector: '.menu-item-object-consultant', comp: 'link - nav - consultant', tgt: 'Consultant' },
  { selector: '.menu-item-object-blog', comp: 'link - nav - blog', tgt: 'Blog' },
];

navItems.forEach(({ selector, comp, tgt }) => {
  $(selector).attr({
    'data-dlev': 'navClick',
    'data-dlcomp': comp,
    'data-dltgt': tgt
  });
});

/* External/Internal Links in Post Content */
const currentDomain = window.location.origin;
$('.wdl-single-content a').each((i, e) => {
  const href = $(e).attr('href') || "#";
  const isExternal = href.startsWith("http") && !href.startsWith(currentDomain);
  $(e).attr({
    'data-dlev': 'linkClick',
    'data-dlcomp': isExternal ? 'link - post - content - external' : 'link - post - content - internal',
    'data-dltgt': `${$(e).text().trim()} - ${href}`
  });
});

/* Event Delegation for Click Tracking */
$(document).on("click", "[data-dlev]", function () {
  const eventType = $(this).attr("data-dlev");
  window.dataLayer.push({
    'event': eventType,
    'component': $(this).attr("data-dlcomp"),
    'source': window.location.href,
    'target': $(this).attr("data-dltgt"),
    'data': $(this).attr("data-dldt") || null
  });
});

/* Fire `search` event when window is fully loaded */
$(window).on("load", function () {
  $('[data-dlev="search"]').each(function () {
    window.dataLayer.push({
      'event': "search",
      'component': $(this).attr("data-dlcomp"),
      'source': window.location.href,
      'target': $(this).attr("data-dltgt"),
      'data': $(this).attr("data-dldt") || null
    });
  });
});
