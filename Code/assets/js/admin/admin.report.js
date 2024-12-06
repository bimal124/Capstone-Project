$(document).ready(function(){
		
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

		    $('#pro_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#pro_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#pro_from_date").on("dp.change", function (e) {
		        $('#pro_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#pro_to_date").on("dp.change", function (e) {
		        $('#pro_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		      $('#cre_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#cre_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#cre_from_date").on("dp.change", function (e) {
		        $('#cre_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#cre_to_date").on("dp.change", function (e) {
		        $('#cre_from_date').data("DateTimePicker").maxDate(e.date);
		    });

		     $('#tran_from_date').datetimepicker({
	        format:'YYYY-MM-DD',

		    });
		    $('#tran_to_date').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format:'YYYY-MM-DD',
		         
		        });
		    $("#tran_from_date").on("dp.change", function (e) {
		        $('#tran_to_date').data("DateTimePicker").minDate(e.date);
		    });
		    $("#tran_to_date").on("dp.change", function (e) {
		        $('#tran_from_date').data("DateTimePicker").maxDate(e.date);
		    });
});

 