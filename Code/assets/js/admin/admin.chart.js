var initiated=false;
var reg;
var watched;
var bids;
var published;
var chart;
$(document).ready(function(){
				if(initiated==false)
				{
					var watched_lots_product=get_watched_lots_product('','');
                crerate_line_graph(watched_lots_product,'watched_lots_product','Watched');

                var published_lots=get_lots_data('reg_per_day','','');
                crerate_line_graph(published_lots,'reg_per_day','User Registered Datewise');

                var published_lots=get_lots_data('bids_per_day','','');
                crerate_line_graph(published_lots,'bid_per_day','User Registered Datewise');

                var published_lots=get_lots_data('published','','');
                crerate_line_graph(published_lots,'published','Auction Published Datewise');

                initiated=true;
				}
				

	    $('#watch_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#watch_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#watch_from_date").on("dp.change", function (e) {
		        $('#watch_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#watch_to_date").on("dp.change", function (e) {
		        $('#watch_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		    $('#reg_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#reg_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#reg_from_date").on("dp.change", function (e) {
		        $('#reg_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#reg_to_date").on("dp.change", function (e) {
		        $('#reg_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		        $('#bid_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#bid_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#bid_from_date").on("dp.change", function (e) {
		        $('#bid_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#bid_to_date").on("dp.change", function (e) {
		        $('#bid_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		     $('#published_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#published_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#published_from_date").on("dp.change", function (e) {
		        $('#published_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#published_to_date").on("dp.change", function (e) {
		        $('#published_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		    $(document).on('click','#search_watch',function(){
		    	watched.destroy();
		    	var from='';
		    	var to='';
		    	 from=$('#from_date_watch').val();
		    	 to=$('#to_date_watch').val();
		    	var watched_lots_product=get_watched_lots_product(from,to);
        		crerate_line_graph(watched_lots_product,'watched_lots_product','Watched');
		    });

		    $(document).on('click','#search_reg',function(){
		    	reg.destroy();
		    	var from='';
		    	var to='';
		    	 from=$('#from_date_reg').val();
		    	 to=$('#to_date_reg').val();
		    	var published_lots=get_lots_data('reg_per_day',from,to);
                crerate_line_graph(published_lots,'reg_per_day','User Registered Datewise');
		    });

		    $(document).on('click','#search_bid',function(){
		    	bids.destroy();
		    	var from='';
		    	var to='';
		    	 from=$('#from_date_bid').val();
		    	 to=$('#to_date_bid').val();
		    	var published_lots=get_lots_data('bids_per_day',from,to);
                crerate_line_graph(published_lots,'bid_per_day','User Bids Datewise');
		    });

		    $(document).on('click','#search_published',function(){
		    	published.destroy();
		    	var from='';
		    	var to='';
		    	 from=$('#from_date_published').val();
		    	 to=$('#to_date_published').val();
		    	var published_lots=get_lots_data('published',from,to);
                crerate_line_graph(published_lots,'published','Auction Published Datewise');
		    });



});

		// var watched_lots_product=get_watched_lots_product(from,to);
  //       crerate_line_graph(watched_lots_product,'watched_lots_product','Watched');
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
    function get_watched_lots_product(from,to)
{
    var test=[];
            
            // console.log(seracr_url);
            $.ajax({
                    type: "POST",
                    url: seracr_url,
                    data:{from:from,to:to},
                     async: false,
                    success: function(data) {
                        // console.log(data); return false;
                        test =JSON.parse(data) ;
                       // return data;
                    }
                });
            return test;
    }
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
        console.log(labels);
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
    if(chartid=='watched_lots_product')
    {
    	watched = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
    }
    if(chartid=='reg_per_day')
    {
    	reg = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
    }
    if(chartid=='bid_per_day')
    {
    	bids = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
    }
    if(chartid=='published')
    {
    	published = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
    }
   
  
       // console.log(chartid);
          }

