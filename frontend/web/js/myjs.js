
jQuery(document).ready(function($) {



	setWidth_Banner_Content();
	//call a function

	$('.menu_right_click').hide();
	$('.menu_right_click').mouseleave(function(event) {
		$('.menu_right_click').hide();
	});
	
});
//end ready function event



	
$( window ).resize(function() {
	setWidth_Banner_Content();
	//call a function
});
//end window resize event 




$('.row_item  .item_list .item .right_click').click(function(e) {
	/*
		$(this).offset(); <-- get toa do diem 
		offset.left -> toa do cua box
		offset.top -> toa do cua box
		e.clientX  toa do x ~~  left;
		e.clientY  toa do y ~~ top;
	*/

	var offset = $(this).offset();
	var _x = e.clientX;
	var _y = e.clientY;


	show_menu_on_mouse(_x, _y);
	//call function


});
// End event right click to show menu in home page



// Event for button next and prev of slide item in home page 
//and some page use this event
$('.btn_prev_item').click(function(event) {

	var id_name = $(this).parent().parent().parent().attr('id');
	slide_item ("#"+id_name,"prev")
});

$('.btn_next_item').click(function(event) {

	var id_name = $(this).parent().parent().parent().attr('id');
	slide_item("#"+id_name,"next");

});

// END --> Event for button next and prev of slide item in home page
// and some page use this event





//================= START LIST FUNCTION  =================

function filter_item (selector) {


	$(selector).children('li').click(function(event) {
		$(selector).children('li').removeClass('active')
		var test = $(this).addClass('active');
		filter_item (selector);
		
	});


	$(selector).children('li').each(function(index, el) {
		var classname = $(this).attr('class');
		

		if( classname == "active") {
			var action = $(this).attr('data-target');
			// action =  get target name

			if(action == "all")
			{
			  // action all => show all class
			  	$(selector).children('li').each(function(index, el) {
			  		var target = $(this).attr('data-target');
			  		if(target != "all")
			  		{
			  			$(target).hide().show('100');
			  		}
			  	});

			} else {
				 // != all => hide all => show data-target
				 // action all => show all class
			  	$(selector).children('li').each(function(index, el) {
			  		var target = $(this).attr('data-target');
			  		if(target != "all")
			  		{
			  			$(target).hide();
			  		}
			  	});
			  	//end each
			  	$(action).show('100');
			}


		}
		// access show/hide for target item


	});
	
	// action active hidden or show item list in filter

}
// function for filter item



// function for slide
function slide_item (id_list_item,action) {
	var total_item = 0;
	
	$(id_list_item+' .item').each(function(index, el) {
		total_item++;
	});

	

	var test = $(id_list_item+ ' .btn_prev_item').attr('data-itemnumber');
	

	switch(action){
		case "prev":

			var first_item  = $(id_list_item+ ' .btn_prev_item').attr('data-itemnumber');
			var next_item  = $(id_list_item+ ' .btn_next_item').attr('data-itemnumber');

			first_item_minus= parseInt(first_item)-1;
			
			if (first_item_minus >= 1 ) {
					console.log(first_item_minus);

				$(id_list_item+' .item:nth-child('+next_item+')').hide('slow/400/fast', function() {
					
				});
	
				$(id_list_item+' .item:nth-child('+first_item_minus+')').delay('300').show('slow/400/fast', function() {
					
				});

				

				$(id_list_item+ ' .btn_prev_item').attr('data-itemnumber', first_item_minus);
				$(id_list_item+ ' .btn_next_item').attr('data-itemnumber', first_item_minus+5);

			} 
			//event Prev click
			break;

		case "next":
			var first_item  = $(id_list_item+ ' .btn_prev_item').attr('data-itemnumber');
			var next_item  = $(id_list_item+ ' .btn_next_item').attr('data-itemnumber');

			next_item_plus = parseInt(next_item)+1;
			
			if (next_item_plus <= total_item ) {
					//console.log(total_item);

				$(id_list_item+' .item:nth-child('+first_item+')').hide('slow/400/fast', function() {
					
				});

				$(id_list_item+' .item:nth-child('+next_item_plus+')').delay('300').show('slow/400/fast', function() {
					
				});

				$(id_list_item+ ' .btn_prev_item').attr('data-itemnumber', next_item_plus-5);
				$(id_list_item+ ' .btn_next_item').attr('data-itemnumber', next_item_plus);

			} 
			//event Next click
		break;

		case "":
			//Fist time or action = null
			$(id_list_item+' .item').hide();
			for (var i = 1; i <= 6 ; i++) {
				$(id_list_item+' .item:nth-child('+i+')').show();
			};

			$(id_list_item+ ' .btn_prev_item').attr('data-itemnumber', '1');
			$(id_list_item+ ' .btn_next_item').attr('data-itemnumber', '6');
			// console.log(id_list_item+' .btn_prev_item');
			break;
	}
}





function show_menu_on_mouse(_x, _y) {

	$('.menu_right_click').show("500");

	$('.menu_right_click').css({
		"top": _y-5,
		"left": _x-5
	});
}

// End function show menu like right click menu on windows




function setWidth_Banner_Content()
{	


	browser_width = jQuery(document).width();
	browser_width = browser_width - (590);
	

	
	$('.banner_content').css({
		width: browser_width+'px',
		'overflowY': 'hidden'
	});

	$('.banner_content img').css({
		width: browser_width+'px',
		'max-height': '236px',
	});

	var banner_height = $('.item img').height();
	if (banner_height < 235 &&  banner_height >0) {
		fix_height = 235 - banner_height;
		$('.banner_content img').css({
			'margin-top': (fix_height/2)+'px',
		});
		console.log(banner_height);
	}
	
}
// End function Set with for banner content






//================ END:LIST FUNCTION  ================



// ====================         END JS For MAIN PAGE          ==========================













// ====================         JS For Other page          ==========================

// $(window).scroll(function() {
//   var a = $('.player_side_bar').offset();
// 	var b = a.top - $(window).scrollTop();
// 	if (b <= 75) {
// 		// alert('stop');
// 	}
// });




// ====================         END JS For Other page          ==========================