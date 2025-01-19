/* Iniialize dataLayer */
window.dataLayer = window.dataLayer || [];

/* Prepare dataLayer in navigation */
$('.menu-item-object-promotion').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - promotion',
  'data-dltgt': 'Promotion'
})
$('.menu-item-object-wedding-fair').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - wedding-fair',
  'data-dltgt': 'Wedding Fair'
})
$('.menu-item-object-venue').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - venue',
  'data-dltgt': 'Venue'
})
$('.menu-item-object-vendor').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - vendor',
  'data-dltgt': 'Vendor'
})
$('.menu-item-object-listing').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - listing',
  'data-dltgt': 'Listing'
})
$('.menu-item-object-video').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - video',
  'data-dltgt': 'Video'
})
$('.menu-item-object-moment').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - moment',
  'data-dltgt': 'Moment'
})
$('.menu-item-object-consultant').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - consultant',
  'data-dltgt': 'Consultant'
})
$('.menu-item-object-blog').attr({
  'data-dlev': 'navClick',
  'data-dlcomp': 'link - nav - blog',
  'data-dltgt': 'Blog'
})

/* Lead Menu Items */
$('#lead-menu .menu-item').each((i, e) => {
  $(e).attr({
    'data-dlev': 'tagClick',
    'data-dlcomp': 'tag - lead menu',
    'data-dltgt': $(e).text()
  })
})

$('#top-menu a').each((i, e) => {
  $(e).attr({
    'data-dlev': 'linkClick',
    'data-dlcomp': 'link - header - menu',
    'data-dltgt': $(e).text()
  })
})

const currentDomain = window.location.origin;

$('.wdl-single-content a').each((i, e) => {
  // Check if link is internal or external
  if($(e).attr('href').indexOf('http') === 0 && $(e).attr('href').indexOf(currentDomain) !== 0) {
    $(e).attr({
      'data-dlev': 'linkClick',
      'data-dlcomp': 'link - post - content - external',
      'data-dltgt': $(e).text() + ' - ' + $(e).attr('href')
    })
  } else {
    $(e).attr({
      'data-dlev': 'linkClick',
      'data-dlcomp': 'link - post - content - internal',
      'data-dltgt': $(e).text() + ' - ' + $(e).attr('href')
    })
  }
})

$('[data-dlev]').each((i, e) => {
  const pushDataLayer = () => {
    window.dataLayer.push({
      'event': $(e).attr('data-dlev'),
      'component': $(e).attr('data-dlcomp'),
      'source': window.location.href,
      'target': $(e).attr('data-dltgt'),
      'data': $(e).attr('data-dldt')
    })
  }

  switch ($(e).attr('data-dlev')) {
    case 'search' : 
      $(window).onload(() => { pushDataLayer() })
    default : 
      $(e).click(() => { pushDataLayer() })
  }
})