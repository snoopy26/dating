$(function(){
	$(window).load(function(){
		$('#seemore-quote-btn').bind('click', function(){
			var el = $(this);
			$('#modal_quotes').modal();
			return false;
		});
		$('#seemore-about-btn').bind('click', function(){
			var el = $(this);
			$('#modal_summary').modal();
			return false;
		});
		$('#matcher').popover({
			placement : 'bottom',
			selector : true,
			content : $('#hidden-matcher-content').html()
		});
		$('#tabMenu a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			return false;
		});
		
		var current = 0;
		var anim = false;
		var image_wrapper = $('#image_wrapper');
		var $items = $('#gallery_photo > li');
		var itemsCount = $items.length;
		$('#gallery_photo').find('a').bind('click', function(){
			var el = $(this);
			var item = el.closest('li');
			if (anim) return false;
			anim = true;
			_showImage(item);
			current = item.index();
			return false;
		});
		var $navNext = image_wrapper.find('a.image_nav_next');
		var $navPrev = image_wrapper.find('a.image_nav_prev');
		$navPrev.bind('click', function(e){
			_navigate('left');
			return false;
		});
		$navNext.bind('click', function(e){
			_navigate('right');
			return false;
		});
		
		$(document).bind('keyup', function(e){
			if (e.keyCode === 39){
				_navigate('right');
			}else if (e.keyCode === 37){
				_navigate('left');
			}
		});
		
		function _navigate(dir){
			
			if (anim) return false;
			anim = true;
			
			if (dir === 'right'){
				if (current + 1 >= itemsCount){
					current = 0;
				}else{
					++current;
				}
			}else if (dir == 'left'){
				if (current - 1 < 0){
					current = itemsCount - 1;
				}else{
					--current;
				}
			}
			
			_showImage($items.eq(current));
			
		};
		
		function _showImage(item){
			var img = item.find('img');
			var largeimg = img.attr('data-bigimg');
			image_wrapper.show();
			$('<img />').load(function(){
				image_wrapper.find('.image_container').empty().append('<img src="'+largeimg+'" />');
				anim = false;
			}).attr('src', largeimg);
		}
		
		$("body").bind('click', function(e){
			if(e.target.className === "image_container"){
				$("#image_wrapper").fadeOut();
			}
		});
		
	});
});