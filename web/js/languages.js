function loadmessage() {
    var languagecode = $('.language_seleted').val();

    $.ajax({
        type: 'post',
        dataType: 'text',
        url: url + '/displaylanguage',
        data: {
            langcode: languagecode
        },
        async: true,
        success: function (text) {
            $(".source_messages").remove();
            $(".message_list").html(text);
        }
    });
}
$(document).ready(function () {
    loadmessage();
});
$(function () {
    $('#edit-languages').click(function () {
        if (!$('.language_id').is(':checked')) {
            message = 'Please choose language to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if ($('.language_id:checked').length > 1) {
            message = 'Can not edit more than one language for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.language_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });

    $("#delete-languages").click(function () {
        if (!$('.language_id').is(':checked')) {
            var message = 'Please choose languages to delete';
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
    $('.language_seleted').click(function () {
        loadmessage();
    });

    $('.buttonSaveLanguageMessage').click(function () {
        if (confirm('Are you sure to save these messages')) {
            var messages = [];
            $('.message_list').find("input[name='message_language']").each(function (index, item) {
                messages.push($(item).val());
            });
            var messages_id = [];
            $('.message_list').find("input[name='message_language']").each(function (index, item) {
                messages_id.push(($(item).attr('id')).replace('m_', ''));
            });
            var languagecode = $('.language_seleted').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: url + '/savelangmessages',
                data: {
                    messages: messages,
                    messages_id: messages_id,
                    langcode: languagecode
                },
                async: true,
                success: function (json) {
                    if (json.success == '1') {
                        $('.alert_messages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + json.notification + '</div>');
                        
                    }
                    else {
                        $('.alert_messages').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + json.notification + '</div>');
                    }
                }
            });
        }
    });

});