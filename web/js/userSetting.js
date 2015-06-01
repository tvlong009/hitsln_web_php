
$(function () {
    $('#edit-user-setting').click(function(){
        
        if (!$('.user-setting-id').is(':checked')) {
            message = 'Please choose user setting to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.user-setting-id:checked').length > 1) {
             message = 'Can not edit more than one user setting for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.user-setting-id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });
    
    $("#delete-user-setting").click(function(){
        if (!$('.user-setting-id').is(':checked')) {
            var message = 'Please choose user setting to delete';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            if (window.confirm('Are you sure ?')) {
                   var user_setting_id = [];

            $("input[name='id[]']:checked").each(function (index, item) {
                user_setting_id.push($(item).val());
            });

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url + '/delete',
                    data: {userSetting: user_setting_id },
                    async: true,
                    success: function (json) {
                        window.location.reload();
                    }
                });
            }
        }
    });
});