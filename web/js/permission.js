function load_permission(id, type) {
    if (typeof type == 'undefined')
        type = 'user';
    $.ajax({
        type: "post",
        url: root_url + "/permission/permissions",
        data: 'userId' + '=' + id + '&object_class=' + type,
        dataType: "json",
        success: function (json) {
            $("." + type + "_permission ."+ type + "_permission_list div").html(json.html);
            $('.can_click', $('.'+type+'_permission_list')).click(function (event) {
                $(this).toggleClass("active");
                $(this).dblclick(function (event) {
                    $(this).removeClass("active");
                });
            });
        }
    });
}
$(document).ready(function () {
    $('.User_list').find('li').first().addClass('active');
    load_permission($('.User_list').find('.active').first().attr('id'));
    $('.role_list').find('li').first().addClass('active');
    load_permission($('.role_list').find('.active').first().attr('id'), 'role');

    $('.list-arrows button').click(function () {
        var $button = $(this), actives = '';
        if ($button.hasClass('move-left')) {
            actives = $('.list-right ul li.active');
            actives.clone().appendTo('.list-left ul');
            actives.remove();
        } else if ($button.hasClass('move-right')) {
            actives = $('.list-left ul li.active');
            actives.clone().appendTo('.list-right ul');
            actives.remove();
        }
    });
    $('.dual-list .selector').click(function () {
        var $checkBox = $(this);
        if (!$checkBox.hasClass('selected')) {
            $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
            $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
        } else {
            $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
            $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
        }
    });
    $('[name="SearchUserNameList"]').keyup(function (e) {
        var code = e.keyCode || e.which;
        if (code == '9')
            return;
        if (code == '27')
            $(this).val(null);
        var $rows = $(this).closest('.dual-list').find('.list-group li');
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
    $('.User_list').find('li').click(function (event) {
        $('.User_list').find('li').removeClass('active');
        $(this).toggleClass("active");
        load_permission($(this).attr('id'));
    });

    $('.role_list').find('li').click(function (event) {
        $('.role_list').find('li').removeClass('active');
        $(this).toggleClass("active");
        load_permission($(this).attr('id'), 'role');
    });

    $('.buttonSaveUserPermission').click(function (event) {
        var permission_array = [];
        $.each($('li .can_click.list-group-item.active', $(".user_permission .user_permission_list")), function (i, item) {
            permission_array.push($(item).attr('rel'));
        });
        var userId = $('.User_list li.active').attr('id');
        $.ajax({
            type: "post",
            url: root_url + "/permission/savepermission",
            data: {
                userId: userId,
                object_class: 'user',
                Permission: permission_array
            },
            dataType: "json",
            success: function (json) {
                if (json.success == '1') {
                    alert("Save User permission successfully")
                }
            }
        });
    });

    $('.buttonSaveRolePermission').click(function (event) {
        var permission_array = [];
        $.each($('li.can_click.list-group-item.active', $(".role_permission .role_permission_list")), function (i, item) {
            permission_array.push($(item).attr('rel'));
        });
        var RoleId = $('.role_list li.active').attr('id');
        $.ajax({
            type: "post",
            url: root_url + "/permission/savepermission",
            data: {
                RoleId: RoleId,
                object_class: 'role',
                Permission: permission_array
            },
            dataType: "json",
            success: function (json) {
                if (json.success == '1') {
                    alert("Save Role permission successfully")
                }
            }
        });
    });
});
 