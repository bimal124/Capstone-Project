jQuery(document).ready(function ($) {

    $('input[name=name]').focus();

    $("#admin-blog-category-form").validate({
        submitHandler: function (form) {
            //form.submit();
            jQuery.ajax({
                type: "POST",
                url: $("#frm_action_url").html(),
                datatype: 'json',
                data: $('#admin-blog-category-form').serialize(),
                beforeSend: function () {
                    $(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                    $("i").remove(".fa-spin");
                },
                success: function (data) {

                    var response = $.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token

                    if (response.status == "success") {
                        location.reload();

                    } else {

                        $("#errorAlert").show();
                        $("#formValidationErrors").html(response.message);
                    }
                },
            }); //jquery ajax ends here
        },
        errorElement: "div",
        //errorClass: "form_validation_error",

        rules: {
            email: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Email is required",
            },
        }
    });//validate end

    $.fn.initializeCRUD = function (options) {
        $("#add_data").click(function (e) {
            //$("#membershp_form").slideDown(200).show();
            $("#frm_action_url").html(add_data);
            $('#myModal').modal({keyboard: false, backdrop: 'static', show: 'toggle'});
        });

        $(".update_data").click(function (e) {
            //console.log(this.name);
            $("#post_id").val(this.name);
            $("#frm_action_url").html(update_data + '/' + this.name);
            $('#myModal').modal({keyboard: false, backdrop: 'static', show: 'toggle'});

            //get data and fill in the form
            $.ajax({
                type: "POST",
                url: get_data + '/' + this.name,
                datatype: 'json',
                data: {csrf_emts_name: $("#csrf_token").val()},
                beforeSend: function () {
                    //$(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                },
                success: function (data) {
                    //console.log(data);
                    var response = $.parseJSON(data);

                    $("#csrf_token").val(response.csrf_token);//replace token
                    if (response.status == "success") {
                        // reset form values from json object
                        $.each(response.message[0], function (name, val) {

                            var $el = $('#myModal').find('[name="' + name + '"]'),
                                    type = $el.attr('type');

                            switch (type) {
                                case 'checkbox':
                                    $el.attr('checked', 'checked');
                                    break;
                                case 'select':
                                    $el.filter('[value="' + val + '"]').attr('selected', 'selected');
                                    break;
                                case 'radio':
                                    $el.each(function (e) {
                                        if ($(this).val() == val) {
                                            $(this).attr('checked', 'checked');
                                        } else {
                                            $(this).removeAttr('checked');
                                        }
                                    })
                                    break;
                                default:
                                    $el.val(val);
                            }
                        });
                        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                            checkboxClass: 'icheckbox_square-blue',
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        })



                    } else {
                        $('#myModal').modal('hide');
                        $("#msgError").show();
                        $("#errorMsg").html(response.message);
                    }
                },
            }); //jquery ajax ends here


        });
        $(".delete_data").click(function (e) {
            var did = $(this).data("id");
            var result = confirm('Are you sure you want to unsubscribe?');
            if (result) {
                //get data and fill in the form
                jQuery.ajax({
                    type: "POST",
                    url: delete_data + '/' + $(this).data("id"),
                    datatype: 'json',
                    data: {csrf_emts_name: $("#csrf_token").val()},
                    beforeSend: function () {
                        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                    },
                    complete: function () {
                        $("div").remove(".overlay");
                    },
                    success: function (data) {

                        var response = $.parseJSON(data);
                        $("#csrf_token").val(response.csrf_token);//replace token
                        if (response.status == "success") {
                            location.reload();
                        } else {

                            $("#msgError").show();
                            $("#errorMsg").html(response.message);

                        }
                    },
                }); //jquery ajax ends here
            }
        });

    }

    $().initializeCRUD();

    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#admin-blog-category-form')[0].reset();
        $('#admin-blog-category-form div.text-red').remove();
        $('#admin-blog-category-form .text-red').removeClass('text-red');
    });
    $('#admin-subscribe-mail-modal').on('show.bs.modal', function (e) {
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        })
        $().subscriberInitializeCheckBox();
    });
    $('#myModal').on('show.bs.modal', function (e) {
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        })
        $().subscriberInitializeCheckBox();
    });
    $.fn.loadData = function (options) {

        var container = $(this);
        var searching_data = {};
        $('.data-search-inputs input').each(function (e) {
            if ($(this).val() != '') {
                searching_data[$(this).attr('name')] = $(this).val();
            }
        })
        var formData = {
            "csrf_emts_name": $("#csrf_token").val(),
            "limit": options.limit,
            "offset": options.offset,
            "searching_data": searching_data
        }
        $("#loader_message").show();
        $.ajax({
            type: "POST",
            url: filter_data_url,
            data: formData,
            cache: false,
            datatype: 'json',
            beforeSend: function () {

                $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            complete: function () {
                $("div").remove(".overlay");
            },
            success: function (data) {

                var response = $.parseJSON(data);
                $('#csrf_token').val(response.csrf_token);
                if (response.status == "success") {
                    var html_collection = '';
                    var cnt = 1;
                    var temp_str = '';
                    //console.log(response.itemlist);
                    $.each(response.itemlist, function (key, val) {

                        html_collection += '<tr  data-id="' + val.id + '">';
                        html_collection += '<td data-serial="subscriber">' + cnt;
                        html_collection += '</td>';
                        html_collection += '<td>' + val.email;
                        html_collection += '</td>';
                        html_collection += '<td>' + val.reg_ip_address;
                        html_collection += '</td>';
                        var create_date = val.reg_date;
                        html_collection += '<td>' + create_date;
                        html_collection += '</td>';
                        /*html_collection += '<td>';
                        html_collection += '<div class="tools">';
                        html_collection += '<a href="javascript:void(0);" class="update_data" name="' + val.id + '"><i class="fa fa-edit text-yellow"></i></a>';
                        html_collection += ' <a href="javascript:void(0);" class="delete_data" data-id="' + val.id + '"><i class="fa fa-trash-o text-red"></i></a>';
                        html_collection += '</div>';
                        html_collection += '</td>';*/
                        html_collection += '</tr>';
                        cnt++;
                    })
                    container.append(html_collection);
                    if (cnt > 1) {
                        $('#bidpackage_loader_message').show();
                    } else {
                        $('#bidpackage_loader_message').hide();
                    }
                    if (container.find('tr').length > 0) {
                        $('.no-record-found-label').hide();
                    } else {
                        $('.no-record-found-label').show();
                    }
                    var sr = 1;
                    $('[data-serial="subscriber"]').each(function () {
                        $(this).text(sr + '.');
                        sr++;
                    })
                    $().initializeCRUD();

                } else {
                    $("#loader_message").hide();
                }

            }

        });

    }
    var bidpackage_limit = admindata_limit;
    var bidpackage_offset = admindata_offset;
    $('#bidpackage_loader_message').on('click', function (e) {
        bidpackage_offset += parseInt(bidpackage_limit);
        $('.blog_category_data_container').loadData({
            limit: bidpackage_limit,
            offset: bidpackage_offset,
        });
    })
    $('.data-search-inputs input').on('change', function (e) {

        bidpackage_offset = 0;
        $('.blog_category_data_container').html('');
        $('.blog_category_data_container').loadData({
            limit: bidpackage_limit,
            offset: bidpackage_offset,
        });
    })

    $('.subscriber-csv-import').on('click', function (e) {
        var create_temp_ele = $('<input id="csv-import-file" type="file" name="csv_file" accept=".csv">');
        var submt_url = $(this).attr('href');
        create_temp_ele.click();
        create_temp_ele.on('change', function (e) {
            var myFormData = new FormData('<form enctype="multipart/form-data"></form>');
            myFormData.append('csv_file', create_temp_ele[0].files[0]);
            myFormData.append('csrf_emts_name', $("#csrf_token").val());
            $.ajax({
                url: submt_url,
                type: 'POST',
                datatype: 'json',
                data: myFormData,
                processData: false, // important
                contentType: false, // important
                success: function (data) {
                    var response = $.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token

                    if (response.status == "success") {
                        location.reload();
                    } else {
                        $("#msgError").show();
                        $("#errorMsg").html(response.message);
                        $("#loader_message").hide();
                    }
                }
            })

        })


        return false
    })
    $('.subscriber-mail-send').on('click', function (e) {
        e.preventDefault();
        $('#admin-subscribe-mail-modal').modal({keyboard: false, backdrop: 'static', show: 'toggle'});
    })
    $.fn.subscriberInitializeCheckBox = function () {
        $('.flat-red').on('ifChanged', function (e) {
            if ($(this).val() == 1) {
                $('.send-to-indivisual-container').slideUp();
            } else {
                $('.send-to-indivisual-container').slideDown();
            }
        })
    }
    $().subscriberInitializeCheckBox();
    $('#email-template-selection').on('change', function (e) {
        if ($(this).val()) {
            $('.individual-email-mesg-container').slideUp();
        } else {
            $('.individual-email-mesg-container').slideDown();
        }
    })

    var subscriber_mail_send_form = $("#admin-subscribe-mail-form").validate({
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: $(form).attr('action'),
                datatype: 'json',
                data: $(form).serialize(),
                beforeSend: function () {
                    $(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                    $("i").remove(".fa-spin");
                },
                success: function (data) {

                    var response = $.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token
                    $(".csrf_token").val(response.csrf_token);//replace token
                    $('.redirect-alert-msg').remove();
                    if (response.status == "success") {
                        $("#successMsg").html(response.message);
                        $("#msgSuccess").show();

                        $('#admin-blog-category-form').trigger('reset');
                        $('#admin-subscribe-mail-modal').modal('hide');
                        $('#admin-subscribe-mail-modal #errorAlert').hide();

                        $("#admin-subscribe-mail-modal #msgSuccess").show();
                        $("#admin-subscribe-mail-modal #successMsg").html(response.message);

                    } else {

                        $("#admin-subscribe-mail-modal #errorAlert").show();
                        $("#admin-subscribe-mail-modal #formValidationErrors").html(response.message);
                    }
                },
            }); //jquery ajax ends here
            return false;
        },
        errorElement: "div",
        errorClass: "form_validation_error",
        rules: {
            all_or_individual: {
                required: true,
            },
            'email[]': {
                required: true,
            },
            subject: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            all_or_individual: {
                required: 'At least one option is required.',
            },
            'email[]': {
                required: "At one email is required.",
            },
            subject: {
                required: 'Email subject is required.',
            },
            message: {
                required: 'Message is required.',
            },
        }
    });//validate end

});