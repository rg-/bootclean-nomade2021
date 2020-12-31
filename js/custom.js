/* 


	[data-mmasonry] 


*/

function get_MCParams (MC){
	var MasonryParams = {
		itemSelector: '.mmasonry-item',
	  columnWidth: '.mmasonry-sizer',
	  gutter: 0, 
	};

	return MasonryParams;
}

function startMC(MC){ 
  if(MC.attr('data-mmasonry')){
  	MC.on('layoutComplete',function(){
	  	//console.log('layout masonry startMC compete');
	  });
		MC.masonry(get_MCParams(MC)); 
	} 
 	// MC.find('[data-inview-me]').inview_me(); 
 	$(window).trigger('resize');
}

function updateMC(MC,items){
	var $content = $( items );
	MC.append( $content ).masonry( 'appended', $content );
	MC.on('layoutComplete',function(){
	  	//console.log('layout masonry AJAX append compete');
	  	//$(window).trigger('resize');

	  });
	MC.find('[data-is-inview]').is_inview();
	//MC.find('[data-inview-me]').inview_me(); 
	//MC.masonry('layout');
 	$(window).trigger('resize');
}

+function(t){

	var MC = $('[data-mmasonry="products"]'); 

	$(window).on('bc_inited', function () {
		startMC( MC ); 
		$('[data-ajax-load]').trigger('click');  
	});

}(jQuery); 


 /*
	
	[data-ajax-load]

*/

+function(t){  

	$('[data-is-inview]').is_inview();

	$(document).on('click', '[data-ajax-load]', function(ev){

 		var me = $(this);
 		var url = me.attr('data-ajax-load');
 		var paged = me.attr('data-paged');
 		var target = me.attr('data-ajax-target');
 		var holder = me.parent();

 		AjaxLoad_start(me);
 		console.log(url+'&paged='+paged);
 		$.ajax({ type: "GET",   
		     url: url+'&paged='+paged,   
		     success : function(text)
		     {
		         // $( target ).append(text);
		         AjaxLoad_success(me, text);

		         if( me.attr('data-href') ){
		         	var new_url = me.attr('data-href');
		         	var new_object = me.attr('data-href-id');
		         	console.log(new_object);
		         	window.history.pushState({id: new_object}, 'Title', new_url);
		         }
		         
		     }
		}); 
 	}); 

 	window.onpopstate = function (e) {
	  var id = e.state.id;
	  if(id && $('[data-ajax-load][data-href-id='+id+']').length>0 ){
	  	console.log(id);
	  	$('[data-ajax-load][data-href-id='+id+']').trigger('click');
	  } 
	};

 	function AjaxLoad_error(me){
 		var msg = "Sorry but there was an error: ";
		$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
 	}
 	function AjaxLoad_start(me){
 		var target = me.attr('data-ajax-target');
 		$( target ).removeClass('ajax-loaded');
 		$( target ).addClass('ajax-loading');  
 		me.addClass('ajax-loading');
 		if( me.attr('data-ajax-scroll') ){

 			// bs_scroll_to(me.attr('data-ajax-scroll'),0,me);
 			scrollto_offset = $(me.attr('data-ajax-scroll')).offset().top; 
 			$('html, body').animate({
				scrollTop: scrollto_offset
				} );

 		}

 	}
 	function AjaxLoad_success(me, items){
 		var target = me.attr('data-ajax-target');
 		
 		//$( target ).fadeOut(0);
  	$( target ).removeClass('ajax-loading');
  	$( target ).addClass('ajax-loaded');
  	me.removeClass('ajax-loading'); 

  	if(me.attr('data-ajax-load-remove') == 'me'){
	  	me.remove();
	  }

	  if(me.attr('data-ajax-load-method') == 'append'){
	  	//$( target ).append(items);
	  	 
		 	if($( target ).data('mmasonry')){
		 		updateMC($( target ),items);

		 		var items_data =  $($.parseHTML(items)).filter(".paged"); 
		 		var paged = items_data.attr('data-paged');
		 		paged = parseFloat(paged);
  
		 		var total = items_data.attr('data-total');
		 		total = parseFloat(total);
		 		//var temp = $(items).find('.paged').attr('data-paged');
		 		console.log('current paged: '+paged); 
		 		console.log('total paged: '+total); 
		 		me.attr('data-paged', paged+1);
		 		if(total==(paged)){
		 			me.parent().find('.ajax-no-products').removeClass('d-none');
		 			me.addClass('d-none');
		 		}
		 	}
		 	
	  }
	  if(me.attr('data-ajax-load-method') == 'replace' || !me.attr('data-ajax-load-method') ){
	  	$( target ).html(items); 
	  }

	  /*
	  $( target ).fadeIn(300,function(){
	  	//$( target ).find('[data-is-inview]').is_inview();
	  });
	  */
	  
 	}

}(jQuery); 