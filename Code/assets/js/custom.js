//for popover
$(document).ready(function () {
  $('[data-toggle="popover"]').popover()

//for home  product slider
$(".owl-slider").owlCarousel({
	
    navigation : true,
    navigationText : ["",""],
    slideSpeed:1024,
    autoPlay : 5000,
	itemsScaleUp : true,
   lazyLoad : false,
   
	autoPlay: false, //Set AutoPlay to 5 seconds
	items: 4,
	itemsDesktop: [1199, 3],
	itemsDesktopSmall: [979, 3],
	responsiveClass:true,
	loop:true,
	paginationSpeed : 1024,
	autoplayHoverPause:true,
	responsive:{
		0:{
			items:1,
			loop:true,
			nav:false,
			dots:true
		},
		481:{
			items:1
		},
		600:{
			items:3,
			loop:true,
			nav:false,
			dots:true
		},
		1000:{
			items:4,
			loop:true,
			nav:false,
			dots:true
		}
	}
});

	
//for main  How it works slider
	$(".owl-slider-b").owlCarousel({
		navigation : true,
		navigationText : ["",""],
		slideSpeed:1024,
		autoPlay : 5000,
		itemsScaleUp : true,
		lazyLoad : false,
   
		autoPlay: false, //Set AutoPlay to 5 seconds
		items: 1,
		itemsDesktop: [1199, 1],
		itemsDesktopSmall: [979, 1],
		responsiveClass:true,
		loop:true,
		paginationSpeed : 1024,
		autoplayHoverPause:true,
	   itemsDesktop : [1199,1],
	   itemsDesktopSmall : [980,1],
	   itemsTablet: [768,1],
	   itemsTabletSmall: false,
	   itemsMobile : [660,1],
		
		responsive:{
			0:{
				items:1,
				loop:true,
				nav:false,
				dots:true
			},
			481:{
				items:1
			},
			600:{
				items:1,
				loop:true,
				nav:false,
				dots:true
			},
			1000:{
				items:1,
				loop:true,
				nav:false,
				dots:true
			}
		}
	});
	
//for main banner slider
	 $("#owl-demo").owlCarousel({
 
   navigation : true,
   navigationText : ["",""],
   pagination: true,
   paginationNumbers: true,
   items : 1,
   slideSpeed:1024,
   autoPlay : 5000,
   stopOnHover : true,
   itemsCustom : false,
   itemsDesktop : [1199,1],
   itemsDesktopSmall : [980,1],
   itemsTablet: [768,1],
   itemsTabletSmall: false,
   itemsMobile : [660,1],
   singleItem: false,
   itemsScaleUp : true,
   lazyLoad : false,
   dots : false,
   	responsiveClass:true,
	loop:true,
	paginationSpeed : 1024,
	autoplayHoverPause:true,
   
   //lazyEffect : "fade",  
 
  });
  
  //Sort random function
  function random(owlSelector){
    owlSelector.children().sort(function(){
        return Math.round(Math.random()) - 0.5;
    }).each(function(){
      $(this).appendTo(owlSelector);
    });
  }
 
  $("#owl-demo").owlCarousel({
    navigation: true,
    navigationText: [
      "<i class='icon-chevron-left icon-white'></i>",
      "<i class='icon-chevron-right icon-white'></i>"
      ],
    beforeInit : function(elem){
      //Parameter elem pointing to $("#owl-demo")
      random(elem);
    }
 
  });
  
  
//for Filter Drop Down
	$( document ).on( 'click', '.bs-dropdown-to-select-group .dropdown-menu li', function( event ) {
		var $target = $( event.currentTarget );
		$target.closest('.bs-dropdown-to-select-group')
			.find('[data-bind="bs-drp-sel-value"]').val($target.attr('data-value'))
			.end()
			.children('.dropdown-toggle').dropdown('toggle');
		$target.closest('.bs-dropdown-to-select-group')
			.find('[data-bind="bs-drp-sel-label"]').text($target.attr('data-value'));/*$target.text()*/	
		return false;
	});


//for Hidden product info slide Down
$('.item').hover(function(e){
	$(this).parent().find('.hidden_div').slideToggle(300);	
});
	
//for Stacky Header		
$(window).on("scroll", function() {
	var fromTop = $(window).scrollTop();
	$(".stickyheader").toggleClass("sticky", (fromTop > 400));
	//$("body").toggleClass("down", (fromTop > 400));
});	

//for Data Table
$('#example').dataTable({
    "bPaginate": false,
	"responsive": true,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "bAutoWidth": false
});

// Get the modal image
var modal = document.getElementById('imgModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
$('#myImg').on('click',function()
{
	var alts= $(this).data('alt');
	var srcs=$(this).data('src');
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");

    modal.style.display = "block";
    modalImg.src =srcs;
    modalImg.alt = alts;
    captionText.innerHTML = alts;
	
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
}); 

//Programatically call
$('#open-image').click(function (e) {
	e.preventDefault();
	$(this).ekkoLightbox();
});
$('#open-youtube').click(function (e) {
	e.preventDefault();
	$(this).ekkoLightbox();
});

// navigateTo
$(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
	event.preventDefault();

	var lb;
	return $(this).ekkoLightbox({
		onShown: function() {

			lb = this;

			$(lb.modal_content).on('click', '.modal-footer a', function(e) {

				e.preventDefault();
				lb.navigateTo(2);

			});

		}
	});
});	
})

 $(document).ready(function() {

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 20,
      values: [ 5, 10 ],
	  
      slide: function(event, ui) { $(ui.handle).find('text').html('$' + ui.value).css({"padding":"0px"}); },
	   create: function(event, ui) {
            var v = $(this).slider('values');
            var c = 0;
            $(this).find('text').each(function(){
                $(this).first().text("$" + v[c]).css({"padding":"0px"});
                c++;
            });
        }   
	  
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

  } );


//for Vide0 play
$(document).on('click','.video',function(){
 var theModal = $(this).attr("data-theVideo");
$('iframe#videoStop').attr('src', theModal);
	 $('#modal-close.close').click(function () {
		$('iframe#videoStop').attr('src', '');
	});
})
