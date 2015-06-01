/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $('#edit-menu').click(function(){
        if (!$('.menu_id').is(':checked')) {
            message = 'Please choose menu to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.menu_id:checked').length > 1) {
            message = 'Can not edit more than one menu for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.menu_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });

    $("#delete-menu").click(function(){
        if (!$('.menu_id').is(':checked')) {
            var message = 'Please choose menu to delete';
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

    $('#pageKey').change(function(){
        var value = $(this).val();
        $("#link_txt").val(page_url + '?page=' + value);
    });
});

function render_page(url){
    $.get(url, function(json){
        if (json.error == 1) {
            window.location.href = json.redirect_url;
        } else {
            $('.content').html(json.page_content);
        }
    });
}