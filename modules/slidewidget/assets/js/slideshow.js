//$(function () {
//
//    $('body').on('click', '.list-group .list-group-item', function () {
//        $(this).toggleClass('active');
//    });
// 
//    $('.selector').click(function () {
//        var $checkBox = $(this);
//        if (!$checkBox.hasClass('selected')) {
//            $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
//            $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
//        } else {
//            $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
//            $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
//        }
//    });
//
//});

///////////////////////////////////////////////////////////
//function LoadSlideAndItem(type) {
//    $.ajax({
//        type: "post",
//        data: {type: type},
//        url: url + "/loadslideshow/",
//        dataType: "json",
//        success: function (json) {
//            if(type == ""){;
//                $('.slide_list').html(json.html_slide);
//                $('.item_list').html(json.html_item);
//            }
//        }
//    });
//}
//////////////Load Page
//$(document).ready(function () {
//    LoadSlideAndItem("");
//});

$(function () {
    $('#edit-slide').click(function () {
        if (!$('.slide_id').is(':checked')) {
            message = 'Please choose slide to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if ($('.slide_id:checked').length > 1) {
            message = 'Can not edit more than one slide for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.slide_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });

    $("#delete-slide").click(function () {
        if (!$('.slide_id').is(':checked')) {
            var message = 'Please choose slide to delete';
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
    
    $('#edit-item').click(function () {
        if (!$('.item_id').is(':checked')) {
            message = 'Please choose item to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if ($('.item_id:checked').length > 1) {
            message = 'Can not edit more than one item for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.item_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });

    $("#delete-item").click(function () {
        if (!$('.item_id').is(':checked')) {
            var message = 'Please choose item to delete';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            if (window.confirm('Are you sure ?')) {
                var data = $('#my_form').serialize();
                console.log(data);
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