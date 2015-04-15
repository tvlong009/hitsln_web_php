$(function () {
    $('#edit-contentlist').click(function(){
        if (!$('.contentlist_id').is(':checked')) {
            message = 'Please choose content list to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.contentlist_id:checked').length > 1) {
             message = 'Can not edit more than one content list for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.contentlist_id:checked:first-child').val();
            location.href = url + '/edit?id=' + id;
        }
    });
    
    $("#delete-contentlist").click(function(){
        if (!$('.contentlist_id').is(':checked')) {
            var message = 'Please choose content list to delete';
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