$(document).ready(function(){
    $(document).on('click', '.item', function(event){
        event.preventDefault();
        var current_id = $(this).attr('id');
        var type = $(this).attr('rel');
        var level = $(this).data('level');
        var list = [];
        var items = $(this).closest('tr').parent().find('.level_' + level);
        if (items) {
            items.each(function(){
                list.push($(this).attr('id'));
            });
        }

        list = jQuery.unique(list);
        var indexOf = list.indexOf(current_id);

        if (indexOf >= 0) {
            if (type == 1) {
                if (list[indexOf - 1] && $('#' + (list[indexOf - 1]))) {
                    var prev_id = $('#' + (list[indexOf - 1])).attr('id');
                    var data = {current_id: current_id, prev_id: prev_id, type: type}
                }
            } else if (type == 2) {
                var next_id = $('#' + (list[indexOf + 1])).attr('id');
                if (list[indexOf + 1] && $('#' + (list[indexOf + 1]))) {
                    var next_id = $('#' + (list[indexOf + 1])).attr('id');
                    var data = {current_id: current_id, next_id: next_id, type: type};
                }
            }

            $.ajax({
                url: url + '/change-display-order?menu_id=' + menu_id,
                dataType: 'json',
                type: 'post',
                data: data,
                async: true,
                success: function(json){
                    if (json.error == 1) {
                        var message = 'Can not change display order for item';
                        $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
                    } else if (json.success == 1) {
                        window.location.reload();
                    }
                }
            });
        }
    });

    $('#edit-menu-item').click(function(){
        if (!$('.menu_item_id').is(':checked')) {
            message = 'Please choose menu to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.menu_item_id:checked').length > 1) {
            message = 'Can not edit more than one menu for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.menu_item_id:checked:first-child').val();
            location.href = url + '/update?id=' + id + '&menu_id=' + menu_id;
        }
    });

    $("#delete-menu-item").click(function(){
        if (!$('.menu_item_id').is(':checked')) {
            var message = 'Please choose menu to delete';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            if (window.confirm('Are you sure ?')) {
                var data = $('#my_form').serialize();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url + '/delete?menu_id='+menu_id,
                    data: data,
                    async: true,
                    success: function (json) {
                        window.location.reload();
                    }
                });
            }
        }
    });

    if (typeof(menuId) != 'undefined') {
        $('#' + menuId).superfish();
    }
});
