$(document).ready(function() {
      $('#start_datetimepicker').datetimepicker({
        format:'YYYY-MM-DD HH:mm',
        minDate: new Date(),
    });
    $('#end_datetimepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format:'YYYY-MM-DD HH:mm',
            minDate: new Date(),
        });
    $("#start_datetimepicker").on("dp.change", function (e) {
        $('#end_datetimepicker').data("DateTimePicker").minDate(e.date);
        if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
          $(this).data('DateTimePicker').hide();
        }
    });
    $("#end_datetimepicker").on("dp.change", function (e) {
        $('#start_datetimepicker').data("DateTimePicker").maxDate(e.date);
        if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
          $(this).data('DateTimePicker').hide();
        }
    });

    

     $('#start_datetimepickeredit').datetimepicker({
        format:'YYYY-MM-DD HH:mm',
    });
    $('#end_datetimepickeredit').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format:'YYYY-MM-DD HH:mm',
        });
    $("#start_datetimepickeredit").on("dp.change", function (e) {
        $('#end_datetimepickeredit').data("DateTimePicker").minDate(e.date);
        if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
          $(this).data('DateTimePicker').hide();
        }
    });
    $("#end_datetimepickeredit").on("dp.change", function (e) {
        $('#start_datetimepickeredit').data("DateTimePicker").maxDate(e.date);
        if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
          $(this).data('DateTimePicker').hide();
        }
    });
  $(".auction_add_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        won_limit_days:{
          required: true,
        },
        price:{
          required: true,
        },
        shipping_cost:{
          required: true,
        },
        bid_fee:{
          required: true,
          integer:true
        },
        reset_time:{
          required: true,
          integer:true,
        },

        start_date:{
          required:true,
        },
        auction_type:{
          required:true,
        },
         end_date:{
          required:true,
              }
      },
      messages:
      {
        
      }
      
  });

  $(".edit_auction_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        won_limit_days:{
          required: true,
        },
        price:{
          required: true,
        },
        shipping_cost:{
          required: true,
        },
        bid_fee:{
          required: true,
          integer:true
        },
        reset_time:{
          required: true,
          integer:true,
        },

        start_date:{
          required:true,
        },
        auction_type:{
          required:true,
        },
         end_date:{
          required:true,
              }
      },
      messages:
      {
        
      }
      
  });
});

jQuery.validator.addMethod('greaterThan', function(value, element, param) {
  console.log(param);
return ( value > param);
},false );

/*jQuery.validator.addMethod('checkEndDate', function(value, element, param) {
return ( value > jQuery(param).val() );
}, 'Must be greater than start' );*/
// $('#addauctionbtn').click(function() {
//     alert('submit');
//     return false;
  //   $("#editProductForm").validate({
  //       //by default validation pluginns ignores hidden fields, this will initiailize new ignores for this form. empty means no ignores
  //       //ignore: [],
  //       ignore: ".ignore, :hidden",

  //       errorElement: 'div',
  //       errorClass: 'error',

  //       highlight: function (element, errorClass, validClass) { 
  //         $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
  //       }, 
  //       unhighlight: function (element, errorClass, validClass) { 
  //       	$(element).parents("div.form-group").removeClass('has-error'); 
  //       	$(element).parents(".error").removeClass('has-error').addClass('has-success'); 
  //       },
		
		// submitHandler: function(form) {
		// 	//myDropzone.processQueue();
  //           form.submit();
  //       },
		// errorPlacement: function(error, element) {
  //           error.appendTo( element.parent() );
  //         },
  //         groups: {
  //           names: "end_day end_hour end_minute"
  //       },
		// rules: {
  //           plate_number: {
  //               required: true
  //           },
  //           lot_number: {
  //               required: true,
				
  //           },
  //           serial_number: {
  //               required: true,
				
  //           },
  //           vin_number:{
  //               required: true,
  //               number: true,
                
  //           },  
  //           starting_price:{
  //               required: true,
  //               number: true,
               
  //           },     

  //           start_date:{
  //           	required: true,
            	
  //           },
           
  //           end_duration: {
  //           	required: true,
  //           	number: true,
                
  //           },

  //           seller: {
  //           	required: true,
  //           	number: true,
               
  //           },
  //           end_day:
  //           {
  //               number: true,
  //               range: [1, 365],
  //               require_from_group: [1, ".end_duration"]
                
  //           },

  //           end_hour:
  //           {
  //               number:true,
  //               range: [1, 24],
  //               require_from_group: [1, ".end_duration"]
                
  //           },
  //           end_minute:
  //           {
  //               number:true,
  //               range: [5, 60],
  //               require_from_group: [1, ".end_duration"]
                
  //           },

            
  //           // auction_duration: {
  //           // 	required: true,
  //           // 	number: true,
  //           //     maxlength: 5,
  //           // },

  //           make: {
  //           	required:true,
  //           },
  //           model: {
  //               required:true,
  //           },
  //           'description[1]':
  //           {
  //               required:true,
  //           },
  //           'description[2]':
  //           {
  //               required:true,
  //           },

  //           'seller_note[1]':
  //           {
  //               required:true,
  //           },

  //           'seller_note[2]':
  //           {
  //               required:true,
  //           },
            
  //           // 'autocheckstatus[1]':
  //           // {
  //           //     required:true,
  //           // },
  //           // 'autocheckstatus[2]':
  //           // {
  //           //     required:true,
  //           // },
            
  //       },
  //       messages: {
  //           plate_number: {
  //               required: "Plate Number field is required"
  //           },
  //           lot_number: {
  //               required: "Lot Number field is required",
               
  //           },
  //           serial_number: {
  //               required: "Serial Number field is required",
               
  //           },
  //           price:{
  //           	required: 'Price field is required',
  //           	number: 'Price should be number',
               
  //           },
  //           vin_number:{
  //               number: 'Vin Number field is required',
                
  //           },  
  //           starting_price:{
  //               number: 'Starting Price field is required',
             
  //           },
  //           start_date:{
  //           	required: 'Start Date field is required',
            	
  //           },
  //           end_duration: {
  //           	required: 'Auction duration field is required',
  //           	number: 'Auction duration field should be number',
               
  //           },
  //           seller: {
  //           	required: "Seller field is required",
  //           },
            
  //           make: {
  //           	required:'Make Field is required',
  //           },
            
  //           model: {
  //               required:'Model Field is required',
  //           },

  //           'description[1]':
  //           {
  //               required:'Description Field is required',
  //           },

  //           'description[2]':
  //           {
  //               required:'Description Field is required',
  //           },


  //           'seller_note[1]':
  //           {
  //               required:'Seller Note Field is required',
  //           },
  //            'seller_note[2]':
  //           {
  //               required:'Seller Note Field is required',
  //           },

  //           end_day:
  //           {
  //               number: 'Day should be number',
  //           },

  //            end_hour:
  //           {
  //               number: 'Hour should be number',
  //           },
            
  //           end_minute:
  //           {
  //               number: 'Minute should be number',
  //               range:'Range From 5 to 60',
  //           },
             
  //           //  'autocheckstatus[1]':
  //           // {
  //           //     required:'Auto Check Report Field is required',
  //           // },
  //           //  'autocheckstatus[2]':
  //           // {
  //           //     required:'Auto Check Report Field is required',
  //           // },
           

  //       },
  //   });
// });

$("#addauctionbtn").click(function(){
    alert('submit');
    return false;

    

      $("#auction_add").validate({
        //by default validation pluginns ignores hidden fields, this will initiailize new ignores for this form. empty means no ignores
        //ignore: [],
        ignore: ".ignore, :hidden",

        errorElement: 'div',
        errorClass: 'error',

        highlight: function (element, errorClass, validClass) { 
          $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
        }, 
        unhighlight: function (element, errorClass, validClass) { 
         $(element).parents("div.form-group").removeClass('has-error'); 
         $(element).parents(".error").removeClass('has-error').addClass('has-success'); 
        },
        
        submitHandler: function(form) {
         //myDropzone.processQueue();
            form.submit();
        },
        errorPlacement: function(error, element) {
            error.appendTo( element.parent() );
          },
          groups: {
            names: "end_day end_hour end_minute"
        },
        rules: {
            price: {
                required: true
            },
            shipping_cost: {
                required: true,
                
            },
            require_seat: {
                required: true,
                
            },

            seat_booking_fee:{
                required: true,
                number: true,
            },

            free_credit:{
                required: true,
                number: true,
            },  
           
           bid_increment:{
             required: true,
                
            },
            name:{
             required: true,
                
            },
            end_day:
            {
                number: true,
                range: [1, 365],
                require_from_group: [1, ".end_duration"]
                
            },

            end_hour:
            {
                number:true,
                range: [1, 24],
                require_from_group: [1, ".end_duration"]
                
            },
            end_minute:
            {
                number:true,
                range: [5, 60],
                require_from_group: [1, ".end_duration"]
                
            },

            
            
        },
        messages: {
            price: {
                required: "Price field is required"
            },
            shipping_cost: {
                required: "shipping cost field is required",
               
            },
            require_seat: {
                required: "Require Seat field is required",
               
            },
            seat_booking_fee:{
             required: 'Seat Booking fee field is required',
               
            },
            
            end_day:
            {
                number: 'Day should be number',
            },

             end_hour:
            {
                number: 'Hour should be number',
            },
            
            end_minute:
            {
                number: 'Minute should be number',
                range:'Range From 5 to 60',
            },
             
          

        },
    });
    
  })