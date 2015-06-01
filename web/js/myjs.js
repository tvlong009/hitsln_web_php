
jQuery(document).ready(function($) {



	setWidth_Banner_Content();
	//call a function set with for banner

	setItemCD();
	//call function set options for item have CD image

	customItem();
	fix_w_top30_page();
	customItemLine();


	$('.menu_right_click').hide();
	$('.menu_right_click').mouseleave(function(event) {
		$('.menu_right_click').hide();
	});
	
});
//end ready function event



	
$( window ).resize(function() {
	setWidth_Banner_Content();
	setItemCD();
	customItem();
	fix_w_top30_page();
	customItemLine();
	//call a function
});
//end window resize event 



$('.row_item  .item_list .item .right_click, .open_right_menu').click(function(e) {
	/*
		$(this).offset(); <-- get toa do diem 
		offset.left -> toa do cua box
		offset.top -> toa do cua box
		e.clientX  toa do x ~~  left;
		e.clientY  toa do y ~~ top;
	*/

	var window_heigth = $(window).height();
	var window_width = $(window).width();

	var offset = $(this).offset();
	var _x = e.clientX;
	var _y = e.clientY;

// console.log(window_heigth);


var custom_h = window_heigth - _y;
var custom_w = window_width - _x;

	if (custom_h < 160 )
	{
  		_y = _y - $('.menu_right_click').height()+15 ;
	}

	if (custom_w < 250)
	{
		_x = _x - 270;
	}
	// console.log(test);

	console.log(custom_w);

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
					console.log(total_item);

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
		
	}


	
}
// End function Set with for banner content


function setItemCD()
{

	 var w_document = $(document).width();

	  if ( w_document > 1754 ) {

	  	$('.item_have_cd ').attr('class', 'item_have_cd col-md-3');
	  	$('.item_have_cd:nth-child(4)').show();
	  	$('.item_have_cd:nth-child(3)').show();
	  }
	   else if(w_document > 1420 && w_document < 1755){

	  	$('.item_have_cd ').attr('class', 'item_have_cd col-md-4');
	  	$('.item_have_cd:nth-child(3)').show();
	  	$('.item_have_cd:nth-child(4)').hide();

	  	// $('.item_have_cd:nth-child(3)').hide();

	  }else if(w_document < 1419){

	  	$('.item_have_cd ').attr('class', 'item_have_cd col-md-6');
	  	$('.item_have_cd:nth-child(3)').hide();
	  }


	var w_box = $('.item_have_cd .img_item ').width();
	var w = $('.item_have_cd .img_item img:first-child ').width();
	 
	

	 $('.item_have_cd .item_text, .item_have_cd div:last-child ').css('marginRight', w_box - w);
	 // set with for box have text

}	



function customItem()
{
	var w_document = $(document).width();
	 if ( w_document < 1681 ) {
	 	$('.row_item.custom_class_item .item_list .item').attr('class', 'col-lg-2 item');
	 	$('.row_item.custom_class_item .item_list .item').attr('class', 'col-lg-3 item');
	 } else {
	 	$('.row_item.custom_class_item .item_list .item').attr('class', 'col-lg-3 item');
	 	$('.row_item.custom_class_item .item_list .item').attr('class', 'col-lg-2 item');
	 }


	 var add_div = $('.custom_class_item .add_new_playlist');
	 w_ = $('.row_item.custom_class_item .item_list .item').width();
	 h_ = $('.row_item.custom_class_item .item_list .item').height();

	 add_div.css({
	 	'width': w_,
	 	'height': h_,
	 	'padding-top': h_/4,
	 });

}





function customItemLine()
{
	var div_item = $('.row_item.custom_class_item_inline .item_list .item');

	 var w_document = $(document).width();

	  // if ( w_document > 1754 ) {

	  // 	$('.item_have_cd ').attr('class', 'item_have_cd col-md-3');
	  // 	$('.item_have_cd:nth-child(4)').show();
	  // 	$('.item_have_cd:nth-child(3)').show();
	  // }
	  //  else if(w_document > 1420 && w_document < 1755){

	  // 	$('.item_have_cd ').attr('class', 'item_have_cd col-md-4');
	  // 	$('.item_have_cd:nth-child(3)').show();
	  // 	$('.item_have_cd:nth-child(4)').hide();

	  // 	// $('.item_have_cd:nth-child(3)').hide();

	  // }
	   if(w_document < 1680){

	  	div_item.attr('class', 'col-md-3 item');
	  	returnChild(5).hide();
	  	returnChild(6).hide();

	  
	  } else {
	  	div_item.attr('class', 'col-md-2 item');
	  	returnChild(5).show();
	  	returnChild(6).show();
	  }

	  function returnChild(number)
	  {
	  	var child = $('.row_item.custom_class_item_inline .item_list .item:nth-child('+number+')');
	  	return child;
	  }
}






function fix_w_top30_page() {

	var w_ads_top_30 = $('#ads_top_30').width();
	space = w_ads_top_30 -(250);
	// console.log(space);
	$('#ads_top_30 .title_row').width(space);
	if (space > 1000)
	{
		$('#ads_top_30 .table_song_list,#ads_top_30 .table_song_list table ' ).width(space);
	// $('.history_list').height( $('#ads_top_30').height() );
	} else {
		$('#ads_top_30 .table_song_list').width(space);

		$('#ads_top_30 .table_song_list').css({
			// 'overflow': 'auto',
			'overflow-x' : 'auto  '
		});

		$('#ads_top_30 .table_song_list').css('overflow-x', 'auto scroll');
		$('#ads_top_30 .table_song_list table').width( $('#ads_top_30').width()+100);
	}
	
}

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