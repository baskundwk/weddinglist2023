jQuery(document).ready(function ($) {
    // Select the slug area and insert the dynamic text
    const slugField = $('#edit-slug-box');
    const dynamicText = $('#dynamic-text-container');

    if (slugField.length && dynamicText.length) {
        slugField.after(`<div class="dynamic-text">${dynamicText.html()}</div>`);
    }

    // Optionally remove the hidden container
    dynamicText.remove();
});
