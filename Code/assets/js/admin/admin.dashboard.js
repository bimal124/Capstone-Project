  var published;

  var reg;

  $(document).ready(function(){

    		var published_lots=get_lots_data('published','','');

                crerate_line_graph(published_lots,'published','Transaction Datewise');



                var published_lots=get_members_data();

                create_pie_chart(published_lots,'members','Members Data');

                var published_lots=get_lots_data('reg_per_day','','');

                crerate_line_graph(published_lots,'reg_per_day','New Patient Datewise');





$(document).on('click', '.update_admindata', function () {
        
        var a = $("#frm_action_url").html(update_administrationdata + '/' + this.name);
        $("#hideshow").show();
        $('#autofield').hide();
        $('#myModal_admindata').modal({keyboard: false, backdrop: 'static', show: 'toggle'});
        admin_member_form.settings.rules.password.required = false;
        admin_member_form.settings.rules.conf.required = false;
        
        $.ajax({
            type: "POST",
            url: get_administration_data + '/' + this.name,
            dataType: 'json',
            data: {
                csrf_emts_name: $("#csrf_token").val(),
                current_module:$('#myModal_admindata [name="current_module"]').val(),
            },
            beforeSend: function () {
                //$(".modal-footer").append('<i class="fa fa fa-spinner fa-spin"></i>');
                $("#submit").attr("disabled", true);

            },
            complete: function () {
                $("#submit").removeAttr("disabled");
            },
            success: function (response) {
                
                $("#csrf_token").val(response.csrf_token);//replace token
                
                if (response.status == "success") {
                    // reset form values from json object
                    $.each(response.message[0], function (name, val) {
                        if(name == 'post_id'){
                            $('#admin_m_post_id').val(val);
                        }
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
                } else if(response.status == "error"){
                    
                    $('#myModal_admindata').modal('hide');
                    $("#msgError").show();
                    $("#errorMsg").html(response.message);
                }
            },
        }); //jquery ajax ends here


    });
  });



  function crerate_line_graph(graphdata,chartid,charttitle)

          {



            console.log(graphdata);



            // myLineChart.destroy();

          var ctx = document.getElementById(chartid);

          // ctx.destroy();

           // var ctx = document.getElementById(chartid);

            var labels =[];

            var datas =[];

        for(var i=0;i<graphdata.length;i++){

            labels.push(graphdata[i].date);

           datas.push(graphdata[i].total_published);

        }

        // console.log(labels);

        var data = {

        labels: labels,

        datasets: [

            {

                label: charttitle,

                data: datas,

                backgroundColor: "blue",

                borderColor: "lightblue",

                fill: false,

                lineTension: 0,

                radius: 5

            },

           

        ]

    };



    //options

    var options = {

        responsive: true,

        title: {

            display: true,

            position: "top",

            text: charttitle+" Chart",

            fontSize: 12,

            fontColor: "#111"

        },

        legend: {

            display: true,

            position: "bottom",

            labels: {

                fontColor: "#333",

                fontSize: 16

            }

        }

    };



    //create Chart class object

    

    if(chartid=='reg_per_day')

    {

    	reg = new Chart(ctx, {

        type: "line",

        data: data,

        options: options

    });

    }

   

    if(chartid=='published')

    {

    	published = new Chart(ctx, {

        type: "bar",

        data: data,

        options: options

    });

    }

   

  

       // console.log(chartid);

          }



                     function get_lots_data(table,from,to)

          {

            var test=[];

            $.ajax({

                    type: "POST",

                    url: s_url,

                    data:{table:table,from:from,to:to},

                    async: false,

                    success: function(data) {



                        // console.log(data); return true;

                        test =JSON.parse(data) ;

                       // return test;

                       // console.log(test);

                    }

                });

            // console.log(test);

            return test;

          }



            function get_members_data()

          {

            var test=[];

            $.ajax({

                    type: "POST",

                    url: ss_url,

                    async: false,

                    success: function(data) {



                        // console.log(data); return true;

                        test =JSON.parse(data) ;

                       // return test;

                       console.log(test);

                    }

                });

            // console.log(test);

            return test;

          }



    function create_pie_chart(graphdata,chartid,charttitle)

    {



            // console.log(result);

        //console.log(graphdata);

        var ctx = document.getElementById(chartid);

          // ctx.destroy();

           // var ctx = document.getElementById(chartid);

            var labels =[];

            var datas =[];

            var datasettemp=[];

            $.each(graphdata,function(key,value){

                labels.push(key);

                datas.push(value);

            })

                //console.log(datas);

                var data = {

        labels: labels,

        datasets: [{

                    data: datas,

                    backgroundColor:['#00a65a','#f5871f','#0c0000','#9b4c0c'],

                    }],



           

        

    };

    //     var options = {

    //   backgroundColor:['#00a65a','#f5871f','#9b0d10','#9b4c0c']

    // };



    // console.log(data);

        var myPieChart = new Chart(ctx,{

            type: 'doughnut',

            data: data,

            // options: options

        });

    }