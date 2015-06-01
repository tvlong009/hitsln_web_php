$(document).ready(function(){
    $("#delete").click(function(){
        if (!$('.page_id').is(':checked')) {
            var message = 'Please choose page to delete';
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

    $('#edit').click(function(){
        if (!$('.page_id').is(':checked')) {
            message = 'Please choose page to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.page_id:checked').length > 1) {
             message = 'Can not edit more than one page for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.page_id:checked:first-child').val();
            location.href = url + '/edit?id=' + id;
        }
    });

    $('#myModal').on('show.bs.modal', function (e) {
        $('#myModal .modal-content').load(urlMedia + '/add-ajax');
    });

    $('#myModal').on('shown.bs.modal', function (e) {
        $(function () {
            'use strict';

            // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: root_url + '/media/upload',
                autoUpload: false,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                maxFileSize: 5000000,
            });

            // Enable iframe cross-domain access via redirect option:
            $('#fileupload').fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // Load existing files:
            $('#fileupload').addClass('fileupload-processing');
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').fileupload('option', 'url'),
                dataType: 'json',
                context: $('#fileupload')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, $.Event('done'), {result: result});
            });

            ///////////////////////////////////////////////

        });
    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#myModal .modal-content').html('');
    });

    $('#Scheduled_Publish').on('show.bs.modal', function (e) {
        $('.date-picker').datepicker({
            todayHighlight : true,
            format: 'mm/dd/yyyy'
        });
        $('.time-picker').timepicker({
            showMeridian: false,
        });
    });

    $('#Scheduled_Publish').on('hidden.bs.modal', function (e) {
        $('.redactor-toolbar').removeClass('less');
    });
    
   $(document).on('click', '#savepublishdate', function(){
        var page_id = parseInt($('#id').val()) || 0;
        var dateString = $('#publish_date').val();
        if (dateString == '') {
            message = 'Please choose date to publish';
            $('#publishdate_error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            $('#publishdate_error').html('');
            dateString = dateString.split('/');
            dateString = dateString[2] + '-' + dateString[0] + '-' + dateString[1];
            var timeString = $('#publish_time').val().split(' ');
            dateString += ' ' + timeString[0] + ':00';
            $('#publishdate').val(dateString);
            if (page_id > 0) {
                var url = urlPages + '/schedule-publish';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url,
                    data : {pageid: page_id, publishdate: dateString},
                    async: true,
                    success: function(json){
                        window.location.reload();
                    }
                });
            } else {
                var message = "Schedule publish time is save success . Please click button Save as draft of publish to save page info";
                $('.message').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+message+'</div>');
            }
            $('#Scheduled_Publish').modal('hide');
            return true;
        }
    });

    $('.content_type').click(function(){
        checkTypeContent();
    });
    checkTypeContent();

    $('#preview').click(function(){
        var url = '';
        var id = parseInt($('#id').val()) || 0;
        var data = $('#my-form').serialize();
        if (id > 0) {
            url = urlPages + '/edit-ajax';
        } else {
            url = urlPages + '/add-ajax';
        }
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: url,
            data : data,
            async: true,
            success: function(json){
                if(json.id){
                    $('#page_preview_modal').attr('src', urlPreviewPageFrontEnd + '?page=' + json.id+'&lang=' + currentLangID);
                    $('#preview_modal').modal('show'); 
                }
            }
        });

    });
});

function checkTypeContent() {
    var value = $('.content_type:checked').val();
    if (value == 1) {
        $('.content_html').removeClass('hidden');
        $('.content_php').addClass('hidden');
    } else if (value == 2) {
        $('.content_html').addClass('hidden');
        $('.content_php').removeClass('hidden');
    }
}