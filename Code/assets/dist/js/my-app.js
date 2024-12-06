document.body.onload = makeEqual; 
document.body.onresize = makeEqual;


var prevInnerWidth = window.innerWidth;

function eliminate() {
	/*
	$('.carousel-img').each(function() {
		$(this).css('height', $(this).css('min-height'));
	});
	
	$('.feature-img').each(function() {
		$(this).css('height', $(this).css('min-height'));
	});*/
}

function makeEqual() {
	
	$('.eq-height').each(function() {
		$(this).css('min-height', 'auto');
		$(this).css('overflow-y', 'hidden');
	});
	
	if (window.innerWidth < 768) { return; }
	
	var type = document.getElementsByClassName('eq-section');
	
	var ipr = (window.innerWidth > 991) ? 4 : 3;
	
	for (var p=0; p<type.length; p++) {
		
		var eq = type[p].getElementsByClassName('eq-height');
		
		for (var i=0; i<eq.length; i+=ipr) {
			
			var max = parseInt(eq[i].offsetHeight);
			
			for (var j=1; j<ipr && i+j<eq.length; j++) {
				max = (max  > eq[i+j].offsetHeight) ? max : parseInt(eq[i+j].offsetHeight);
			}
			
			for (var m=0; m<ipr && i+m<eq.length; m++) {
				eq[i+m].style.minHeight = max + 'px';
				eq[i+m].style.maxHeight = max + 'px';
				eq[i+m].style.height = max + 'px';
			}
		}
	}
	
	prevInnerWidth = window.innerWidth;
}