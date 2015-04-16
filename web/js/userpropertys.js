/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $('#edit-user-property').click(function(){
        if (!$('.property_id').is(':checked')) {
            message = 'Please choose user property to edit';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else if($('.property_id:checked').length > 1) {
             message = 'Can not edit more than one user for same time';
            $('#error').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
        } else {
            id = $('.property_id:checked:first-child').val();
            location.href = url + '/update?id=' + id;
        }
    });
    
    $("#delete-user-property").click(function(){
        if (!$('.property_id').is(':checked')) {
            var message = 'Please choose user property to delete';
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
    
    check_display();
    
    $('#userproperty-type').change(function(){
    	check_display();
    });
    
    $('.field-userproperty-value').append('<code>Value separate by comma. Ex: value1, value2, value3..</code>');
    
});

function check_display()
{
	var exclude = ['1', '11', '13', '15', '17'];	
	var type = $('#userproperty-type').val();	
	if ($.inArray(type, exclude) > -1) {
		$(".field-userproperty-value").addClass('hidden');
	} else {
		$(".field-userproperty-value").removeClass('hidden');
	}
}