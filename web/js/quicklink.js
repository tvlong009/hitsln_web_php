/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $('#edit-quick-link').click(function(){
        if (!$('.quick_link_id').is(':checked')) {
            message = 'Please choose quick link to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.quick_link_id:checked').length > 1) {
            message = 'Can not edit more than one quick link for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.quick_link_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });

    $("#delete-quick-link").click(function(){
        if (!$('.quick_link_id').is(':checked')) {
            var message = 'Please choose quick link to delete';
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

    checkType();
    $('#type').change(function(){
        checkType();
    });
});

function checkType(){
    var type = $('#type').val();
    if (type == 1) {
        $('#action').show();
        $('#url').hide();
    } else {
        $('#action').hide();
        $('#url').show();
    }
}