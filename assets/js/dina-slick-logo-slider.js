// (function($) {
$('.dina_logo_slider-container').each(function() {
    const settings = $(this).data('settings');

    console.log(settings);
    $(this).slick(settings);
});
