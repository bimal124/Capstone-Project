jQuery(document).ready(function ($) {



    $('input[name=name]').focus();


    $(".hideshow").click(function () {
        $('#password').val("");
        $("#confield").val("");
        $('#autofield').toggle();
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {                
                $('#img_pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#img").change(function () {
        
        readURL(this);

    });

    var admin_member_form = $("#admindataForm").validate({
        submitHandler: function (form) {
            // form.submit();
            var formData = new FormData($('#admindataForm')[0]);
            
            jQuery.ajax({
                type: "POST",
                url: $("#frm_action_url").html(),
                datatype: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');

                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                    $("i").remove(".fa-spin");
                },
                success: function (data) {
                    var response = jQuery.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token

                    if (response.status == "success") {
                        $('#admindataForm').trigger('reset');
                        $('#myModal_admindata').modal('hide');
                        $('#errorAlert').hide();
                        //$('#msgSuccess').show();
                        // $('#successMsg').html(response.message);										
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
            user_name: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            conf: {
                required: true,
                equalTo: "#password"
            },
            user_type: {
                required: true,
            },
            status: {
                required: true,
            },
            role_id: {
                required: true,
            },
        },
        messages: {
            user_name: {
                minlength: "Please enter username more than 6 letters.",
                required: "Username is required",
            },
            email: {
                required: "your email is required",
            },
            password: {
                required: "Password is Required",
                minlength: "Please enter password more than 6 letters."
            },
            conf: {
                required: "confirm password  is Required",
                equalTo: "Password Do not Match"
            },
            user_type: {
                required: "usertype is Required",
            },
            status: {
                required: "status is Required",
            },
            role_id: {
                required: "Role must be define",
            },
        },
        errorPlacement: function (error, element) {
            /*if(element.attr("name") == "admin_captcha") {
             error.appendTo( $('#admincapcha_error_container') );
             }
             else {*/
            error.insertAfter(element);
            //}
        }
    });//validate end
    $("#add_admindata").click(function (e) {
        //$("#membershp_form").slideDown(200).show();

        $("#autofield").show();
        $(".hideshow").hide();
        $("#frm_action_url").html(add_administration_admindata);
        $('#img_pic').attr('src',admin_form_default_image);
        $('#myModal_admindata').modal({keyboard: false, backdrop: 'static', show: 'toggle'});
    });


    $("#myModal_admindata").on("hidden.bs.modal", function () {
        
        $('#admindataForm').trigger('reset');
        $('div.text-red').hide();
        $('.form-control').removeClass('text-red');
        $('#errorAlert').hide();
        $('#admindataForm')[0].reset();



    });

    $(document).on('click', '.update_admindata', function () {

        var a = $("#frm_action_url").html(update_administrationdata + '/' + this.name);
        $("#hideshow").show();
        $('#autofield').hide();
        $('#myModal_admindata').modal({keyboard: false, backdrop: 'static', show: 'toggle'});
        admin_member_form.settings.rules.password.required = false;
        admin_member_form.settings.rules.conf.required = false;
        jQuery.ajax({
            type: "POST",
            url: get_administration_data + '/' + this.name,
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
                var response = jQuery.parseJSON(data);
                //console.log(response.message[0]);
                $("#admindataForm #csrf_token").val(response.csrf_token);//replace token
                if (response.status == "success") {
                    // reset form values from json object
                    $.each(response.message[0], function (name, val) {

                        if (name == 'image') {
                            if(val == ''){
                                $('#img_pic').attr('src',admin_form_default_image);
                                
                            }else{
                                $('#img_pic').attr('src', val);
                            }
                            
                        }else if(name == 'password'){
                            
                        }else {
                            var $el = $('[name="' + name + '"]'),
                                    type = $el.attr('type');

                            switch (type) {
                                case 'checkbox':
                                    $el.attr('checked', 'checked');
                                    break;
                                case 'select':
                                    $el.filter('[value="' + val + '"]').attr('selected', 'selected');
                                    break;
                                case 'radio':
                                    $el.filter('[value="' + val + '"]').attr('checked', 'checked');
                                    break;
                                default:
                                    $el.val(val);
                            }
                        }


                    });
                } else {
                    
                    $('#myModal_admindata').modal('hide');
                    $("#msgError").show();
                    $("#errorMsg").html(response.message);
                }
            },
        }); //jquery ajax ends here


    });


    $(document).on('click', '.delete_admindata', function () {

        if (confirm("Are you sure you want to delete?"))
        {



            var did = $(this).data("id");
            //get data and fill in the form
            jQuery.ajax({
                type: "POST",
                url: delete_administration_data + '/' + $(this).data("id"),
                datatype: 'json',
                data: {csrf_emts_name: $("#csrf_token").val()},
                beforeSend: function () {
                    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                },
                complete: function () {
                    $("div").remove(".overlay");
                    //$("#msgSuccess").hide();
                    //$("#msgError").hide();
                },
                success: function (data) {
                    //console.log(data);
                    var response = jQuery.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token
                    $(".alert-success").hide();
                    if (response.status == "success") {
                        $("#" + did).hide("slow", function () {
                            $("#" + did).remove();
                        });
                        $("#msgSuccess").show();
                        $("#successMsg").html(response.message);
                        location.reload();
                    } else {
                        $("#msgError").show();
                        $("#errorMsg").html(response.message);
                    }
                },
            }); //jquery ajax ends here
        }
        else {
            return false;
        }
    });


    $(document).on('click', '#admin_listing_loader_message', function () {

        admindata_offset = parseInt(admindata_limit) + parseInt(admindata_offset);
        displayAdminResults(admindata_limit, admindata_offset);

    });

    /************************************administration role***************************************************/


    //update admin role
    $("#roledataForm").validate({
        submitHandler: function (form) {
            
            jQuery.ajax({
                type: "POST",
                url: $("#frm_action_url").html(),
                datatype: 'json',
                data: $('#roledataForm').serialize(),
                beforeSend: function () {
                    $(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                    $("i").remove(".fa-spin");
                },
                success: function (data) {
                    //console.log(data);
                    var response = jQuery.parseJSON(data);
                   // $("#csrf_token").val(response.csrf_token);//replace token

                    if (response.status == "success") {
                        $('#adminForm').trigger('reset');
                        $('#myModal').modal('hide');
                        $('#errorAlert').hide();
                        //$('#msgSuccess').show();
                        //$('#successMsg').html(response.message);                                      
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
            role_name: {
                required: true,
                minlength: 3
            },
            role_code: {
                required: true,
                minlength: 3
            },
            role_desc: {
                required: true
            }

        },
        messages: {
            role_name: {
                minlength: "Please enter role name",
                required: "Role name is required",
            },
            role_code: {
                required: "role code is required",
            },
            role_desc: {
                required: "Role description is Required",
            }
        },
        errorPlacement: function (error, element) {
            /*if(element.attr("name") == "admin_captcha") {
             error.appendTo( $('#admincapcha_error_container') );
             }
             else {*/
            error.insertAfter(element);
            //}
        }
    });//validate end





//delete admin role

    $(".delete_adminrole").click(function (e) {
        var did = $(this).data("id");
        //get data and fill in the form
        if (confirm("Are you sure to delete permanently?")) {
            jQuery.ajax({
                type: "POST",
                url: delete_role_data + '/' + $(this).data("id"),
                datatype: 'json',
                data: {csrf_emts_name: $("#csrf_token").val()},
                beforeSend: function () {
                    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                },
                complete: function () {
                    $("div").remove(".overlay");
                    //$("#msgSuccess").hide();
                    //$("#msgError").hide();
                },
                success: function (data) {
                    //console.log(data);
                    var response = jQuery.parseJSON(data);
                    $("#csrf_token").val(response.csrf_token);//replace token
                    $(".alert-success").hide();
                    if (response.status == "success") {
                        $("#" + did).hide("slow", function () {
                            $('#admin_role' + did).remove();
                        });

                        $("#msgSuccess").show();
                        $("#successMsg").html(response.message);
                        location.reload();
                    } else {
                        $("#msgError").show();
                        $("#errorMsg").html(response.message);
                    }
                },
            }); //jquery ajax ends here

        }
    });

    $("#roleadddataForm").validate({
        submitHandler: function (form) {
            //form.submit();
            jQuery.ajax({
                type: "POST",
                url: $("#frm_action_url_add").html(),
                datatype: 'json',
                data: $('#roleadddataForm').serialize(),
                beforeSend: function () {
                    $(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                    $("#submit").attr("disabled", true);
                },
                complete: function () {
                    $("#submit").removeAttr("disabled");
                    $("i").remove(".fa-spin");
                },
                success: function (data) {
                    //console.log(data);
                    var response = jQuery.parseJSON(data);
                    $("#csrf_token_add").val(response.csrf_token);//replace token

                    if (response.status == "success") {
                        $('#roleadddataForm').trigger('reset');
                        $('#myModal_addroledata').modal('hide');
                        $('#errorAlertadd').hide();
                        //$('#msgSuccess').show();
                        //$('#successMsg').html(response.message);                                      
                        location.reload();
                    } else {
                        $("#errorAlertadd").show();
                        $("#formValidationErrors_add").html(response.message);
                        $("#csrf_token_add").val(response.csrf_token);//replace token
                    }
                },
            }); //jquery ajax ends here
        },
        errorElement: "div",
        //errorClass: "form_validation_error",

        rules: {
            role_name: {
                required: true,
                minlength: 3
            },
            role_code: {
                required: true,
                minlength: 2
            },
            role_desc: {
                required: true,
                minlength: 2
            }

        },
        messages: {
            role_name: {
                minlength: "Please enter title more than 3 letters.",
                required: "Role name is required",
            },
            role_code: {
                required: "Role code is required",
                minlength: "Please enter title more than 3 letters.",
            },
            role_desc: {
                required: "Description is Required",
                minlength: "Please enter title more than 3 letters."
            }
        },
        errorPlacement: function (error, element) {
            /*if(element.attr("name") == "admin_captcha") {
             error.appendTo( $('#admincapcha_error_container') );
             }
             else {*/
            error.insertAfter(element);
            //}
        }
    });//validate end




    //get module at the time of add
    $("#add_adminroledata").click(function (e) {
        admin_member_form.settings.rules.password.required = true;
        admin_member_form.settings.rules.conf.required = true;
        //$("#membershp_form").slideDown(200).show();
        $("#frm_action_url_add").html(add_roledata);
        $('#myModal_addroledata').modal({keyboard: false, backdrop: 'static', show: 'toggle'});

        //get data and fill in the form
        jQuery.ajax({
            type: "POST",
            url: all_role_list,
            datatype: 'html',
            data: {csrf_emts_name: $("#csrf_token").val()},
            beforeSend: function () {
                //$(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                $("#submit_add").attr("disabled", true);
            },
            complete: function () {
                $("#submit_add").removeAttr("disabled");
            },
            success: function (data) {

                var response = jQuery.parseJSON(data);
                $("#csrf_token_add").val(response.csrf_token);//replace token

                if (response.status == "success") {
                    $('#role_div_add').html('');
                    $('#role_div_add').append(response.html_view);

                }

            },
        }); //jquery ajax ends here
    });
    

//to get role data at load
    $(".update_adminrole").click(function (e) {
        //console.log(this.name);
        $("#post_id").val(this.name);
        $("#frm_action_url").html(update_roledata + '/' + this.name);
        $('#myModal_roledata').modal({keyboard: false, backdrop: 'static', show: 'toggle'});

        //get data and fill in the form
        jQuery.ajax({
            type: "POST",
            url: get_role_data + '/' + this.name,
            datatype: 'html',
            data: {csrf_emts_name: $("#csrf_token").val()},
            beforeSend: function () {
                //$(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                $("#submit").attr("disabled", true);
            },
            complete: function () {
                $("#submit").removeAttr("disabled");
            },
            success: function (data) {

                var response = jQuery.parseJSON(data);
                $("#csrf_token").val(response.csrf_token);//replace token

                if (response.status == "success") {
                    $('#role_div').html('');
                    $('#role_div').append(response.html_view);
                    $().initializeIcheck();

                }

            },
        }); //jquery ajax ends here

    });

    /*$(".delete_faqdata").click(function (e) {
        var did = $(this).data("id");
        //get data and fill in the form
        jQuery.ajax({
            type: "POST",
            url: delete_administration_data + '/' + $(this).data("id"),
            datatype: 'json',
            data: {csrf_emts_name: $("#csrf_token").val()},
            beforeSend: function () {
                $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            complete: function () {
                $("div").remove(".overlay");
                //$("#msgSuccess").hide();
                //$("#msgError").hide();
            },
            success: function (data) {
                //console.log(data);
                var response = jQuery.parseJSON(data);
                $("#csrf_token").val(response.csrf_token);//replace token
                $(".alert-success").hide();
                if (response.status == "success") {
                    $("#" + did).hide("slow", function () {
                        $("#" + did).remove();
                    });

                    $("#msgSuccess").show();
                    $("#successMsg").html(response.message);
                    //location.reload();
                } else {
                    $("#msgError").show();
                    $("#errorMsg").html(response.message);
                }
            },
        }); //jquery ajax ends here
    });*/

});//end of ready function


//loading more data
function displayAdminResults(lim, off) {
    var formData = {
        "csrf_emts_name": $("#csrf_token").val(),
        "limit": lim,
        "offset": off,
    }
    $("#admin_listing_loader_message").show();

    jQuery.ajax({
        type: "POST",
        url: admindata_filter_search,
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

            var response = jQuery.parseJSON(data);

            $("#csrf_token").val(response.csrf_token);//replace token
            //console.log(response);
            if (response.status == "success") {


                var ci = parseInt($('tr.dataadmin:last td:first').html()) + 1;

                $("#adminlist").append(generate_admin_tables(response.adminlist, ci, response));

                //hide lodmore button when display data and database records are same
                if (parseInt($('.adminlist tbody tr').length) == response.total_item_count)
                    $("#admin_listing_loader_message").hide();

            } else {
                $("#admin_listing_loader_message").hide();
            }

        }

    });
}

$('#myModal_admindata').on('hidden.bs.modal', function (e) {
    $('#myModal_admindata').find('#img_pic').attr('src', '');
});

function generate_admin_tables(resData, ci, permission)
{
    var html_data = '';
    var stat = '';
    var usertype = 'Normal';
    $.each(resData, function (name, val) {
        if (val.status == 1) {
            stat = "Active";
        }
        if (val.status == 2) {
            stat = "Closed";
        }
        if (val.status == 3) {
            stat = "Suspended";
        }
        if (val.status == 0) {
            stat = "Inactive";
        }
        if (val.user_type == 0) {
            usertype = 'SuperAdmin';
        }
        if (val.user_type == 1) {
            usertype = 'Admin';
        }

        var option = '';
        if (permission.edit == true || permission.delete == true)
        {
            option += '<td><div class="tools">';

            if (permission.edit == true) {
                option += '<a href="javascript:void(0);"  name="' + val.id + '" class="update_admindata"><i class="fa fa-edit text-yellow"></i></a>';
            }

            if (permission.delete == true) {
                option += '<a href="javascript:void(0);" data-id="' + val.id + '" class="delete_admindata"><i class="fa fa-trash-o text-red"></i></a>';
            }
            option += '</div></td>';
        }
        html_data += '<tr class="dataadmin"><td>' + ci + '.</td><td>' + val.user_name + '</td><td>' + val.email + '</td><td>' + stat + '</td><td>' + usertype + '</td>' + option + '</tr>';
        ci++;

    });
    return html_data;
}

