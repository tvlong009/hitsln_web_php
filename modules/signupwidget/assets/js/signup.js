$(document).ready(function(){
    $('#add_custom_field').click(function(){
        var template = $('.custom_field_template').html();
        $('#add_custom_field').parent().parent().before('<div class="row custom_field" style="margin-top:10px;">' + template + '</div>');
    });

    $(document).on('click', '.del_field', function(){
        var row = $(this).parent().parent();
        if (window.confirm('Are you sure')) {
            row.remove();
        }
    });
});