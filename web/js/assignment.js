$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    var panels = $('.user-infos:first-child');
    var panelsButton = $('.dropdown-user');
    panels.show();

    $('.dropdown-user').on('click', function () {
        //Click dropdown
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $('.' + dataFor);
        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function () {
            //Completed slidetoggle
            if (idFor.is(':visible')) {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            } else {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        });
    });
});


$(function () {
    $(".btn-sm.btn-warning").click(function (event) {
        var className = $(this).attr('rel');
        var user_id = $(this).attr('id');
        if (confirm('Are you sure you want to change roles?')) {
            var selection = [];

            $('.' + className).find("input[name='Roles[]']:checked").each(function (index, item) {
                selection.push($(item).val());
            });

            $.ajax({
                type: "post",
                url: root_url + "/assignment/updaterole",
                data: {selection: selection, userId: user_id},
                dataType: "json",
                success: function (json) {
                    if (json.success == '1') {
                        message = 'Save user roles successfully';
                        $('.alert-messages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
                    }
                    else {
                        message = 'Save user roles false';
                        $('.alert-messages').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>');
                    }

                }
            });
        }
    });
});

$(function () {
    $(".btn-sm.btn-danger").click(function (event) {
        var className = $(this).attr('rel');
        var user_id = $(this).attr('id');
        if (confirm('Are you sure you want to remove this user?')) {
            var selection = [];

            $('.' + className).find("input[name='Roles[]']:checked").each(function (index, item) {
                selection.push($(item).val());
            });

            $.ajax({
                type: "post",
                url: root_url + "/assignment/deleteuserrole",
                data: {selection: selection, userId: user_id},
                dataType: "json",
                success: function (json) {
                    if (json.success == '1') {
                        window.location.reload();
                        alert("Delete user successfully");
                    }
                }

            });
        }
    });
});

$(function () {
    $('a.item', ".pagination").click(function (event) {

        //change active class
        $(".pagination").find("li").removeClass("active");
        $(this).parent("li").addClass("active");
        /// show the pages
        pagination();
    });


    $('li .glyphicon-forward', $('.pagination')).click(function (event) {
        //change active class
        var currentnum = $('li.active', $('.pagination')).find('a').attr('id');
        var lastpage = $('div.pagelimit', $('.pagination-centered')).attr('id');
        //console.log(pagelimit);
        if ($('li.active', $('.pagination')).find('a').attr('rel') == lastpage) {
        } else {
            $('li.active', $('.pagination')).next().addClass('active');
            $('#' + currentnum).parent().removeClass('active');

            /// show the pages
            pagination();
        }
    });

    $('li .glyphicon-fast-forward', $('.pagination')).click(function (event) {

        //change active class
        var currentnum = $('li.active', $('.pagination')).find('a').attr('id');
        var lastpage = $('div.pagelimit', $('.pagination-centered')).attr('id');
        if ($('li.active', $('.pagination')).find('a').attr('rel') == lastpage) {
        } else {
            $('#' + 'paging_' + lastpage).parent().addClass('active');
            $('#' + currentnum).parent().removeClass('active');

            /// show the pages
            pagination();
        }
    });


    $('li .glyphicon-backward', $('.pagination')).click(function (event) {
        //change active class
        var currentnum = $('li.active', $('.pagination')).find('a').attr('id');
        var pagelimit = $('div.pagelimit', $('.pagination-centered')).attr('id');
        var firstpage = 1;
        //console.log(pagelimit);
        if ($('li.active', $('.pagination')).find('a').attr('rel') == firstpage) {
        } else {
            $('li.active', $('.pagination')).prev().addClass('active');
            $('#' + currentnum).parent().removeClass('active');
            pagination();
        }
    });


    $('li .glyphicon-fast-backward', $('.pagination')).click(function (event) {

        //change active class
        var currentnum = $('li.active', $('.pagination')).find('a').attr('id');
        var lastpage = $('div.pagelimit', $('.pagination-centered')).attr('id');
        var firstpage = 1;
        if ($('li.active', $('.pagination')).find('a').attr('rel') == firstpage) {
        } else {
            $('#' + 'paging_' + firstpage).parent().addClass('active');
            $('#' + currentnum).parent().removeClass('active');
            // show pagination
            pagination();
        }
    });

    function pagination() {

        /// show the pages
        var pagenumber = $('li.active', ".pagination").find('a').attr('rel');
        var recordperpage = $('.recordperpage').attr('id');

        $.ajax({
            type: "post",
            url: root_url + "/assignment/pagination",
            data: {pagenumber: pagenumber, recordperpage: recordperpage},
            dataType: "text",
            success: function (json) {
                $(".row.user-row").remove();
                $(".row.user-infos").remove();
                $(".well").append(json);

                $('[data-toggle="tooltip"]').tooltip();


                var panels = $('.user-infos');
                var panelsButton = $('.dropdown-user');
                panels.hide();
                panels = panels.first();
                panels.show();

                $('.dropdown-user').click(function () {
                    //Click dropdown
                    //get data-for attribute
                    var dataFor = $(this).attr('data-for');
                    var idFor = $(dataFor);
                    console.log(idFor);
                    //current button
                    var currentButton = $(this);
                    idFor.slideToggle(400, function () {
                        //Completed slidetoggle
                        if (idFor.is(':visible')) {
                            currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
                        } else {
                            currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
                        }
                    });
                });
            }

        });
    }

});