jQuery(document).ready(function ($) {

    $('input[name=name]').focus();
    
    $("#admin-blog-category-form").validate({
        ignore: [],
        submitHandler: function (form) {
            for(instance in CKEDITOR.instances){
               CKEDITOR.instances[instance].updateElement();
            }
            //form.submit();
            jQuery.ajax({
                type: "POST",
                url: $("#frm_action_url").html(),
                datatype: 'json',
                data: $('#admin-blog-category-form').serialize()+'&csrf_emts_name='+$("#csrf_token").val(),
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
            template_name: {
                required: true,
            },
            subject: {
                required: true,
            },
            template_content: {
                required: true,
            },

        },
        messages: {
            template_name: {
                required: "Template Name is required.",
            },
            subject: {
                required: "Subject is required.",
            },
            template_content: {
                required: "Template Content is required.",
            },
        },
        errorPlacement: function (error, element) {
            
            element.closest('.form-group').append(error);
        },
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
                data: {
                    csrf_emts_name: $("#csrf_token").val()
                },
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
                    console.log(response);
                    $("#csrf_token").val(response.csrf_token);//replace token
                    if (response.status == "success") {
                        // reset form values from json object
                        $.each(response.message[0], function (name, val) {
                            
                            var $el = $('#myModal').find('[name="' + name + '"]'),
                                    type = $el.attr('type');
                                if(name == 'template_content'){
                                    CKEDITOR.instances.template_content.setData(val);
                                }
                            switch (type) {
                                case 'checkbox':
                                    $el.attr('checked', 'checked');
                                    break;
                                case 'select':
                                    $el.filter('[value="' + val + '"]').attr('selected', 'selected');
                                    break;
                                case 'radio':
                                    $el.each(function(e){
                                        if($(this).val() == val){
                                            $(this).attr('checked','checked');
                                        }else{
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
            var result = confirm('Are you you want to delete this package?');
            if (result) {
                //get data and fill in the form
                jQuery.ajax({
                    type: "POST",
                    url: delete_data + '/' + $(this).data("id"),
                    datatype: 'json',
                    data: {
                        csrf_emts_name: $("#csrf_token").val()
                    },
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
    
    $('#myModal').on('hidden.bs.modal',function(e){
            $('#admin-blog-category-form')[0].reset();
            $('#admin-blog-category-form div.text-red').remove();
            $('#admin-blog-category-form .text-red').removeClass('text-red');
            CKEDITOR.instances.template_content.setData('');
    });
    $('#myModal').on('show.bs.modal',function(e){
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            })
    });
    $.fn.loadData = function(options){
        
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
                    console.log(response.itemlist);
                    $.each(response.itemlist, function (key, val) {
                        
                        html_collection += '<tr  data-id="' + val.id + '">';
                            html_collection += '<td data-serial="subscription-template">' + cnt;
                            html_collection += '</td>';
                            html_collection += '<td>'+val.template_name;
                            html_collection += '</td>';
                            html_collection += '<td>'+val.subject;
                            html_collection += '</td>';
                            html_collection += '<td>'+val.template_content;
                            html_collection += '</td>';
                            var create_date = val.create_date;
                            html_collection += '<td>'+create_date;
                            html_collection += '</td>';
                            html_collection += '<td>';
                                html_collection += '<div class="tools">';
                                html_collection += '<a href="javascript:void(0);" class="update_data" name="' + val.id + '"><i class="fa fa-edit text-yellow"></i></a>';
                                html_collection += ' <a href="javascript:void(0);" class="delete_data" data-id="' + val.id + '"><i class="fa fa-trash-o text-red"></i></a>';
                                html_collection += '</div>';
                            html_collection += '</td>';
                        html_collection += '</tr>';
                        cnt++;
                    })
                    container.append(html_collection);
                    if(cnt > 1){
                        $('#bidpackage_loader_message').show();
                    }else{
                       $('#bidpackage_loader_message').hide();
                    }
                    if(container.find('tr').length >0 ){
                        $('.no-record-found-label').hide();
                    }else{
                        $('.no-record-found-label').show();
                    }
                    var sp = 1;
                    $('[data-serial="subscription-template"]').each(function(e){
                        $(this).text(sp++);
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
    $('#bidpackage_loader_message').on('click',function(e){
        bidpackage_offset += parseInt(bidpackage_limit);
        $('.blog_category_data_container').loadData({
            limit:bidpackage_limit,
            offset:bidpackage_offset,
        });
    })
    $('.data-search-inputs input').on('change',function(e){
        bidpackage_offset = 0;
        $('.blog_category_data_container').html('');
        $('.blog_category_data_container').loadData({
            limit:bidpackage_limit,
            offset:bidpackage_offset,
        });
    })
    
    $('#email-template-selection').on('change',function(e){
        if($(this).val()){
            $('.individual-email-mesg-container').slideUp();
        }else{
            $('.individual-email-mesg-container').slideDown();
        }
    })

});