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
        });
        $('.time-picker').timepicker({
            showMeridian: false,
        });
    });

    $('#Scheduled_Publish').on('hidden.bs.modal', function (e) {
        $('.redactor-toolbar').removeClass('less');
    });

    var myVar = setInterval(function(){
        if ($('.reactor-toolbar')) {
            $('.redactor-toolbar').append('<li><a href="javascript:void(0)" class="re-icon re-particle" rel="particle" tabindex="-1"><i class="glyphicon glyphicon-book"></i></a></li>');
            clearInterval(myVar);
        }
    }, 300);

   $(document).on('click', '.re-particle', function(){
        $('#myParticle').modal();
   });

   $(document).on('click','#save', function(){
        var tab = $('.tab-pane.active').attr('id');
        $('.particle-item').each(function(index, item){
            if ($(this).is(':checked')) {
                var particle_key = $(this).val();
                $('#content_' + tab).redactor('insert.html','{{'+particle_key+'}}');
                $(this).attr('checked', false);
            }
        });

         $('#myParticle').modal('hide');
   });

   $(document).on('click', '#savepublishdate', function(){
        var page_id = parseInt($('#page_id').val()) || 0;
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
            }
            $('#Scheduled_Publish').modal('hide');
            return true;
        }
    });
});