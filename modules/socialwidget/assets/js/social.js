$(function () {
    'use strict';
    var message = '';

    $('#add_social').click(function(){
        $('#images').html('');
        $('.image-item').each(function(){
            var image_name = $(this).val();

            $('#images').append('<input type="hidden" name="images[]" value="'+image_name+'"/>');
        });
        $('#my-form-social').submit();
    });

    $('#edit-social').click(function(){
        if (!$('.social_id').is(':checked')) {
            message = 'Please choose social to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.portfolio_id:checked').length > 1) {
             message = 'Can not edit more than one page for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            var id = $('.social_id:checked:first-child').val();
            location.href = url + '/edit?id=' + id;
        }
    });

    $("#delete-social").click(function(){
        if (!$('.social_id').is(':checked')) {
            var message = 'Please choose social to delete';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            if (window.confirm('Are you sure ?')) {
                var data = $('#my_form').serialize();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url + '/delete',
                    data: data,
                    async: true,
                    success: function (json) {
                        window.location.reload();
                    }
                });
            }
        }
    });
});


