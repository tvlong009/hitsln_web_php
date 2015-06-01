$(function () {
    'use strict';

    var portfolio_id = parseInt($('#portfolio_id').val()) || 0;
    var portfolio_add = parseInt($('#portfolio_add').val()) || 0;
    
    var message = '';

    // Initialize the jQuery File Upload widget:
    $('#fileupload_portfolio').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: root_url + '/media/upload-portfolio',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000,
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload_portfolio').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    // Load existing files:
    $('#fileupload_portfolio').addClass('fileupload-processing');
    if (portfolio_id > 0 || portfolio_add > 0) {
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload_portfolio').fileupload('option', 'url'),
            data: {portfolio_id: portfolio_id},
            dataType: 'json',
            context: $('#fileupload_portfolio')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

    ///////////////////////////////////////////////
    $('#add_portfolio').click(function(){
        $('#images').html('');
        $('.image-item').each(function(){
            var image_name = $(this).val();

            $('#images').append('<input type="hidden" name="images[]" value="'+image_name+'"/>');
        });
        $('#my-form-portfolio').submit();
    });

    $('#edit-portfolio').click(function(){
        if (!$('.portfolio_id').is(':checked')) {
            message = 'Please choose portfolio to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.portfolio_id:checked').length > 1) {
             message = 'Can not edit more than one page for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            var id = $('.portfolio_id:checked:first-child').val();
            location.href = url + '/edit?id=' + id;
        }
    });
    
    $("#delete-portfolio").click(function(){
        if (!$('.portfolio_id').is(':checked')) {
            var message = 'Please choose portfolio to delete';
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