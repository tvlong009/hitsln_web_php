$(function () {
    $('[data-toggle="popover"]').popover({
        //trigger: 'hover',			
        html: true
    });
});
$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

$(document).ready(function(){
    $('.modal-backdrop.in').css('z-index', 'inherit');
});