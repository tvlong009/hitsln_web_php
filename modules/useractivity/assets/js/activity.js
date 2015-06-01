$(function () {
    function IsJsonString(str) {
        try {
            jQuery.parseJSON(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    function htmlEncodeEntities(s) {
        return $("<div/>").text(s).html();
    }
    $("#frsee").submit(function () {
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: function (data)
            {
                // every record
                if(data == '') {
                    alert('No more record!');
                    return false;
                }
                Object.keys(data).forEach(function (key) {
                    ht = '';
                    ht += '<tr>';
                    // every colum of record
                    Object.keys(data[key]).forEach(function (key2) {
                        var link = '';
                        var temp = 0;
                        if (key2 == 'old_data' && IsJsonString(data[key][key2])) {
                            ht += '<td>';
                            var old = jQuery.parseJSON(data[key][key2]);
                            delete old.created;
                            delete old.modified;
                            Object.keys(old).forEach(function (key3) {

                                ht += '<p><b>' + key3 + '</b>: ' + htmlEncodeEntities(old[key3]) + '</p>';
                            });

                            ht += '</td>';
                        } else if (key2 == 'new_data' && IsJsonString(data[key][key2])) {
                            ht += '<td>';
                            var new_data = jQuery.parseJSON(data[key][key2]);
                            delete new_data.created;
                            delete new_data.modified;
                            Object.keys(new_data).forEach(function (key3) {
                                ht += '<p><b>' + key3 + '</b>: ' + htmlEncodeEntities(new_data[key3]) + '</p>';
                            });
                            ht += '</td>';
                        } else if(key2 == 'module' || key2 == 'controller' || key2 == 'action'){
                           link += data[key][key2] + '/';
                           temp ++;
                           if(temp == 2){
                               ht += '<td>'+link+'</td>';
                               link = '';
                           }
                        } else{
                            ht += '<td>'+data[key][key2]+'</td>';
                        }

                    });
                    ht += '</tr>';
                    $('#t_body').append(ht);
                });
                // set offset
                var offset = Number($('#offset').val()) + Number($('#limit').val());
                $('#offset').val(offset);
            }
        });

        return false;
    });
});


