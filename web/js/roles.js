
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $('#edit-roles').click(function(){
        if (!$('.role_id').is(':checked')) {
            message = 'Please choose role to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.role_id:checked').length > 1) {
             message = 'Can not edit more than one role for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.role_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });
    
    $("#delete-roles").click(function(){
        if (!$('.role_id').is(':checked')) {
            var message = 'Please choose roles to delete';
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